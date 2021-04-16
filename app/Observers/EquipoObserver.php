<?php

namespace App\Observers;
use App\Services\FireStorageService;
use App\Models\Equipo;
class EquipoObserver
{
    var $firebasePath = "equipos";
    public function __construct() {
        $this->firestore     = app('firebase.firestore');
        $this->firestore     = $this->firestore->database();
    }

    public function created(Equipo $item) {

    }

    function updated(Equipo $item) {

    }

    function deleting(Equipo $item) {

    }

    function deleted(Equipo $item) {
        try {
            FireStorageService::delete($item->imagen_firebase_uid);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
