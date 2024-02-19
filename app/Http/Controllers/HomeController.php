<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    function index()
    {
        $settings = Config::get("settings");
        if(Auth::check())
        {
            $products = Products::orderBy('created_at', 'DESC')->get();
        }
        else
        {
            $products = Products::orderBy('created_at','DESC')->take(3)->get();
        }
        return view("index", compact("settings", "products"));
    }
}
