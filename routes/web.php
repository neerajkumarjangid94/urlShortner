<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShorterUrlsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';



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


Route::get('/register/invite/{token}', [AdminController::class, 'showRegistration'])
    ->name('register.invite');


//admin routes.
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    Route::get('/admin/invite-user', [AdminController::class, 'inviteUser'])
        ->name('admin.invite');
    Route::post('/admin/invite-user', [AdminController::class, 'sendInvitation'])
        ->name('admin.invite.send');


        
    Route::get('/admin/short-url/create', [AdminController::class, 'createShortUrl'])
        ->name('admin.short-url.create');
         // Store Short URL
    Route::post('/admin/short-url', [AdminController::class, 'storeShortUrl'])
        ->name('admin.short-url.store');
});

//member routes.
Route::middleware(['auth', 'member'])->group(function () {

    Route::get('/member/dashboard', [MemberController::class, 'dashboard'])
        ->name('member.dashboard');

    //view of url form.
    Route::get('/short-url/create', [MemberController::class, 'create'])
        ->name('short-url.create');
    //store shorten url.
    Route::post('/short-url', [MemberController::class, 'store'])
        ->name('shorturl.store');
});
Route::get('/{shortCode}', [ShorterUrlsController::class, 'redirect'])
    ->name('short-url.redirect');
