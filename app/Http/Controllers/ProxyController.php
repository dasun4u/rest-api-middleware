<?php

namespace App\Http\Controllers;

use Proxy\Proxy;
use Proxy\Adapter\Guzzle\GuzzleAdapter;
use Proxy\Filter\RemoveEncodingFilter;
use Zend\Diactoros\ServerRequestFactory;

class ProxyController extends Controller
{
    public function proxyCall($group_context,$service_context,$any)
    {
        $request = ServerRequestFactory::fromGlobals();
dd($request->getUri(),$group_context,$service_context,$any);
        // Create a guzzle client
        $guzzle = new \GuzzleHttp\Client();

        // Create the proxy instance
        $proxy = new Proxy(new GuzzleAdapter($guzzle));

        // Add a response filter that removes the encoding headers.
        $proxy->filter(new RemoveEncodingFilter());

        // Forward the request and get the response.
        $response = $proxy->forward($request)->to('http://localhost/MY/rest-api-service/public/api/');
        dd($response);
        // Output response to the browser.
        (new \Zend\Diactoros\Response\SapiEmitter)->emit($response);
        return "";
    }

}
