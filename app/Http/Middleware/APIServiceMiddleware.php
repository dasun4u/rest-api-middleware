<?php

namespace App\Http\Middleware;

use Closure;

class APIServiceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(strpos($request->getUri(), '/api/token_generate')!=false) {
            // Token generate service
            $basic_key = $request->header("authorization");
            $request->request->add(['basic_key'=>substr($basic_key, 6)]);
        }

        return $next($request);
    }
}
