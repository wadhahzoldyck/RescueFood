<?php

use App\Http\Controllers\AdminCollectController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\RecommandationController;
use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\RedistributionController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\NourritureController;
use App\Http\Controllers\CollectController;

/*
|---------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\TemplateController@index');
Route::get('/about', 'App\Http\Controllers\TemplateController@about');
Route::get('/contact', 'App\Http\Controllers\TemplateController@contact');


// Public routes (accessible to everyone)
Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');



// Routes accessible only by the restaurant role
Route::middleware('role:restaurant')->group(function () {
    Route::get('/restaurant/dashboard', [DonController::class, 'showDashboard'])->name('restaurantdashboard');
    Route::resource('nourritures', NourritureController::class);
    Route::resource('dons', DonController::class);
});

Route::middleware('role:association')->group(function () {
    Route::get('/association/dashboard', function () {
        return view('Associationspace.home');
    })->name('associationdashboard');


    Route::resource('beneficiaires', BeneficiaireController::class);
    Route::resource('redistributions', RedistributionController::class);
    Route::resource('livreurs', LivreurController::class);

    Route::resource('recommandations', RecommandationController::class);
    Route::resource('collect', CollectController::class);
    Route::get('generate-pdf', [CollectController::class, 'generatePDF']);
    Route::get('export-collections', [CollectController::class, 'export']);
    Route::get('/collection/{id}/qr-code', [CollectController::class, 'generateQRCode'])->name('collection.qr-code');

    Route::resource('livraison', LivraisonController::class);
});


Route::middleware('role:admin')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('Adminspace.home');
    })->name('admindashboard');
    Route::resource('nourrituresadmin', NourritureController::class);
    Route::resource('donsadmin', DonController::class);

    Route::resource('beneficiairesadmin', BeneficiaireController::class);
    Route::resource('redistributionsadmin', RedistributionController::class);
    Route::resource('livreurs', LivreurController::class);

    Route::resource('recommandationsadmin', RecommandationController::class);
    Route::resource('collectadmin', AdminCollectController::class);
    Route::get('generate-pdfadmin', [AdminCollectController::class, 'generatePDF']);
    Route::get('export-collectionsadmin', [AdminCollectController::class, 'export']);
    Route::get('/collection/{id}/qr-codeadmin', [AdminCollectController::class, 'generateQRCode'])->name('collection.qr-code');

    Route::resource('livraisonadmin', LivraisonController::class);
});
