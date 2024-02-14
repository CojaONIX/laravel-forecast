<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForecastController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home.page');
Route::get('/search', [HomeController::class, 'search'])->name('home.search');

Route::view('/about', 'about')->name('about.page');
Route::view('/welcome', 'welcome')->name('welcome.page');

Route::get('/weather', [WeatherController::class, 'getWeathers'])->name('weather.page');
Route::get('/forecast/{city:city}', [ForecastController::class, 'getCityForecasts'])->name('forecast.city.page');

Route::middleware(['auth', 'isAdmin'])->prefix('/admin')->name('admin.')->group(function () {
    Route::controller(ForecastController::class)->prefix('/forecast')->name('forecast.')->group(function () {
        Route::get('/all', 'getAllForecasts')->name('all.page');
        Route::get('/add', 'addForecastPage')->name('add.page');
        Route::post('/add', 'createForecast')->name('create');
        Route::get('/edit/{forecast}', 'editForecastPage')->name('edit.page');
        Route::put('/edit/{forecast}', 'updateForecast')->name('update');
        Route::delete('/delete/{forecast}', 'deleteForecast')->name('delete');
    });

    Route::view('/weather', 'admin.weather.weather')->name('weather.page');
    Route::post('/weather/update', [WeatherController::class, 'update'])->name('weather.update');

    Route::get('/forecasts', [ForecastController::class, 'forecastsAll'])->name('forecasts');
    Route::post('/forecasts/add', [ForecastController::class, 'forecastsAdd'])->name('forecasts.create');
});

Route::get('/test', [TestController::class, 'showTest'])->name('test.page');
Route::post('/test', [TestController::class, 'ajaxGetTestData']);



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
