<?php

namespace App\Http\Controllers;

use App\Models\File;
use Libraries\MediaConvert\Facades\Convertor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        phpinfo();   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $object_name = '')
    {
        $media = $request->getContent();
        if (!$media) {
            return response(null, 400);
        }
        
        $file = new File();
        $file->dic_name = '';
        $file->name = $object_name;
        $file->file_name = Str::random(32);
        $file->dic_name = storage_path('public/uploads');
        $file->received_status = 'y';
        $file->upload_id = Str::random(32);
        $file->total_size = 0;

        if (Storage::put('public/uploads/' . $file->file_name, $media) === false) {
            return response()->json([
                "error" => "File store failed!",
            ], 500);
        }

        $file->total_size = filesize(Storage::path('public/uploads/' .  $file->file_name));
        $file->save();
        return response()->json([
            'id' => $file->id,
            'url' => url("api/files/$file->file_name"),
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($file_name)
    {
        //
        $file = File::where('file_name', $file_name)->first();
        if (!$file) {
            return response(null, 404);
        }
        $localFile = Storage::path('public/uploads/' .  $file->file_name);
        return response('', 200, [
            'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
            'Pragma' => 'no-cache',
            'Content-type' => mime_content_type($localFile),
            'Content-Length' => $file->total_size,
            'X-Sendfile' => $localFile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
