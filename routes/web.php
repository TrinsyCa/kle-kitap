<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class,"index"])->name("home");

//Sign
Route::get("login", [AccountController::class,"login"])->name("login");
Route::post("login", [AccountController::class,"loginFunc"])->name("loginFunc");
Route::get("logout", [AccountController::class,"logout"])->name("logout");
Route::get("signup", [AccountController::class,"signup"])->name("signup");
Route::post("signup", [AccountController::class,"signupFunc"])->name("signupFunc");
//Sign

//Product
Route::get('p/{link}', [ProductsController::class, "show"])->name("showProduct");
//Product

// Manage Products
Route::get("profile/product/", [ProductsController::class, "products_page"]);
Route::get("profile/product/edit/{id}", [ProductsController::class, "update_page"])->name("editProduct");
Route::get("profile/product/add", [ProductsController::class, "create_page"])->name("createProduct");

Route::put("profile/product/edit/{id}", [ProductsController::class, "update"])->name("updateProduct");
Route::post("profile/product/add", [ProductsController::class, "create"]);
Route::delete("profile/product/destroy/{id}", [ProductsController::class, "destroy"])->name("destroyProduct");
// Manage Products

// Profile
Route::get("profile/", [ProfileController::class, "profileUrl"]);
Route::get("{username}", [ProfileController::class, "showProfile"])->name("showProfile");
// Profile