<?php
namespace App\Services;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use stdClass;

class UtilsService {
    static function deleteFile($path) {
        try {
            if(Storage::disk(env('APP_DEFAULT_STORAGE'))->exists($path)){
                Storage::disk(env('APP_DEFAULT_STORAGE'))->delete($path);
                return true;
            }
            return true;
         } catch(\Exception $e) {
            return false;
        }
    }
    /**
     * saveImageBase64
     * This functions convert string base64 to file, the string format
     *
     * @param [type] $stringBase64
     * @param string $path dir to save file
     * @return object
     */
    static function saveImageBase64($stringBase64,$path="assets/data/uploads/") {
        try {
            $image_parts = explode(";base64,", $stringBase64);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $filename = Str::random(16).'.'.$image_type;
            $fileFullPath =  $path.$filename;
            Storage::disk(env('APP_DEFAULT_STORAGE'))->put($fileFullPath, base64_decode($image_parts[1]));
            $data = new stdClass();
            $data->type = $image_type;
            $data->name = $filename;
            $data->path = $fileFullPath;
            return $data;
        } catch(\Exception $e) {
            return false;
        }
    }
}
