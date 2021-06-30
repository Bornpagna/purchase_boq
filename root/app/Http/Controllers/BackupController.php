<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Spatie\DbDumper\Databases\MySql;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Support\Facades\Storage;
use Redirect;

class BackupController extends Controller
{
   	public function __construct()
    {
        $this->middleware('auth');
		$this->middleware('CheckProject');
    }

    public function index()
    {
		$data = [
			'title'			=> trans('lang.backup'),
			'icon'			=> 'fa fa-database',
			'small_title'	=> trans('lang.backup_list'),
			'background'	=> '',
			'link'			=> [
				'home'	=> [
					'url' 		=> url('/'),
					'caption' 	=> trans('lang.home'),
				],
				'dashboard'	=> [
					'caption' 	=> trans('lang.backup'),
				],
			],
		];
        return view('backup.index', $data);
    }

   	public function dt()
   	{
   		return Datatables::of(\App\Model\Backup::all())->make(true);
   	}

    public function save(Request $request)
    {
    	try {
    		$backupJob = BackupJobFactory::createFromArray(config('laravel-backup'));
			$backupJob->run();
    		DB::beginTransaction();
            $lastID = DB::table('backups')->insertGetId(['path'=>$backupJob->getZipFile(),'created_at'=>date('Y-m-d H:i:s')]);
            DB::commit();
            return redirect()->back()->with('success',trans('lang.save_success'));
    	} catch (\Exception $e) {
    		DB::rollback();
    		return redirect()->back()->with('error',trans('lang.update_error').' '.$e->getMessage().' '.$e->getLine());
    	}
    }

    public function download(Request $request,$backupID)
    {
    	try {
    		$backups = \App\Model\Backup::find($backupID);
    		if (!$backups) {
    			return redirect()->back()->with('error','File not found!');
    		}
            $path = 'app/'.env('BACKUP_DIRECTORY').'/';
    		$pathToFile = storage_path($path).($backups->path);
    		$headers = ['Content-Type: application/zip'];
    		$newFile = uniqid(rand()).'.zip';
    		return response()->download($pathToFile,$newFile,$headers);
    	} catch (\Exception $e) {
    		return redirect()->back()->with('error','Error download file '.'|'.$e->getLine().'|'.$e->getMessage());
    	}
    }

    public function destroy(Request $request,$backupID){
    	try {
    		$backups = \App\Model\Backup::find($backupID);
    		if (!$backups) {
    			return redirect()->back()->with('error','File not found!');
    		}
    		Storage::disk('local')->delete(env('BACKUP_DIRECTORY').'/'.($backups->path));
    		DB::beginTransaction();
    		DB::table('backups')->where('id',$backupID)->delete();
    		DB::commit();
    		$request->session()->flash('success','Success delete file!');
    		return redirect()->back();
    	} catch (\Exception $e) {
    		DB::rollback();
    		return redirect()->back()->with('error','Error delete file '.'|'.$e->getLine().'|'.$e->getMessage());
    	}
    }

}
