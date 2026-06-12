<?php

use App\Http\Controllers\Front\Admin\CategorieController;
use App\Http\Controllers\Front\Artisan\ServiceController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes — Sécurisées (version cybersécurité)
|--------------------------------------------------------------------------
*/

// Page d'accueil publique
Route::get('/', [HomeController::class, 'index']);
Route::post('/', [HomeController::class, 'search_services'])->name('search');


/*
|--------------------------------------------------------------------------
| Espace Admin — protégé par auth + rôle admin
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'role.admin'], 'prefix' => 'admin'], function () {

    Route::get('/', function () {
        return view('Front.admin');
    })->name('admin');

    Route::get('/categorie', [CategorieController::class, 'index'])->name('categorie');
    Route::get('/categorie-create', [CategorieController::class, 'create'])->name('categorie.create');
    Route::post('/categorie-store', [CategorieController::class, 'store'])->name('categorie.store');
    Route::get('/categorie-edit/{id}', [CategorieController::class, 'edit'])->name('categorie.edit');
    Route::post('/categorie-update/{id}', [CategorieController::class, 'update'])->name('categorie.update');
    Route::get('/categorie-delete/{id}', [CategorieController::class, 'destroy'])->name('categorie.delete');
});


/*
|--------------------------------------------------------------------------
| Espace Artisan — protégé par auth + rôle artisan
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'role.artisan'], 'prefix' => 'artisan'], function () {

    Route::get('/', function () {
        return view('Front.dashboard');
    })->name('artisan');

    Route::get('/service', [ServiceController::class, 'index'])->name('sevice');
    Route::get('/service-create', [ServiceController::class, 'create'])->name('sevice.create');
    Route::post('/service-store', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service-edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/service-update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::get('/service-delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');
});


/*
|--------------------------------------------------------------------------
| Profil — accessible à tout utilisateur connecté
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
