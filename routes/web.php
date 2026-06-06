<?php

use App\Http\Controllers\Dashboard\CaseController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\EventController;
use App\Http\Controllers\Dashboard\GalleryController;
use App\Http\Controllers\Dashboard\ServiceController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\StatisticController;
use App\Http\Controllers\Dashboard\TeamController;
use App\Http\Controllers\Dashboard\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::prefix(LaravelLocalization::setLocale())->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware(['auth', 'verified', 'checktype'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::resource('sliders', SliderController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('cases', CaseController::class);
            Route::resource('events', EventController::class);
            Route::resource('services', ServiceController::class);
            Route::resource('statistics', StatisticController::class);
            Route::resource('teams', TeamController::class);
            Route::resource('testimonials', TestimonialController::class);
            Route::resource('galleries', GalleryController::class);
        });
    });

    require __DIR__ . '/auth.php';
});
