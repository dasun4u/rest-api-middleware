<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceGroup;
use App\Subscription;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function proxyCall(Request $request, $group_context, $service_context, $any = "")
    {
        // SERVICE GROUP CHECK
        $service_group = ServiceGroup::where("context", $group_context)->first();
        if ($service_group != null) {
            // Valid Service group
            if ($service_group->active) {
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
        $service = Service::where("context", $service_context)->first();
        if ($service != null) {
            // Valid Service
            if ($service->approved) {
                // Service approved
                if ($service->active) {
                    // Active Service
                    if ($service->method == $request->method()) {
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
            "application_id" => $request->application->id,
            "service_id" => $service->id,
        ])->first();
        if ($subscription != null) {
            // Valid Subscription
            if ($subscription->approved) {
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
        if (strtoupper($request->token_scope) == "PRODUCTION") {
            $forward_url = $service->production_uri;
        } else {
            $forward_url = $service->sandbox_uri;
        }

        // SET METHOD
        $method = $request->getMethod();
        // SET URL
        $rest_of_path = ($any != "") ? ("/" . $any) : "";
        $url = $forward_url . $rest_of_path;
        // SET DATA
        $body = $request->all();

        $response = $this->guzzleCall($method, $url, $body, $request->header());
        return $response;

    }

    private function guzzleCall($method, $url, $body, $headers)
    {
        // Filter headers
        $headers = array_except($headers, ['host', 'authorization']);

        // Guzzle object
        $client = new Client(['verify' => false, 'http_errors' => false]);

        $request_body = [
            'headers' => $headers,
            'json' => $body,
        ];

        $response = $client->request($method, $url, $request_body);
        return response($response->getBody()->getContents(), $response->getStatusCode())->withHeaders($response->getHeaders());
    }

}
