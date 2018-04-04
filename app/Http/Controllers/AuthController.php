<?php

namespace App\Http\Controllers;

use App\Application;
use App\Rules\BasicKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function tokenGenerate(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'basic_key' => ['required', new BasicKey()],
                'scope' => 'required|in:production,sandbox'
            ], [
                'basic_key.required' => 'Basic Key required',
                'scope.required' => 'Scope is required',
                'scope.in' => 'Invalid scope',
            ]);
            if ($validator->fails()) {
                return makeAPIResponse(false, "Validation error", $validator->errors(), 422, "errors");
            }
            $decode_string = base64_decode($request->input('basic_key'));
            $consumer_array = explode(":", $decode_string);
            $consumer_key = isset($consumer_array[0]) ? $consumer_array[0] : "";
            $consumer_secret = isset($consumer_array[1]) ? $consumer_array[1] : "";
            $scope = strtoupper($request->input('scope'));

            // Check Scope
            if ($scope == "PRODUCTION") {
                $application = Application::where([
                    'production_key' => $consumer_key,
                    'production_secret' => $consumer_secret,
                ])->first();
            } else {
                $application = Application::where([
                    'sandbox_key' => $consumer_key,
                    'sandbox_secret' => $consumer_secret,
                ])->first();
            }

            // Check application exist
            if($application==null){
                return makeAPIResponse(false, "Not matching application. Please check base key.", null, 422);
            }

            // Check whether application is active or not
            if ($application->active == 0) {
                return makeAPIResponse(false, "Application is inactive", null, 422);
            }

            // Check whether application is approved or not
            if ($application->approved == 0) {
                return makeAPIResponse(false, "Application is not approved", null, 422);
            }

            // Set Token payload
            $payload = $this->jwt->factory()
                ->setTTL(($application->token_validity / 3600))
                ->customClaims(['sub' => $application->id, "data" => ['application' => $application->name, 'scope' => $scope]])
                ->make();

            // Token generate
            $token = $this->jwt->manager()->encode($payload)->get();
            if ($token) {
                $data = [
                    "access_token" => $token,
                    "token_type" => "bearer",
                    "scope" => strtolower($scope),
                    "expires_in" => $application->token_validity,
                ];
                return makeAPIResponse(true, "Token Generated", $data, 200);
            } else {
                return makeAPIResponse(false, "Error in Token Generating", null, 500);
            }
        } catch (\Exception $e) {
            // Exception
            return makeAPIResponse(false, "Internal service error", null, 500);
        }
    }
}
