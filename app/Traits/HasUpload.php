<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

trait HasUpload
{
    public static function uploadImage($request, $path, $storepath, $directory)
    {
        if(!File::isDirectory($path)) {
            $path = Storage::disk('public')->makeDirectory($directory);
        }
        $image = null;
        if($request->file('inpFileImage')) {

            $file = $request->file('inpFileImage');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs($storepath, $filename);
            $image = $filename;
        }

        return $image;
    }
}
