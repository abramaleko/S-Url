<?php

use App\Http\Controllers\UrlController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use AshAllenDesign\ShortURL\Facades\ShortURL;
use App\Http\Controllers\StatsController;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome-page');

Route::prefix('/short-url')->group(function()
{
    Route::get('/new',[UrlController::class,'index'])->name('url-create');
    Route::post('/save-url',[UrlController::class,'saveUrl'])->name('url-save');
    Route::post('/url/check-availability', [UrlController::class,'checkAvailabilty'])->name('url-check-availabilty');
    Route::get('url/generate-url/{length}',[UrlController::class,'generateRandomUrl'])->name('random-url-generate');
    Route::get('/all',[UrlController::class,'allUrls'])->name('url-all');
    Route::get('/{url}/details',[UrlController::class,'urlDetails'])->name('url-details');
    Route::post('/update-status',[UrlController::class,'updateStatus'])->name('update-status');

    Route::get('/{url}/edit',[UrlController::class,'editUrl'])->name('edit-url');
    Route::post('/{url}/edit',[UrlController::class,'updateUrl'])->name('update-url');

    Route::delete('{url}/delete',[UrlController::class,'deleteUrl'])->name('url-delete');

    Route::get('/stats/all',[StatsController::class,'statsList'])->name('stats-list');

    Route::get('/{url}/stats',[StatsController::class,'statsInfo'])->name('stats-info');


});

 //redirect route
Route::middleware(ShortURL::middleware())->group(function () {
    Route::get('/'.ShortURL::prefix().'/{shortURLKey}',[ShortURLController::class,'__invoke'])->name('short-url.invoke');

});

require __DIR__.'/auth.php';
