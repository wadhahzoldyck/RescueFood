<?php





use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\LivreurController;
use App\Http\Controllers\RecommandationController;
use App\Http\Controllers\BeneficiaireController;
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

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::middleware('role:restaurant')->group(function () {
        Route::get('/restaurant/dashboard', function () {
            return view('Restaurantspace.home');
        })->name('restaurantdashboard');
        Route::resource('nourritures', NourritureController::class);
        Route::resource('dons', DonController::class);
    });

    Route::middleware('role:association')->group(function () {
        Route::get('/association/dashboard', function () {
            return view('Associationspace.home');
        })->name('associationdashboard');

        Route::resource('livreurs', LivreurController::class);

        Route::resource('recommandations', RecommandationController::class);
        Route::resource('beneficiaires', BeneficiaireController::class);
        
        Route::resource('collect', CollectController::class);
        Route::get('generate-pdf', [CollectController::class, 'generatePDF']);
        Route::get('export-collections', [CollectController::class, 'export']);
        Route::get('/collection/{id}/qr-code', [CollectController::class, 'generateQRCode'])->name('collection.qr-code');

        Route::resource('livraison', LivraisonController::class);    });
});
