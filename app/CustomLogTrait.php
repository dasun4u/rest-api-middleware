<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 2018-04-07
 * Time: 12:28 AM
 */
namespace App;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

trait CustomLogTrait
{
    public function allServiceLog($request, $response)
    {
        $log_text = "CLIENT IP => ". $request->getClientIp() ." | REQUEST URL => ". $request->getUri()." | REQUEST METHOD => ".$request->getMethod()." | REQUEST BODY => ".(string)$request->getContent()." | RESPONSE STATUS CODE => ".$response->getStatusCode()." | RESPONSE BODY => ".(string)$response->getBody();
        $log = [$log_text];
        $orderLog = new Logger("API");
        $app_id = $request->application->id;
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/application/'.$app_id.'/'.date("Y-m-d").'.log')), Logger::INFO);
        $orderLog->info('Log', $log);
    }

    public function specialRequestLog($action, $request)
    {
        $log_text = "ACTION => ".$action." | CLIENT IP => ". $request->getClientIp() ." | REQUEST URL => ". $request->getUri()." | REQUEST METHOD => ".$request->getMethod()." | REQUEST BODY => ".(string)$request->getContent();
        $log = [$log_text];
        $orderLog = new Logger("API");
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/special.log')), Logger::CRITICAL);
        $orderLog->info('Log', $log);
    }

    public function tooManyAttemptLog($request)
    {
        $log_text = "CLIENT IP => ". $request->getClientIp() ." | REQUEST URL => ". $request->getUri()." | REQUEST METHOD => ".$request->getMethod()." | REQUEST BODY => ".(string)$request->getContent();
        $log = [$log_text];
        $orderLog = new Logger("API");
        $orderLog->pushHandler(new StreamHandler(storage_path('logs/too_many_attempt.log')), Logger::CRITICAL);
        $orderLog->info('Log', $log);
    }
}