<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function login(Request $request) {
        // validación para informacion
        $messages = [
            'user.required' => 'El usuario es requerido.',
        ];

        $rules = array(
            'user' => 'required', // validación para que input no sea null - |email
        );

        // se ejecuta la validacion
        $validator = Validator::make($request->all(), $rules, $messages);

        //si la validación falla retornará error
        if ($validator->fails()) {
        } else {
            $user = User::where('email', $request->user)->first();

            //validación de existencia de usuario
            if ($user !== null) {
                //si el usuario existe
                //se hará el login
                Auth::guard()->login($user);
            } else {
                // si usuario no existe, se procederá a crearlo e iniciar sesión
                //Auth::guard()->logout();

                $user = User::create([
                    'email' => $request->user,
                ]);

                Auth::guard()->login($user);
            }
        }

        if ($validator->messages()->isEmpty()) {
            return response()->json([
                'login' => Auth::user() ? true:false,
            ], 200);
        }

        return response()->json([
            'messages' => $validator->messages(),
        ], 400);
    }

    public function logged() {
        return response()->json([
            'login' => Auth::user() ? true:false,
        ], 200);
    }

    public function logout() {
        return Auth::guard()->logout();
    }
}