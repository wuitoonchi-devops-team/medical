<?php

namespace App\Http\Controllers\Dashboard\Configuracion;

use App\Http\Controllers\Controller;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    var $request;
    var $model;
    var $folder='dashboard/configuracion';
    var $path='assets/data';
    public function __construct(Request $request) {
        $this->request = $request;
        $this->model = new Configuracion();
    }
    
    function index($index=null) {
        return view($this->folder.'.index',[
              'jsControllers'=>[
                  0 => 'app/'.$this->folder.'/HomeController.js',
                ],
               'cssStyles' => [
                  0 => 'app/'.$this->folder.'/style.css'
               ],
               'configuracion' => $this->model->first()
         ]);
    }
    
    public function update($id=null) {
        try {
            DB::beginTransaction();
            $data = $this->request->all();
            $itemData = $this->model->first();
            if(isset($data['password'])) {
                $user = User::find(auth()->user()->id);
                $user->password = Hash::make($data['password']);
                $user->save();
            }
            if($itemData) {
                if($itemData->fill($data)->save()) {
                    $logo = $this->request->file('logo');
                        if($logo) {
                            $fileDlete = $itemData->logo;
                            $fileName   = time().rand(111,699).'.' .$logo->getClientOriginalExtension();
                            $filePath = $this->request->logo->storeAs($this->path, $fileName, 'public');
                            $itemData->logo = 'storage/'.$filePath;
                            if(!$itemData->save()) {
                                return $this->errorResponse([
                                    'err'=>true,
                                    'message'=> 'No ha sido posible cargar logo.'
                                ]);
                            }
                            if(file_exists($fileDlete)) {
                                unlink($fileDlete);
                            }
                        }
                        DB::commit();
                        return $this->successResponse([
                                'err' => false,
                                'message' => 'Datos actualizados correctamente.'
                        ]);
                } else {
                return $this->successResponse([
                        'err' => false,
                        'message' => 'Ningún dato ha cambiado.'
                ]);
                }
            } else {
                $itemData = new Configuracion();
                $itemData->create($data);
                DB::commit();
                return $this->successResponse([
                        'err' => false,
                        'message' => 'Datos actualizados correctamente.'
                ]);
            }
        }
        catch(\Exception $e){
          echo $e->getMessage();
          DB::rollback();
          return $this->errorResponse([
            'err' =>true,
            'message' => 'No ha sido posible editar registro, por favor verifique su información e intente nuevamente.'
          ]);
        }
    }
    
}
