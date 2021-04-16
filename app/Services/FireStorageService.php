<?php
namespace App\Services;
use Illuminate\Support\Str;
use App\Services\UtilsService;
use Illuminate\Support\Facades\Storage;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FireStorageService {

    static function upload($path="",$name="",$source) {
        try {
            $storage = Firebase::storage();
            $bucketClient = $storage->getStorageClient();
            $bucket = $bucketClient->bucket(env('FIREBASE_STORAGE_BUCKET'));
            $file = Storage::disk(env('APP_DEFAULT_STORAGE'))->get($source);
            $object = $bucket->upload($file, [
                'name' => $path."/".($name!=""?$name:Str::random(15))
            ]);
            $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
            return (object)[
                'id'    => $object->info()['name'],
                'src'   => $object->info()['mediaLink']
            ];
        } catch(\Exception $e) {
            return false;
        }
    }
    static function uploadWithReplace($path="",$name="",$source,$replaceFile=null) {
        try {
            $storage = Firebase::storage();
            $bucketClient = $storage->getStorageClient();
            $bucket = $bucketClient->bucket(env('FIREBASE_STORAGE_BUCKET'));
            $file = Storage::disk(env('APP_DEFAULT_STORAGE'))->get($source);
            $object = $bucket->upload($file, [
                'name' => $path."/".($name!=""?$name:Str::random(15))
            ]);
            $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
            if($replaceFile!=null) {
                $fs = new FireStorageService();
                $fs::delete($replaceFile);
            }
            return (object)[
                'id'    => $object->info()['name'],
                'src'   => $object->info()['mediaLink']
            ];
        } catch(\Exception $e) {
            return false;
        }
    }
    static function uploadWithReplaceAndDeleteLocalFile($path="",$name="",$source,$fileReplace=null) {
        try {
            $storage = Firebase::storage();
            $bucketClient = $storage->getStorageClient();
            $bucket = $bucketClient->bucket(env('FIREBASE_STORAGE_BUCKET'));
            $file = Storage::disk(env('APP_DEFAULT_STORAGE'))->get($source);
            $object = $bucket->upload($file, [
                'name' => $path."/".($name!=""?$name:Str::random(15))
            ]);
            $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
            if($fileReplace!=null) {
                $fs = new FireStorageService();
                $fs::delete($fileReplace);
            }
            UtilsService::deleteFile($source);
            return (object)[
                'id'    => $object->info()['name'],
                'src'   => $object->info()['mediaLink']
            ];
        } catch(\Exception $e) {
            dd($e->getMessage());
            return false;
        }
    }
    static function uploadWithDeleteLocalFile($path="",$name="",$source) {
        try {
            $storage = Firebase::storage();
            $bucketClient = $storage->getStorageClient();
            $bucket = $bucketClient->bucket(env('FIREBASE_STORAGE_BUCKET'));
            $file = Storage::disk(env('APP_DEFAULT_STORAGE'))->get($source);
            $object = $bucket->upload($file, [
                'name' => $path."/".($name!=""?$name:Str::random(15))
            ]);
            $object->update(['acl' => []], ['predefinedAcl' => 'PUBLICREAD']);
            UtilsService::deleteFile($source);
            return (object)[
                'id'    => $object->info()['name'],
                'src'   => $object->info()['mediaLink']
            ];
        } catch(\Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    static function delete($id) {
        try {
            $storage = Firebase::storage();
            $bucketClient = $storage->getStorageClient();
            $bucket = $bucketClient->bucket(env('FIREBASE_STORAGE_BUCKET'));
            $object = $bucket->object($id);
            $object->delete();
            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}
