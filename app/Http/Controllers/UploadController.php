<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Chunk\UploadFiles\uploadImages;

class UploadController extends Controller
{
    public function file(Request $request)
    {  
        $file = $request->file('file'); 
        return uploadImages::uploadFiles($file);
    }

    public function base64_image(Request $request)
    {
        $image = $request->base64;
        return uploadImages::UploadBase64Images($image);
    }

    public function delete(Request $request)
    {
        $image = explode('/', $request->nombre);        
        Storage::disk('uploads')->delete($image[1].'/'.$image[2]);
        return $request->nombre;
    }
}
