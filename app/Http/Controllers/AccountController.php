<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    function login()
    {
        if(Auth::check())
        {
            return redirect()->to("/");
        }
        else
        {
            $settings = Config::get("settings");
            return view("account.login", compact("settings"));
        }
    }
    function loginFunc(Request $request)
    {
        if($request->method() == "POST")
        {
            $request->validate([
                "email" => "required",
                "password" => "required|min:6|max:50"
            ]);
        
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            {
                $minutes = 60 * 24 * 365 * 10; // 10 Senelik Oturum
                cookie()->queue('email', $request->email, $minutes);
                cookie()->queue('password', $request->password, $minutes);
        
                return redirect()->to("/");
            }
        }
    
        return redirect()->back()->withErrors("Kullanıcı Adı veya Şifre Yanlış");
    }
    function signup()
    {
        if(Auth::check())
        {
            return redirect()->to("/");
        }
        else
        {
            $settings = Config::get("settings");
            return view("account.signup", compact("settings"));
        }
    }
    function signupFunc(Request $request)
    {
        if($request->method() == "POST")
        {
            $request->validate([
                "name_surname" => "required|max:30",
                "email" => "required|max:255",
                "password" => "required|min:6|max:50",
                "password_verify" => "required|min:6|max:50"
            ],
            [
                "name_surname.required" => "Ad Soyad Boş Geçilemez",
                "email.required" => "E-Posta Boş Geçilemez",
                "password.required" => "Şifre Boş Geçilemez"
            ]);

            if($request->password != $request->password_verify)
            {
                return redirect()->back();
            }
    
            $characters = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $username = '';
            do {
                $username = '';
                for ($i = 0; $i < 6; $i++) {
                    $username .= $characters[random_int(0, strlen($characters) - 1)];
                }
            } while (User::where('username', $username)->exists());
    
            $hashedPassword = Hash::make($request->password);
    
            $user = User::create([
                "email" => $request->email,
                "password" => $hashedPassword,
                "username" => $username,
                "name_surname" => $request->name_surname
            ]);
    
            Auth::login($user);

            /* if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                $minutes = 60 * 24 * 365 * 10; // 10 Senelik Oturum
                cookie()->queue('email', $request->email, $minutes);
                cookie()->queue('password', $request->password, $minutes);
        
                return redirect()->to("/");
            } */
        }

        return redirect()->to("/");
    }
    function logout(Request $request)
    {
        Auth::logout();

        return redirect()->to("login");
    }
}
