<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceGroup;
use App\Subscription;
use Illuminate\Http\Request;
use Proxy\Proxy;
use GuzzleHttp\Client;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Zend\Diactoros\ServerRequestFactory;
use Zend\Diactoros\Uri;

class ProxyController extends Controller
{
    public function proxyCall(Request $request, $group_context,$service_context,$any="")
    {
        //dd($group_context,$service_context,$any,$request->input(),$request->application);

        // SERVICE GROUP CHECK
        $service_group = ServiceGroup::where("context",$group_context)->first();
        if($service_group!=null){
            // Valid Service group
            if($service_group->active){
                // Active Service group
            } else {
                // Inactive service group
                return makeAPIResponse(false, "Inactive service group", null, 400);
            }
        } else {
            // Invalid service group
            return makeAPIResponse(false, "Invalid service group", null, 400);
        }

        // SERVICE CHECK
        $service = Service::where("context",$service_context)->first();
        if($service!=null){
            // Valid Service
            if($service->approved) {
                // Service approved
                if ($service->active) {
                    // Active Service
                    if ($service->method==$request->method()) {
                        // Valid method
                    } else {
                        // Invalid method
                        return makeAPIResponse(false, "Method not allowed", null, 405);
                    }
                } else {
                    // Inactive service
                    return makeAPIResponse(false, "Inactive service", null, 400);
                }
            } else {
                // Service not approved
                return makeAPIResponse(false, "Service not approved", null, 400);
            }
        } else {
            // Invalid service
            return makeAPIResponse(false, "Invalid service", null, 400);
        }

        // SUBSCRIPTION CHECK
        $subscription = Subscription::where([
            "application_id"=>$request->application->id,
            "service_id"=>$service->id,
            ])->first();
        if($subscription!=null){
            // Valid Subscription
            if($subscription->approved) {
                // Subscription approved
            } else {
                // Subscription not approved
                return makeAPIResponse(false, "Subscription not approved", null, 400);
            }
        } else {
            // Invalid service
            return makeAPIResponse(false, "No matching subscription", null, 400);
        }

        // SCOPE CHECK
        if(strtoupper($request->token_scope)=="PRODUCTION"){
            $forward_url = $service->production_uri;
        } else {
            $forward_url = $service->sandbox_uri;
        }


        // Create a guzzle client
        $guzzle = new Client(['verify' => false, 'http_errors' => false]);

        // Create the proxy instance
        $proxy = new Proxy(new GuzzleAdapter($guzzle));
        $request = ServerRequestFactory::fromGlobals();

        // Create new URI
        $new_uri = new Uri($forward_url);
        $old_query = $request->getUri()->getQuery();
        $rest_of_path = $any!=""?"/".$any:"";
        $new_uri = $new_uri->withPath($rest_of_path)->withQuery($old_query);
        $request = $request->withUri($new_uri);

        // Add a response filter that removes the encoding headers.
        $proxy->filter(new RemoveEncodingFilter());

        // Forward the request and get the response.
        $response = $proxy->forward($request)->filter(function ($request, $response, $next) {
            // Manipulate the request object.
            $request = $request->withHeader('Authorization', '');
            // Call the next item in the middleware.
            $response = $next($request, $response);

            // Manipulate the response object.
            //$response = $response->withHeader('X-Proxy-Foo', 'Bar');

            return $response;
        })->to($forward_url);
        return response($response->getBody(), $response->getStatusCode())->withHeaders($response->getHeaders());

        // Output response to the browser.
        //(new \Zend\Diactoros\Response\SapiEmitter)->emit($response);

    }

}
