<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');


Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::get('roles', function () {
    return view('role');
});


Route::get('usuarios', function () {
    return view('user');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('permisos', 'PermissionController@index');
    Route::get('permisos/data', 'PermissionController@getdata');
    Route::resource('categoria', 'CategorieController')->except([
        'show', 'create', 'edit'
    ]);
    Route::get('categoria/data', 'CategorieController@getdata');
    Route::put('categoria/available/{id}', 'CategorieController@available');
    Route::put('categoria/locked/{id}', 'CategorieController@locked');
});