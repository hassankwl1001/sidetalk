<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
trait FileUploadTrait
{
    public function uploadSingleImage(Request $request, $imageName){

        if($request->has($imageName)){

            $filNameWithExtention = $request->file($imageName)->getClientOriginalName();
            $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file($imageName)->getClientOriginalExtension();
            $image = $fileName . '_' . time() . '.' . $extention;
            $path = $request->file($imageName)->storeAs('media', $image);
            // $path = $request->file($imageName)->storeAs('pages', $image, 's3');
            // Storage::disk('s3')->setVisibility($path, 'public');
            return $image;
        }

        return null;

    }

    public function uploadMedia(Request $request, $imageName){

        if($request->has($imageName)){
            $filNameWithExtention = $request->file($imageName)->getClientOriginalName();
            $fileName = pathinfo($filNameWithExtention, PATHINFO_FILENAME);
            $extention = $request->file($imageName)->getClientOriginalExtension();
            $image = $fileName . '_' . time() . '.' . $extention;
            $path = $request->file($imageName)->storeAs('media', $image);
            // $path = $request->file($imageName)->storeAs('media', $image, 's3');
            // Storage::disk('s3')->setVisibility($path, 'public');
            return $image;
        }

        return null;
    }
}
