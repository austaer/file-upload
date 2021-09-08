<?php

namespace App\Http\Controllers;

use App\Models\File;
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = new File();
        $file->dic_name = '';
        $file->name = '';
        $file->file_name = '';
        $file->upload_id = Str::random(32);
        $file->total_size = 0;
        $file->save();

        return response()->json([
            "upload_id" => $file->upload_id
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $upload_id)
    {   
        $media = $request->getContent();
        if (!$media) {
            return response(null, 400);
        }
        
        $file = File::where('upload_id', $upload_id)->first();
        $file->file_name = Str::random(32);
        $file->dic_name = storage_path('uploads');
        $file->received_status = 'y';

        if (Storage::put('public/uploads/' . $file->file_name, $media) === false) {
            return response()->json([
                "error" => "File store failed!",
            ], 500);
        }
        $file->save();
        return response()->json($file, 200);

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
