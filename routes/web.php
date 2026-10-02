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
use App\Http\Controllers\Admin\BenevoleController as AdminBenevoleController;
use App\Http\Controllers\BenevoleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\AbonneNewsletterController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\EquipeController;
use App\Http\Controllers\Admin\RapportController;
use App\Http\Controllers\Admin\HistoriqueController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\AproposController;
use App\Http\Controllers\YouthMessageController;
use App\Http\Controllers\Admin\YouthMessageController as AdminYouthMessageController;
use App\Http\Controllers\PartnershipRequestController;
use App\Http\Controllers\Admin\PartnershipRequestController as AdminPartnershipRequestController;
use App\Http\Controllers\InterventionRequestController;
use App\Http\Controllers\Admin\InterventionRequestController as AdminInterventionRequestController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\DashboardController;


/*
|--------------------------------------------------------------------------
| Routes publiques (React Frontend) - avec contrôleur
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/a-propos', [FrontendController::class, 'about'])->name('about');
Route::get('/nos-actions', [FrontendController::class, 'actions'])->name('actions');
// Route::get('/s-impliquer', [FrontendController::class, 'getInvolved'])->name('get-involved');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/call-to-action', [FrontendController::class, 'callToAction'])
    ->name('call-to-action');







Route::post(
    '/youth-messages',
    [YouthMessageController::class, 'store']
)
    ->middleware('throttle:youth-messages')
    ->name('youth-messages.store');


Route::post(
    '/partnership-requests',
    [PartnershipRequestController::class, 'store']
)
    ->middleware('throttle:partnership-requests')
    ->name('partnership-requests.store');


Route::post(
    '/intervention-requests',
    [InterventionRequestController::class, 'store']
)
    ->middleware('throttle:intervention-requests')
    ->name('intervention-requests.store');
Route::post(
    '/benevoles',
    [BenevoleController::class, 'store']
)
    ->middleware('throttle:benevoles')
    ->name('benevoles.store');

// Routes pour les détails (si besoin)
Route::get('/articles/{id}', [FrontendController::class, 'article'])->name('article.show');
Route::get('/programmes/{id}', [FrontendController::class, 'programme'])->name('programme.show');
Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page.show');


/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/dashboard',
    [DashboardController::class, 'index']
)
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {

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
    Route::resource('categories', CategorieController::class)->parameters([
        'categories' => 'categorie' // Force le paramètre à s'appeler 'categorie'
    ]);

    /*
|--------------------------------------------------------------------------
| À propos (Page statique)
|--------------------------------------------------------------------------
*/
    Route::prefix('apropos')->name('apropos.')->group(function () {
        Route::get('/', [AproposController::class, 'index'])->name('index');

        // Hero
        Route::get('/hero/edit', [AproposController::class, 'editHero'])->name('hero.edit');
        Route::put('/hero', [AproposController::class, 'updateHero'])->name('hero.update');

        // Vision & Mission
        Route::get('/vision/edit', [AproposController::class, 'editVision'])->name('vision.edit');
        Route::put('/vision', [AproposController::class, 'updateVision'])->name('vision.update');
        Route::put('/mission', [AproposController::class, 'updateMission'])->name('mission.update');

        // Valeurs
        Route::get('/valeurs', [AproposController::class, 'indexValeurs'])->name('valeurs.index');
        Route::get('/valeurs/create', [AproposController::class, 'createValeur'])->name('valeurs.create');
        Route::post('/valeurs', [AproposController::class, 'storeValeur'])->name('valeurs.store');
        Route::get('/valeurs/{valeur}/edit', [AproposController::class, 'editValeur'])->name('valeurs.edit');
        Route::put('/valeurs/{valeur}', [AproposController::class, 'updateValeur'])->name('valeurs.update');
        Route::delete('/valeurs/{valeur}', [AproposController::class, 'destroyValeur'])->name('valeurs.destroy');

        // Statistiques
        Route::get('/stats', [AproposController::class, 'indexStats'])->name('stats.index');
        Route::get('/stats/create', [AproposController::class, 'createStat'])->name('stats.create');
        Route::post('/stats', [AproposController::class, 'storeStat'])->name('stats.store');
        Route::get('/stats/{stat}/edit', [AproposController::class, 'editStat'])->name('stats.edit');
        Route::put('/stats/{stat}', [AproposController::class, 'updateStat'])->name('stats.update');
        Route::delete('/stats/{stat}', [AproposController::class, 'destroyStat'])->name('stats.destroy');
    });

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
    Route::resource(
        'benevoles',
        AdminBenevoleController::class
    );
    /*
    |--------------------------------------------------------------------------
    | Contacts
    |--------------------------------------------------------------------------
    */
    Route::resource('contacts', ContactController::class);


    /*
|--------------------------------------------------------------------------
| Messages des jeunes
|--------------------------------------------------------------------------
*/

    Route::get(
        '/youth-messages',
        [AdminYouthMessageController::class, 'index']
    )->name('youth-messages.index');


    // IMPORTANT : cette route doit être AVANT /{youthMessage}
    Route::delete(
        '/youth-messages/bulk-delete',
        [AdminYouthMessageController::class, 'bulkDelete']
    )->name('youth-messages.bulk-delete');

    Route::get(
        '/youth-messages/{youthMessage}/audio',
        [AdminYouthMessageController::class, 'audio']
    )->name('youth-messages.audio');

    Route::get(
        '/youth-messages/{youthMessage}',
        [AdminYouthMessageController::class, 'show']
    )->name('youth-messages.show');


    Route::put(
        '/youth-messages/{youthMessage}',
        [AdminYouthMessageController::class, 'update']
    )->name('youth-messages.update');


    Route::delete(
        '/youth-messages/{youthMessage}',
        [AdminYouthMessageController::class, 'destroy']
    )->name('youth-messages.destroy');
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


    Route::get(
        '/partnership-requests',
        [AdminPartnershipRequestController::class, 'index']
    )->name('partnership-requests.index');


    // Doit rester AVANT /{partnershipRequest}
    Route::delete(
        '/partnership-requests/bulk-delete',
        [AdminPartnershipRequestController::class, 'bulkDelete']
    )->name('partnership-requests.bulk-delete');


    Route::get(
        '/partnership-requests/{partnershipRequest}',
        [AdminPartnershipRequestController::class, 'show']
    )->name('partnership-requests.show');


    Route::put(
        '/partnership-requests/{partnershipRequest}',
        [AdminPartnershipRequestController::class, 'update']
    )->name('partnership-requests.update');


    Route::delete(
        '/partnership-requests/{partnershipRequest}',
        [AdminPartnershipRequestController::class, 'destroy']
    )->name('partnership-requests.destroy');

    Route::get(
        '/intervention-requests',
        [AdminInterventionRequestController::class, 'index']
    )->name('intervention-requests.index');


    // IMPORTANT : avant /{interventionRequest}
    Route::delete(
        '/intervention-requests/bulk-delete',
        [AdminInterventionRequestController::class, 'bulkDelete']
    )->name('intervention-requests.bulk-delete');


    Route::get(
        '/intervention-requests/{interventionRequest}',
        [AdminInterventionRequestController::class, 'show']
    )->name('intervention-requests.show');


    Route::put(
        '/intervention-requests/{interventionRequest}',
        [AdminInterventionRequestController::class, 'update']
    )->name('intervention-requests.update');


    Route::delete(
        '/intervention-requests/{interventionRequest}',
        [AdminInterventionRequestController::class, 'destroy']
    )->name('intervention-requests.destroy');

    /*
    |--------------------------------------------------------------------------
    | Profil Admin
    |--------------------------------------------------------------------------
    */

    /*
|--------------------------------------------------------------------------
| Profil administrateur
|--------------------------------------------------------------------------
*/

    Route::get(
        '/profile',
        [AdminProfileController::class, 'show']
    )->name('profile.show');


    Route::get(
        '/profile/edit',
        [AdminProfileController::class, 'edit']
    )->name('profile.edit');


    Route::put(
        '/profile',
        [AdminProfileController::class, 'update']
    )->name('profile.update');


    Route::delete(
        '/profile/photo',
        [AdminProfileController::class, 'removePhoto']
    )->name('profile.photo.destroy');


    Route::put(
        '/profile/password',
        [AdminProfileController::class, 'updatePassword']
    )->name('profile.password.update');

    /*
    |--------------------------------------------------------------------------
    | Paramètres
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', function () {
        return view('back.settings.index');
    })->name('settings.index');


    /*
|--------------------------------------------------------------------------
| Notifications
|--------------------------------------------------------------------------
*/

    Route::get(
        '/notifications/{id}/open',
        [NotificationController::class, 'open']
    )->name('notifications.open');

    Route::post(
        '/notifications/mark-all-read',
        [NotificationController::class, 'markAllAsRead']
    )->name('notifications.mark-all-read');
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



require __DIR__ . '/auth.php';

// Toutes les routes non capturées par Laravel sont renvoyées vers React
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
