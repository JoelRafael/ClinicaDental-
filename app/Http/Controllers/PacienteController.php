<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Paciente;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;

class PacienteController extends Controller
{

    public function index()
    {
        $paciente=Paciente::all();

        return response()->json([
            'message'=>$paciente
        ],201);
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=Auth::User();
        $user_id=$user->id;

$bo=1;
        $validator=Validator::make($request->all(),[
     'nombre'=>['required', 'string', 'max:50'],
     'apellido'=>['required', 'string', 'max:50'],
     'pais_nacimiento'=>['required', 'string', 'max:50'],
     'ciudad_nacimiento'=>['required', 'string', 'max:50'],
     'documento'=>['required', 'string', 'max:50'],
     'direccion'=>['required', 'string', 'max:50'],
     'telefono'=>['required', 'string', 'max:15'],
     'telefono_emergencia'=>['required', 'string', 'max:50']
]);
if($validator->fails()){

    return response()->json([
        'succes'=>false,
        'error'=>$validator->errors()
    ], 400);
}


$paciente=Paciente::create([
    'user_id'=>$user_id,
    'nombre'=>$request->get('nombre'),
    'apellido'=>$request->get('apellido'),
    'pais_nacimiento'=>$request->get('pais_nacimiento'),
    'ciudad_nacimiento'=>$request->get('ciudad_nacimiento'),
    'documento'=>$request->get('documento'),
    'direccion'=>$request->get('direccion'),
    'telefono'=>$request->get('telefono'),
    'telefono_emergencia'=>$request->get('telefono_emergencia')
]);

return response()->json([
    'succes'=>true,
    'message'=>'Successfully created patient'
], 200);

    }


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
