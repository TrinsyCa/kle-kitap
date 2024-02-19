<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ProfileController extends Controller
{
    function profileUrl()
    {
        if(Auth::check())
        {
            return redirect()->route("showProfile", ["username" => Auth::user()->username]);
        }
        else
        {
            return redirect()->to("login");
        }
    }
    function showProfile(string $username)
    {
        if($username)
        {
            $settings = Config::get("settings");
        
            $userID = User::where("username", $username)->pluck("id")->first();
            $user = User::where("id", $userID)->first();

            if(Auth::check())
            {
                if ($user && (Auth::id() == $user->id && Auth::user()->username == $user->username && Auth::user()->email == $user->email && Auth::user()->password == $user->password)) {
                    $user->is_me = true;
                } else {
                    $user->is_me = false;
                }

                $userID = $user ? $user->id : null;
                $products = Products::orderBy("id","DESC")->where("userID", $userID)->get();
            }
            else
            {
                $userID = $user ? $user->id : null;
                $products = Products::orderBy("id","DESC")->where("userID", $userID)->take(2)->get();
            }
            return view("profile",compact("user", "settings", "products"));
        }
        else
        {
            return redirect()->to("login");
        }
    }

    function create_page()
    {
        $settings = Config::get("settings");
        return view("myprofile.products.create", compact("settings"));
    }
}
