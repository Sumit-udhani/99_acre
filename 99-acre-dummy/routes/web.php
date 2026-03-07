<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyLocationTypeController;
use App\Http\Controllers\PropertyPurposeController;
use App\Http\Controllers\PropertySubTypeController;
use App\Http\Controllers\PropertyTypeController;
use App\Models\Banner;
use App\Models\PropertyCategory;
use App\Models\PropertyPurpose;
use App\Models\PropertySubType;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
      $banner = Banner::latest()->first();
       $purposes = PropertyPurpose::take(3)->get();
        $categories = PropertyCategory::all();
        $types = PropertyType::all();
           $subtypes = PropertySubType::all();
    return view('welcome', compact('banner','purposes','categories','types','subtypes'));
});
Route::get('/get-subtypes/{type}', function($type){

    return PropertySubType::where('type_id',$type)->get();

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
            ->name('logo.store');

            //banner 
             Route::resource('banner', BannerController::class);

             //Form 
              Route::resource('properties', PropertyController::class);
               Route::resource('purposes', PropertyPurposeController::class);
               Route::resource('categories', PropertyCategoryController::class);
               Route::resource('types', PropertyTypeController::class);
               Route::resource('location-types', PropertyLocationTypeController::class);
               Route::resource('subtypes', PropertySubTypeController::class);

                //User status update 
               Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])
               ->name('users.updateStatus');
               //Users management 
     Route::resource('users', UserController::class);
      Route::resource('roles', RoleController::class);


});
require __DIR__.'/auth.php';
