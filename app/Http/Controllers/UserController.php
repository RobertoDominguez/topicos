<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){
        $error='Error al iniciar sesión: ';
        if (is_null($request->email) || is_null($request->password)){
            return response()->json($error.'Verifica los datos', 500);
        }

        $user=User::where('email',$request->email)->first();
        if (is_null($user)){
            return response()->json($error.'No existe el usuario', 500); 
        }

        if (Hash::check($request->password, $user->password) && !$user->accepted==true){
            return response()->json($user, 200);
        }else{
            return response()->json($error.'Contraseña incorrecta', 500);
        }

        return response()->json($error.'El usuario no ha sido aceptado', 500); 
    }

    public function signup(Request $request)
    {

        if (is_null($request->name) || is_null($request->email) || is_null($request->last_name) 
        || is_null($request->password) || is_null($request->password_confirm) || is_null($request->is_employee)
        || is_null($request->is_business)  ){
             return response()->json($request,500);
        }


        $email=User::where('email',$request->email)->first();

        if (!is_null($email)){
            return response()->json('Ya existe este email',500);
        }

        if ($request->password==$request->password_confirm){
            
        }else{
            return response()->json('La confirmacion de la contraseña es incorrecta',500);  
        }

        $datos=[
            'name'=>$request->name,
            'email'=>$request->email,
            'last_name'=>$request->last_name,
            'is_employee'=>$request->is_employee,
            'is_business'=>$request->is_business,
            'accepted'=>false,
            'rejected'=>false,
            'password'=>Hash::make($request->password),
        ];

        $user=User::create($datos);

        if (is_null($user)){  
            return response()->json('Error al hacer la peticion de los datos',500);
        }

        return response()->json($user,200);  
    }



}
