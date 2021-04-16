<?php

namespace App\Observers;
use App\Services\FireStorageService;
use App\Models\Estadio;
class EstadioObserver
{
    var $firebasePath = "estadios";
    public function __construct() {
        $this->firestore     = app('firebase.firestore');
        $this->firestore     = $this->firestore->database();
    }

    public function created(Estadio $item) {

    }

    function updated(Estadio $item) {

    }

    function deleting(Estadio $item) {

    }

    function deleted(Estadio $item) {
        try {
            FireStorageService::delete($item->imagen_firebase_uid);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
