<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');   

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function () {
   //Specialty
    Route::get('/specialties', 'SpecialtyController@index');
    Route::get('/specialties/create', 'SpecialtyController@create');     // formulario de registro
    Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit');
    Route::post('/specialties', 'SpecialtyController@store');    // envio del formulario
    Route::put('/specialties/{specialty}', 'SpecialtyController@update');
    Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy');
    // Doctor
    Route::resource('doctors','DoctorController');
    // Pateints
    Route::resource('patients','PatientController');
});  

    Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function () {
        Route::get('/schedule', 'ScheduleController@edit');
        Route::post('/schedule', 'ScheduleController@store');
        
});

    Route::middleware('auth')->group(function(){
         Route::get('/appointments/create', 'AppointmentController@create');
         Route::post('/appointments', 'AppointmentController@store');

         //JSON
         Route::get('/specialties/{specialty}/doctors','Api\SpecialtyController@doctors');

    });

     
     
     


