<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssociationController;
use App\Http\Controllers\RestaurantController;

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

<<<<<<< HEAD
// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','App\Http\Controllers\TemplateController@index');
Route::get('/about','App\Http\Controllers\TemplateController@about');
Route::get('/contact','App\Http\Controllers\TemplateController@contact');

=======
Route::get('/', function () {
    return view('welcome');
});
Route::get('/restaurant', [RestaurantController::class, 'index']);
Route::get('/association/dashboard', function () {
    return view('Associationspace.home');
})->name('dashboard');
>>>>>>> 00471d5c68083ec6413cfb3f3e76f3f297b8e339
