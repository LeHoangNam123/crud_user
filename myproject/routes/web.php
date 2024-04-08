<?php

use App\Http\Controllers\UserControllers;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserControllers::class , 'index'])->name('index');

//login
Route::get('/login', [UserControllers::class , 'login'])->name('login');
Route::post('/login', [UserControllers::class , 'customLogin'])->name('custom.login');
Route::get('logout', [UserControllers::class , 'logout'])->name('logout');


Route::get('/register', [UserControllers::class , 'register'])->name('register'); //phương thức trả về view
Route::post('/register', [UserControllers::class , 'customRegister'])->name('custom.register');
//CRUD 
Route::post('delete-user/{user_id}', [UserControllers::class, 'delete'])->name('users.delete');
Route::get('edit-user/{user_id}', [UserControllers::class, 'edit'])->name('users.edit');
Route::post('update-user/{user_id}', [UserControllers::class, 'update'])->name('users.update');
Route::get('show-user/{user_id}', [UserControllers::class, 'show'])->name('users.show');


