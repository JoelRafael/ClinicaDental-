<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
private $nombre;
private $apellido;
private $direccion;
private $email;
private $password;

    public function Createuser(Request $request ){
$validator=Validator::make($request->all(),[
'nombre'=>['required', 'string', 'max:50'],
'apellido'=>['required', 'string', 'max:50'],
'direccion'=>['required', 'string', 'max:50'],
'email'=>['required', 'string', 'email','max:255', 'unique:users'],
'password'=>['required', 'string', 'min:8','max:50']

]);
if($validator->fails()){
    return response()->json([
        "error"=>$validator->errors()
    ], 404);

}
$nombre=$request->get('nombre');
$apellido=$request->get('apellido');
$direccion=$request->get('direccion');
$email=$request->get('email');
$password=$request->get('password');

//--------------Insertando en la base de datos--------------------------
/*$user=new User;
$user->nombre=$nombre;
$user->apellido=$apellido;
$user->direccion=$direccion;
$user->email=$email;
$user=Hash::make($password);
$user->save();*/
$user=User::create([
    'nombre'=>$nombre,
    'apellido'=>$apellido,
    'direccion'=>$direccion,
    'email'=>$email,
    'password'=>Hash::make($password),

]);
//$user->save();
//$user=User::create($request->all());
return response()->json([
    'menssage'=>'Usuario creado con exito',
], 202);
    }

    public function login(Request $request){
$credentia=$request->only('email', 'password');
$validation=Validator::make($credentia,[
    'email'=>'required|email',
    'password'=>'required'
]);
if($validation->fails()){
    return response()->json([
        'succes'=>false,
        'menssage'=>'Erro en la validacion',
        'erros'=>$validation->errors()
    ], 422);
}
/*$credentia->exist($credentia);
if($credentia){

}*/
$token=JWTAuth::attempt($credentia);
$user=Auth::User();
$user->oneline=1;
$user->save();
if($token){
    return response()->json([
        'succes'=>true,
        'toke'=> $token,
        'user'=>User::where('email', $credentia['email'])->get()->first()
    ], 200);

}
else{
    return response()->json([
        'succes'=>false,
        'menssage'=>'Erro token',
        'erros'=>$validation->errors()
    ], 401);
}
    }




public function refreshtoken(){
    $token=JWTAuth::getToken();
    try{
        $token=JWTAuth::refresh($token);
        return response()->json([
            'succes'=>true,
            'toke'=> $token
           ], 200);

    }catch(TokenExpiredException $ex){

        return response()->json([
            'succes'=>false,
            'menssage'=>'El token ha expirado (expired)!'

        ], 422);
    }

    catch(TokenBlacklistedException $ex){
        return response()->json([
            'succes'=>false,
            'menssage'=>'Hubo un error en frescar el token (blacklisted)!'

        ], 422);
    }
}

public function expire(){
    $token=JWTAuth::getToken();
    try{
        JWTAuth::invalidate($token);
        $user=Auth::User();
$user->oneline=0;
$user->save();
        return response()->json([
            'succes'=>true,
            'menssage'=>'Session cerrada con exito'

        ], 200);

    }catch(JWTException $ex){
        return response()->json([
            'succes'=>false,
            'menssage'=>'Fallido logout por favor intentalo nuevamente!'

        ], 200);

    }
}




public function veroneline(){


  
        return response()->json([
            'mensaje'=>User::where('oneline', 1)->get('email')
        ],200);
   
}
}
