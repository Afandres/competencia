<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AcademiController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::controller(UserController::class)->group(function () {

        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/user/index', 'index')->name('user.index');
       
    });

    Route::controller(AcademiController::class)->group(function () {
    
        Route::get('/program/index', 'program_index')->name('program.index');
        Route::post('/program/store', 'program_store')->name('program.store'); 
        Route::post('program/update', 'program_update')->name('program.update'); 
        Route::delete('program/destroy/{id}', 'program_destroy')->name('program.destroy'); 

        Route::get('/course/index', 'course_index')->name('course.index');
        Route::post('/course/store', 'course_store')->name('course.store');
        Route::post('course/update', 'course_update')->name('course.update');
        Route::delete('course/destroy/{id}', 'course_destroy')->name('course.destroy');

        Route::get('/apprentice/index', 'apprentice_index')->name('apprentice.index');
        Route::post('/apprentice/store', 'apprentice_store')->name('apprentice.store');
        Route::post('apprentice/update', 'apprentice_update')->name('apprentice.update');
        Route::delete('apprentice/destroy/{id}', 'apprentice_destroy')->name('apprentice.destroy'); 

        Route::get('/official/index', 'official_index')->name('official.index');
        Route::post('/official/store', 'official_store')->name('official.store');
        Route::post('official/update', 'official_update')->name('official.update');
        Route::delete('official/destroy/{id}', 'official_destroy')->name('official.destroy'); 

    });
});
