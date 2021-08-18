<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');   //

//Specialty

Route::get('/specialties', 'SpecialtyController@index');
Route::get('/specialties/create', 'SpecialtyController@create');     // formulario de registro
Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
Route::post('/specialties', 'SpecialtyController@store');    // envio del formulario
Route::put('/specialties/{specialty}', 'SpecialtyController@update');
Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');

// Doctors

Route::resource('doctors','DoctorController');

// Pateints


