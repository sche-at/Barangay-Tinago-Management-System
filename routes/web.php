<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResidenceController;
use App\Http\Controllers\BlooterController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ImmunizeController;
use App\Http\Controllers\PrenatalController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use App\Models\Budget;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/about-us', [DashboardController::class, 'index'])->name('dashboard.about-us');
    Route::get('/viewprofile', [DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/changepassword', [DashboardController::class, 'changepassword'])->name('dashboard.changepassword');
    Route::post('/change-password', [DashboardController::class, 'updatePassword'])->name('update.password');


    Route::get('/addresidence', [ResidenceController::class, 'index'])->name('residence.addresidence');
    Route::post('/residence/store', [ResidenceController::class, 'store'])->name('residence.store');
    Route::get('/residenceview', [ResidenceController::class, 'residenceview'])->name('residence.view');
    // Route::post('residences/{id}', [ResidenceController::class, 'update'])->name('residences.update');
    // Route::delete('residences/{id}', [ResidenceController::class, 'destroy'])->name('residences.destroy');
    // Route::get('residences/view', [ResidenceController::class, 'residenceview'])->name('residences.view');

    Route::get('residences/{id}', [ResidenceController::class, 'show'])->name('residences.show');
    Route::post('residences', [ResidenceController::class, 'store'])->name('residences.store');
    // Route::post('residences/{id}', [ResidenceController::class, 'update'])->name('residences.update');
    Route::put('residences/{id}', [ResidenceController::class, 'update'])->name('residences.update'); // This should exist
    Route::delete('residencesdelete/{id}', [ResidenceController::class, 'destroy'])->name('residences.destroy');

    // Routes for residences
    Route::get('/residences', [ResidenceController::class, 'index'])->name('residenceview');

Route::get('/residences/archived', [ResidenceController::class, 'archived'])->name('residences.archived');
Route::post('/residences/{residence}/restore', [ResidenceController::class, 'restore'])->name('residences.restore');
Route::delete('/residences/{residence}/force-delete', [ResidenceController::class, 'forceDelete'])->name('residences.forceDelete');

Route::get('/residences/archived/{id}', [ResidenceController::class, 'showArchived'])->name('residences.showArchived');

    Route::get('/archive/list', [ResidenceController::class, 'archived'])->name('residences.archived');
    Route::post('/{id}/restore', [ResidenceController::class, 'restore'])->name('residences.restore');
    Route::delete('/{id}/force', [ResidenceController::class, 'forceDelete'])->name('residences.forceDelete');

    Route::get('/blooters', [BlooterController::class, 'index'])->name('blooter.blooters');
    Route::post('/blotteradd', [BlooterController::class, 'store'])->name('blooter.addblotter');
    Route::delete('/blotters/{id}', [BlooterController::class, 'destroy']);

    Route::get('/archived_blooters', [BlooterController::class, 'archived'])->name('archived_blooters');
    Route::post('/blotters/{id}/restore', [BlooterController::class, 'restore']);
    Route::delete('/blotters/{id}/force-delete', [BlooterController::class, 'forceDelete']);

    Route::middleware(['auth'])->group(function () {
        // Active events routes
        Route::get('/events', [EventController::class, 'index'])->name('events');
        Route::post('/insertevent', [EventController::class, 'store']);
        
        // Archive related routes
        Route::get('/events/archived', [EventController::class, 'archived'])->name('events.archived');
        Route::post('/event/archive/{id}', [EventController::class, 'archive'])->name('event.archive');
        Route::post('/event/restore/{id}', [EventController::class, 'restore'])->name('event.restore');
        Route::delete('/event/delete/{id}', [EventController::class, 'destroy'])->name('event.delete');
    });

    

    Route::middleware(['auth'])->group(function () {
        // Immunization routes
        Route::get('/immunize', [ImmunizeController::class, 'index'])->name('immunize'); // Keep your original route name
        Route::post('/insertimmunize', [ImmunizeController::class, 'store'])->name('insertimmunize');
        Route::delete('/immunizedelete/{id}', [ImmunizeController::class, 'destroy'])->name('immunizedelete');
        
        // Archive routes
        Route::get('/archived_immunizations', [ImmunizeController::class, 'archived'])->name('archived_immunizations');
        Route::post('/immunize/restore/{id}', [ImmunizeController::class, 'restore'])->name('immunize.restore');
        Route::delete('/immunize/force-delete/{id}', [ImmunizeController::class, 'forceDelete'])->name('immunize.force-delete');
    });


    Route::get('/prenatal', [PrenatalController::class, 'index'])->name('prenatal');
    Route::post('/insertprenatal', [PrenatalController::class, 'store']);
    Route::delete('/prenataldelete/{id}', [PrenatalController::class, 'destroy']);

    Route::get('budgetplan', [BudgetController::class, 'index'])->name('budget.budgetplan');
    //Route::get('/exportbudget/{id}', [BudgetController::class, 'export'])->name('budget.exportbudget');
    Route::post('/insertplanning', [BudgetController::class, 'store']); 
    Route::delete('/palnningdelete/{id}', [BudgetController::class, 'destroy']);
    Route::get('/budget/export/{id}', [BudgetController::class, 'export'])->name('budget.exportbudget');

    Route::get('/users', [UserController::class, 'index'])->name('users.users');
    Route::post('/insertuser', [UserController::class, 'store']);
    Route::delete('/userdelete/{id}', [UserController::class, 'destroy']);
    Route::put('/users/reset/{id}', [UserController::class, 'update'])->name('user.update');

    Route::get('/comments', [CommentController::class, 'index'])->name('comments.comments');
    Route::post('/comments', [CommentController::class, 'store'])->middleware('auth');
    Route::get('/getcomments', [CommentController::class, 'comments'])->name('comments.list');

    Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.transactions');
    Route::get('/history', [TransactionsController::class, 'history'])->name('transactions.history');
    Route::post('/transactions/store', [TransactionsController::class, 'store'])->name('transactions.store');
    Route::get('/report', [TransactionsController::class, 'report'])->name('transactions.report');
    Route::get('/export/{id}',[TransactionsController::class, 'export'])->name('transactions.exporttransactions');
    Route::patch('/transactions/{id}/status', [TransactionsController::class, 'updateStatus'])->name('transactions.updateStatus');
    Route::post('/transactions/clear', [TransactionsController::class, 'clearHistory'])->name('transactions.clear');
    Route::delete('/transactions/{id}', [TransactionsController::class, 'deleteTransaction'])->name('transactions.delete');
    Route::get('/transactions/generate-report', [TransactionsController::class, 'generateReport'])->name('transactions.generateReport');
    Route::get('/transactions/export/{id}', [TransactionsController::class, 'export'])->name('transactions.export');


    Route::get('/transactions/{id}/certificate', [TransactionsController::class, 'showCertificate'])
    ->name('transactions.showCertificate');

    Route::post('/transactions/{id}/update-certificate', [TransactionsController::class, 'updateCertificate'])
    ->name('transactions.updateCertificate');

    Route::post('/transactions/clear-completed', [TransactionsController::class, 'clearCompleted'])->name('transactions.clear-completed');


    Route::delete('/transactions/clear-completed', [TransactionsController::class, 'clearCompleted'])->name('transactions.clearCompleted');
    Route::post('/transactions/clear-completed', [TransactionsController::class, 'clearCompleted'])->name('transactions.clearCompleted');
    Route::patch('/transactions/{id}/update-status', [TransactionsController::class, 'updateStatus'])
    ->name('transactions.updateStatus');
    Route::delete('/transactions/clear-completed', [TransactionsController::class, 'clearCompleted'])
    ->name('transactions.clearCompleted');
    Route::middleware(['auth'])->group(function () {
        Route::get('/transaction-report', [TransactionsController::class, 'generateReport'])
            ->name('transaction.report');
    });

});

require __DIR__.'/auth.php';
