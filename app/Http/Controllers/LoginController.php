<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class LoginController extends Controller
{
    public function register(Request $request){
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        
        Auth::login($user);
        return redirect(route('privada'));
    }

    public function login(Request $request){
        $credenciales = [
            "email" => $request->email,
            "password" => $request->password
        ];

        $remember = ($request->has('remember') ? true : false);

        if(Auth::attempt($credenciales,$remember)){
            $request->session()->regenerate();
            return redirect(route('privada'));
        }else{
            return redirect()->intended(('login'));
        }
    }

    public function logout(Request $request){
        Log::info('Resultado de request', ['request' => $request]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate(); //Reiniciar la sesion


        return redirect(route('login'));

    }
}
