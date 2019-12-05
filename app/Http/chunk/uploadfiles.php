<?php

namespace App\Http\Chunk\UploadFiles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class uploadImages {

    public static function uploadFiles($file) {
        if(is_array($file)){
            $stored = [];
            foreach($file as $f) {
                $nombre_unico = 'files/'.uniqid().'.'.$f->getClientOriginalExtension();
                Storage::disk('uploads')->put($nombre_unico,  File::get($f));
                $stored[] = 'uploads/'.$nombre_unico;
            }
            return implode(',', $stored);
        } else {            
            $nombre_unico = 'files/'.uniqid().'.'.$file->getClientOriginalExtension();
            Storage::disk('uploads')->put($nombre_unico,  File::get($file));
            return 'uploads/'.$nombre_unico;
        }
    }
    public static function UploadBase64Images($images) {
        if(is_array($images)){
            $stored = [];
            foreach($images as $image){
                
                $image = explode(',', $image['src']);
                $image = str_replace(' ', '+', $image);
                $nombre_unico = 'images/'.uniqid().'.'.'png';
                Storage::disk('uploads')->put($nombre_unico,  base64_decode($image[1]));
                $stored[] = 'uploads/'.$nombre_unico;
            }
            return $stored;
        } else {
            $images = explode(',', $images);
            $images = str_replace(' ', '+', $images);
            $nombre_unico = 'images/'.uniqid().'.'.'png';
            Storage::disk('uploads')->put($nombre_unico,  base64_decode($images[1]));
            return 'uploads/'.$nombre_unico;
        }
    }
};