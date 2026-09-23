<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





//Routes.
Route::middleware(['auth', 'super_admin'])->group(function () {

    //company routes.    
    Route::prefix('companies')
        ->group(function () {
            Route::get('/', [CompanyController::class, 'fetchCompanyListings'])->name('company.companylistings');
            Route::get('/create', [CompanyController::class, 'create'])->name('companies.create');
            Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        });

    //invite user route.
    Route::get('/users/invite', [UserController::class, 'inviteUser'])->name('users.invite');
    Route::post('/users/invite', [UserController::class, 'storeInvitation'])->name('users.invite.store');
});

require __DIR__ . '/auth.php';
