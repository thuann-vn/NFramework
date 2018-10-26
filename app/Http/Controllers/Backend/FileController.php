<?php

namespace App\Http\Controllers\Backend;

use App\File;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function upload(Request $request){
        $uploadFile = $request->file('images');
        $savedFile = Storage::put('library', $uploadFile);

        $file = new File();
        return $file::create([
            'name' => $uploadFile->getClientOriginalName(),
            'file_name' => $savedFile,
            'extension' => $uploadFile->getClientOriginalExtension(),
            'mime_type' => $uploadFile->getClientMimeType()
        ]);
    }

    /**
     * Delete file from disk and database
     * @param  integer $id  File Id
     * @return boolean      True if success, otherwise - false
     */
    public function destroy($id)
    {
        $file = File::findOrFail($id);
        if (Storage::disk('local')->exists($file.file_name)) {
            if (Storage::disk('local')->delete($file.file_name)) {
                return response()->json($file->delete());
            }
        }
        return response()->json(false);
    }
}
