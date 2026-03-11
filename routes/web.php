<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategorieController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ProgrammeController;
use App\Http\Controllers\Admin\TemoignageController;
use App\Http\Controllers\Admin\DonController;
use App\Http\Controllers\Admin\PartenaireController;
use App\Http\Controllers\Admin\BenevoleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AbonneNewsletterController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\RapportController;
use App\Http\Controllers\Admin\HistoriqueController;

/*
|--------------------------------------------------------------------------
| Routes publiques (React Frontend)
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

Route::view('/a-propos', 'welcome');
Route::view('/nos-actions', 'welcome');
Route::view('/s-impliquer', 'welcome');
Route::view('/contact', 'welcome');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('back.dashboard');
})->middleware(['auth'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Utilisateurs
    |--------------------------------------------------------------------------
    */
    Route::resource('utilisateurs', UserController::class);

    /*
    |--------------------------------------------------------------------------
    | Rôles
    |--------------------------------------------------------------------------
    */
    Route::resource('roles', RoleController::class);

    /*
    |--------------------------------------------------------------------------
    | Catégories
    |--------------------------------------------------------------------------
    */
    Route::resource('categories', CategorieController::class);

    /*
    |--------------------------------------------------------------------------
    | Articles
    |--------------------------------------------------------------------------
    */
    Route::resource('articles', ArticleController::class);

    /*
    |--------------------------------------------------------------------------
    | Programmes
    |--------------------------------------------------------------------------
    */
    Route::resource('programmes', ProgrammeController::class);

    /*
    |--------------------------------------------------------------------------
    | Témoignages
    |--------------------------------------------------------------------------
    */
    Route::resource('temoignages', TemoignageController::class);

    /*
    |--------------------------------------------------------------------------
    | Dons
    |--------------------------------------------------------------------------
    */
    Route::resource('dons', DonController::class);

    /*
    |--------------------------------------------------------------------------
    | Partenaires
    |--------------------------------------------------------------------------
    */
    Route::resource('partenaires', PartenaireController::class);

    /*
    |--------------------------------------------------------------------------
    | Bénévoles
    |--------------------------------------------------------------------------
    */
    Route::resource('benevoles', BenevoleController::class);

    /*
    |--------------------------------------------------------------------------
    | Contacts
    |--------------------------------------------------------------------------
    */
    Route::resource('contacts', ContactController::class);

    /*
    |--------------------------------------------------------------------------
    | Newsletter
    |--------------------------------------------------------------------------
    */
    Route::resource('newsletters', AbonneNewsletterController::class);

    /*
    |--------------------------------------------------------------------------
    | Médias
    |--------------------------------------------------------------------------
    */
    Route::resource('media', MediaController::class);

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    Route::resource('pages', PageController::class);

    /*
    |--------------------------------------------------------------------------
    | Équipe
    |--------------------------------------------------------------------------
    */
    Route::resource('equipes', EquipeController::class);

    /*
    |--------------------------------------------------------------------------
    | Rapports
    |--------------------------------------------------------------------------
    */
    Route::resource('rapports', RapportController::class);

    /*
    |--------------------------------------------------------------------------
    | Historiques
    |--------------------------------------------------------------------------
    */
    Route::resource('historiques', HistoriqueController::class)
        ->only(['index', 'show', 'destroy']);

    /*
    |--------------------------------------------------------------------------
    | Profil Admin
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', function () {
        return view('back.profile.edit');
    })->name('profile.edit');

    /*
    |--------------------------------------------------------------------------
    | Paramètres
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', function () {
        return view('back.settings.index');
    })->name('settings.index');
});


/*
|--------------------------------------------------------------------------
| Profil utilisateur (Laravel Breeze)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});



require __DIR__.'/auth.php';


// Toutes les routes non capturées par Laravel sont renvoyées vers React
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
