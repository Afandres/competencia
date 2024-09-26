<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AcademiController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\monitoringController;

use App\Http\Controllers\BicycleController;
use App\Http\Controllers\eventController;
use App\Http\Controllers\CatalogoController;


Route::get('/',[catalogoController::class,"index"]);


Route::get('/user/register/index', function () {
    return view('auth.register');
})->name('user.register');

Route::controller(UserController::class)->group(function () {

    Route::post('/user/register/store', 'register_store')->name('user.register.store');
    Route::get('/user/register/search_person', 'search_person')->name('user.register.search_person');

});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {

    Route::controller(UserController::class)->group(function () {

        Route::get('/dashboard', 'dashboard')->name('dashboard');

        Route::get('/user/index', 'index')->name('user.index');

        Route::post('/logout', [UserController::class, 'destroy'])->name('logout');

    });

    Route::controller(AcademiController::class)->group(function () {

        Route::get('/program/index', 'program_index')->name('program.index');
        Route::post('/program/store', 'program_store')->name('program.store');
        Route::post('program/update/{id}', 'program_update')->name('program.update');
        Route::delete('program/destroy/{id}', 'program_destroy')->name('program.destroy');

        Route::get('/course/index', 'course_index')->name('course.index');
        Route::post('/course/store', 'course_store')->name('course.store');
        Route::post('course/update/{id}', 'course_update')->name('course.update');
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

    Route::controller(monitoringController::class)->group(function () {

        Route::get('/monitoring/bisicles', 'index_bisicle')->name('monitoringBisicles');
        Route::get('/monitoring/event', 'index_event')->name('monitoringEvent');

    });


    Route::controller(BicycleController::class)->group(function () {
        Route::get('/bicycle/index', 'bicycle_index')->name('bicycle.index');
        Route::get('/bicycle/create', 'bicycle_create')->name('bicycle.create');
        Route::post('/bicycle/store', 'bicycle_store')->name('bicycle.store');
        Route::get('/bicycle/edit/{id}', 'bicycle_edit')->name('bicycle.edit');
        Route::put('/bicycle/update/{id}', [BicycleController::class, 'bicycle_update'])->name('bicycle.update');
        Route::delete('/bicycle/destroy/{id}', 'bicycle_destroy')->name('bicycle.destroy');

        Route::get('/rental/index', 'rental_index')->name('rental.index');
        Route::get('/rental/create/{id}', 'rental_create')->name('rental.create');
        Route::post('/rental/store', 'rental_store')->name('rental.store');

        Route::get('/rental/devolution/{id}', 'rental_devolution')->name('rental.devolution');
        Route::post('/rental/devolution/store', 'rental_devolution_store')->name('rental.devolution.store');

        Route::get('/rental/invoices', 'rental_invoices')->name('rental.invoices');

        Route::get('/rental/earnings', 'monthly_earnings')->name('rental.earnings');


    });



    Route::controller(eventController::class)->group(function () {
        Route::get('/event/index', 'event_index')->name('event');
        Route::get('/event/create', 'event_create')->name('EventCreate');
        Route::post('/event/store', 'event_store')->name('eventStore');
        Route::get('/add-ubicacion/{id}', [eventController::class, 'ubicacion'])->name('addUbicacion');
        // Ruta para mostrar el formulario de actualización de imagen (GET)
Route::get('/events/{id}/form-update-image', [EventController::class, 'showUpdateImageForm'])->name('events.formUpdateImage');

// Ruta para procesar el formulario de actualización de imagen (POST)
Route::post('/events/{id}/update-image', [EventController::class, 'updateImage'])->name('events.updateImage');
        Route::post('/events/{id}/update-image', [EventController::class, 'updateImage'])->name('events.updateImage');
        Route::post('/event/addUbicacionn', 'event_store_ubicacion')->name('addUbicacionStore');
        Route::get('/event/edit/{id}', 'event_edit')->name('eventEdit');
        Route::put('/event/update/{id}', [eventController::class, 'event_update'])->name('eventUpdate');
        Route::delete('/event/destroy/{id}', 'event_destroy')->name('eventDestroy');
    });

    Route::controller(ApprenticeController::class)->group(function(){

        Route::get('dashboard/apprentices',  'index')->name('apprentices.index');
        Route::post('dashboard/apprentices', 'store')->name('apprentices.store');


    });

});
