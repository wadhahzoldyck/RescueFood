<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

use App\Http\Controllers\LivreurController;

use App\Http\Controllers\RecommandationController;

use App\Http\Controllers\BeneficiaireController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\LivraisonController;
use App\Http\Controllers\NourritureController;

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

Route::get('/', 'App\Http\Controllers\TemplateController@index');
Route::get('/about', 'App\Http\Controllers\TemplateController@about');
Route::get('/contact', 'App\Http\Controllers\TemplateController@contact');

Route::get('/restaurant', [RestaurantController::class, 'index']);
Route::get('/association/dashboard', function () {
    return view('Associationspace.home');
})->name('dashboard');


Route::resource('livreurs', LivreurController::class);

Route::resource('recommandations', RecommandationController::class);
Route::resource('beneficiaires', BeneficiaireController::class);
Route::resource('nourritures', NourritureController::class);
Route::resource('dons', DonController::class);
Route::resource('livraison', LivraisonController::class);
