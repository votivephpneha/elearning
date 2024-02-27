<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuth\AuthController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [HomeController::class, 'index'])->name("login");
Route::get('/register', [HomeController::class, 'register'])->name("register");
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [Authcontroller::class, 'login'])->name("login.admin");

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name("admin.dashboard");







Route::post('/submit_registration', [HomeController::class, 'submit_registration'])->name("submit_registration");
Route::post('/submit_login', [HomeController::class, 'submit_login'])->name("submit_login");
Route::get('/user_dashboard', [HomeController::class, 'user_dashboard'])->name("user_dashboard");








