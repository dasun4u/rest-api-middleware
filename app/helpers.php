<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 2018-02-05
 * Time: 5:17 PM
 */

function fileUpload($file, $path)
{
    if (isset($file)) {
        try {
            $file_extension = $file->getClientOriginalExtension();
            $timestamp = round(microtime(true) * 1000);
            $new_fileName = $timestamp . rand(111111111, 999999999) . '.' . $file_extension;
            $move = $file->move(public_path($path), $new_fileName);
            if ($move) {
                $new_path = $path . $new_fileName;
                return $new_path;
            } else {
                return null;
            }
        } catch (Exception $e) {
            return null;
        }
    } else {
        return null;
    }
}

function applicationKeyGenerate($scope)
{
    $random1 = str_random(5);
    $random2 = str_random(5);
    $prefix = config('data.KEY_PREFIX');
    $username = \Illuminate\Support\Facades\Auth::user()->username;
    $date = Carbon\Carbon::now()->timestamp;
    $code0 = $random1 . "_" . $prefix . "_" . $username . "_" . strtoupper($scope) . "_" . $date . "_" . $random2;
    $code1 = str_rot13($code0);
    $code = base64_encode($code1);
    $in_table = \App\Application::where('production_key', $code)->orWhere('sandbox_key', $code)->first();
    if ($in_table != null) {
        $code = applicationKeyGenerate($scope);
    }
    return $code;
}

function applicationKeyDecode($key)
{
    $code1 = base64_decode($key);
    $code2 = str_rot13($code1);
    return $code2;
}