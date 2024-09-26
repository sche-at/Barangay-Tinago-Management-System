<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PrenatalController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\signupController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\ImmunizationController;

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
    return view('admin.home');
});

//SIGN UP
Route::get('/signup', [signupController::class, 'register']);

Route::post('/signup', [SignupController::class, 'create']);

Route::post('/home', [SignupController::class, 'home']);




//admin

    Route::get('/home', [AdminController::class, 'home'])->name('admin.home');
    Route::get('/residence', [AdminController::class, 'residence'])->name('admin.residence');
    Route::get('/finance', [AdminController::class, 'finance'])->name('admin.finance');
    Route::get('/event', [AdminController::class, 'event'])->name('admin.event');
    Route::get('/immunization', [AdminController::class, 'health'])->name('admin.health');
    
 


//residence
Route::get('/blotters', [ResidenceController::class, 'record'])->name('admin.blotters');
Route::get('/update', [ResidenceController::class, 'update'])->name('admin.update');
Route::get('/list', [ResidenceController::class, 'list'])->name('admin.list');
// Route::get('/store', [ResidenceController::class, 'store'])->name('residence.store');

// Route for adding a new resident
Route::post('/residence', [ResidenceController::class, 'store'])->name('residence.store');


// Route for displaying the list of residents
Route::get('/residence-list', [ResidenceController::class, 'list']);

//Financial
Route::get('/budget', [BudgetController::class, 'budget'])->name('admin.budget');
Route::get('/expense', [BudgetController::class, 'expense'])->name('admin.expense');

//event
Route::post('/save-events/{type_of_event}/{date_and_venue}/{tasks_assigned}', [EventController::class, 'saveEvent'])->name('save-event');
//Route::post('/save-events', [EventController::class, 'saveEvent'])->name('save-event');
Route::delete('/delete-event/{eventSched}', [EventController::class, 'destroy'])->name('admin_delete_event');

//health
Route::get('/immunization', [ImmunizationController::class, 'immune'])->name('admin.immunization');
Route::get('/prenatal', [ImmunizationController::class, 'natal'])->name('admin.prenatal');
Route::get('/referral', [ImmunizationController::class, 'referall'])->name('admin.referral');
//prenatal
Route::post('/save-prenatals/{date}/{time}/{location}/{activity}', [PrenatalController::class, 'savePrenatal'])->name('save-prenatal');
Route::delete('/delete-prenatal/{prenatal}', [PrenatalController::class, 'destroy'])->name('admin_delete_prenatal');


//client
Route::get('/base', [ClientController::class, 'base'])->name('clients.base');
Route::get('/eventannounce', [ClientController::class, 'eventannounce'])->name('clients.eventannounce');
Route::get('/healthannounce', [ClientController::class, 'healthannounce'])->name('clients.healthannounce');
Route::get('/history', [ClientController::class, 'history'])->name('clients.history');
Route::get('/complaints', [ClientController::class, 'complaints'])->name('clients.complaints');