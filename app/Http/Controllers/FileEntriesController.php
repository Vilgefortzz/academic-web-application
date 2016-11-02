<?php

namespace App\Http\Controllers;

use App\Fileentry;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Request;
use Session;

class FileEntriesController extends Controller
{
    public function upload($subject_id) {

        if (Request::hasFile('filefield')){

            $file = Request::file('filefield');
            $extension = $file->getClientOriginalExtension();
            Storage::disk('local')->put($file->getClientOriginalName(),  File::get($file));

            $entry = new Fileentry();
            $entry->subject_id = $subject_id;
            $entry->teacher_id = Auth::guard('teacher')->id();
            $entry->mime = $file->getClientMimeType();
            $entry->original_filename = $file->getClientOriginalName();
            $entry->filename = $file->getFilename().'.'.$extension;

            $entry->save();
            return back();
        }


        Session::flash('error', 'Something went wrong. Failed to upload a file' );
        return back();
    }

    public function download($original_filename){

        $entry = Fileentry::where('original_filename', '=', $original_filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->original_filename);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->original_filename);
    }

    public function delete($original_filename){

        // Search the file in database
        $entry = Fileentry::where('original_filename', '=', $original_filename)->firstOrFail();
        // Remove from database
        $entry->delete();

        // Remove file from storage
        Storage::delete($original_filename);

        Session::flash('success', 'You have correctly removed that file' );
        return back();
    }

}
