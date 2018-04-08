<?php

namespace App\Http\Controllers\Admin;

use App\Application;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Storage;

class LogController extends Controller
{

    public function index()
    {
        $applications = Application::paginate(10);

        foreach ($applications as $application) {
            if (is_dir(storage_path('logs/application/' . $application->id))) {
                $application->log_count = count(File::files(storage_path('logs/application/' . $application->id)));
            } else {
                $application->log_count = 0;
            }

        }

        return view('pages.admin.log.index', ['applications' => $applications]);
    }

    public function applicationLog($id)
    {
        $application = Application::find($id);

        if ($application != null) {
            if (is_dir(storage_path('logs/application/' . $application->id))) {
                $log_files = File::files(storage_path('logs/application/' . $application->id));
                return view('pages.admin.log.show', ['application' => $application, 'log_files' => $log_files]);

            } else {
                createSessionFlash('Error', 'FAIL', 'Folder Not Found');
                return redirect('admin/logs');
            }
        } else {
            createSessionFlash('Error', 'FAIL', 'Invalid Application');
            return redirect('admin/logs');
        }
    }

    public function logFileDownload(Request $request)
    {
        try {
            $application_id = $request->input('application_id');
            $file_name = $request->input('file_name');
            return response()->download(storage_path('logs/application/' . $application_id . '/' . $file_name));
        } catch (\Exception $e) {
            createSessionFlash('Error', 'FAIL', 'Download fail');
            return redirect('admin/logs/application/' . $application_id);
        }
    }


    public function deleteDailyLogsByApplicationId($id)
    {
        try {
            File::cleanDirectory(storage_path('logs/application/' . $id));
            return response()->json(["id" => $id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        } catch (\Exception $e) {
            return response()->json(["id" => $id, "status" => "FAIL", "message" => "Error in Delete"]);
        }
    }

    public function deleteLogFileByName(Request $request)
    {
        try {
            $application_id = $request->input('application_id');
            $file_name = $request->input('file_name');
            File::delete(storage_path('logs/application/' . $application_id . '/' . $file_name));
            return response()->json(["id" => $application_id, "status" => "SUCCESS", "message" => "Successfully Deleted"]);
        } catch (\Exception $e) {
            return response()->json(["id" => $application_id, "status" => "FAIL", "message" => "Error in Delete"]);
        }
    }

}
