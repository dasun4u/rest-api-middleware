<?php
/**
 * Created by PhpStorm.
 * User: Dasun
 * Date: 2018-02-05
 * Time: 5:17 PM
 */

function fileUpload($file, $path)
{
    if(isset($file)) {
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
        } catch (Exception $e){
            return null;
        }
    } else {
        return null;
    }
}