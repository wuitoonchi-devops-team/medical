<?php

namespace App\Observers;
use App\Services\FireStorageService;
use App\Models\Jugador;
class JugadorObserver
{
    var $firebasePath = "jugadores";
    public function __construct() {
        $this->firestore     = app('firebase.firestore');
        $this->firestore     = $this->firestore->database();
    }

    public function created(Jugador $item) {

    }

    function updated(Jugador $item) {

    }

    function deleting(Jugador $item) {

    }

    function deleted(Jugador $item) {
        try {
            FireStorageService::delete($item->imagen_firebase_uid);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}
