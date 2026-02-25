<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyLocationTypeController;
use App\Http\Controllers\PropertyPurposeController;
use App\Http\Controllers\PropertyTypeController;
use App\Models\Banner;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
      $banner = Banner::latest()->first();
    return view('welcome', compact('banner'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
      ->name('admin.')  
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

          Route::get('/logo', [LogoController::class, 'create'])
            ->name('admin.logo.create');

        Route::post('/logo', [LogoController::class, 'store'])
            ->name('admin.logo.store');

            //banner 
             Route::resource('banner', BannerController::class);

             //Form 
              Route::resource('properties', PropertyController::class);
               Route::resource('purposes', PropertyPurposeController::class);
               Route::resource('categories', PropertyCategoryController::class);
               Route::resource('types', PropertyTypeController::class);
               Route::resource('location-types', PropertyLocationTypeController::class);





});
require __DIR__.'/auth.php';
