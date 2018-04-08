<?php

namespace App\Http\Middleware;

use App\Application;
use App\CustomLogTrait;
use App\User;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class APIServiceMiddleware
{
    use CustomLogTrait;

    private $jwt;
    private $user;

    public function __construct(JWTAuth $jwt, User $user)
    {
        $this->jwt = $jwt;
        $this->user = $user;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $this->jwt = $this->jwt->parseToken();
            $payload = $this->jwt->getPayload();
            $app_id = $payload->get('data')->app_id;
            $token_scope = $payload->get('data')->scope;
            $application = Application::where('id', $app_id)->first();
            if ($application != null) {
                // Has Relevant APP
                if ($application->approved) {
                    // Application approved
                    if ($application->active) {
                        // Application active
                        $request->application = $application;
                        $request->token_scope = $token_scope;
                    } else {
                        // Application inactive
                        return makeAPIResponse(false, "Application is inactive", null, 400);
                    }
                } else {
                    // Application not approved
                    return makeAPIResponse(false, "Application not approved", null, 400);
                }
            } else {
                // No relevant Application
                return makeAPIResponse(false, "There is no application for this Token", null, 400);
            }
        } catch (TokenExpiredException $e) {
            return makeAPIResponse(false, $e->getMessage(), null, 401);
        } catch (TokenInvalidException $e) {
            $this->specialRequestLog("Request Token Invalid | ERROR => " . $e->getMessage(), $request);
            return makeAPIResponse(false, $e->getMessage(), null, 401);
        } catch (JWTException $e) {
            $this->specialRequestLog("Request JWTException | ERROR => " . $e->getMessage(), $request);
            return makeAPIResponse(false, $e->getMessage(), null, 400);
        } catch (\Exception $e) {
            return makeAPIResponse(false, "Internal service error", null, 500);
        }

        $response = $next($request);

        $this->allServiceLog($request, $response);

        return $response;
    }
}
