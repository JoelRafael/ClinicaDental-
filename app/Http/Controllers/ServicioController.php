<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\Servicio;

class ServicioController extends Controller
{

public function verservicios(){

    $servicios=Servicio::all();

    return response()->json([
'mensaje'=>$servicios
    ], 200);
}


public function nuevoservicio(Request $request){

$validator=Validator::make($request->all(),[

'nombre'=>['required', 'string', 'unique:servicios'],
'precio'=>['required', 'string']

]);

if($validator->fails()){

    return response()->json([

        'mensaje'=>$validator->errors()
    ],400);
}


$service=Servicio::create([
    'nombre'=>$request->get('nombre'),
    'precio'=>$request->get('precio')
]);


return response()->json([
    'mensaje'=>'Servicio guardado con exito'
], 200);

}


}
