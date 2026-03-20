<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyCategoryController;
use App\Http\Controllers\PropertyLocationTypeController;
use App\Http\Controllers\PropertyProfileController;
use App\Http\Controllers\PropertyProfileOptionController;
use App\Http\Controllers\PropertyPurposeController;
use App\Http\Controllers\PropertyStepController;
use App\Http\Controllers\PropertySubTypeController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\UserPropertyController;
use App\Models\Banner;
use App\Models\PropertyCategory;
use App\Models\PropertyLocationType;
use App\Models\PropertyProfileOption;
use App\Models\PropertyPurpose;
use App\Models\PropertyStep;
use App\Models\PropertySubType;
use App\Models\PropertyType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    $banner = Banner::latest()->first();
    $purposes = PropertyPurpose::take(3)->get();
    $categories = PropertyCategory::all();
    $types = PropertyType::all();
    $subtypes = PropertySubType::all();
    return view('welcome', compact('banner', 'purposes', 'categories', 'types', 'subtypes'));
});
//Route to get the subtypes by types id
Route::get('/get-subtypes/{type}', function ($type) {

    return PropertySubType::where('type_id', $type)->get();
});
//Route to get the locationtypes  by types id
Route::get('/get-location-types/{type}', function ($type) {

    return PropertyLocationType::where('property_type_id', $type)->get();
});
Route::get('/dashboard', function () {
    $purposes = PropertyPurpose::all();
    $categories = PropertyCategory::all();
    $types = PropertyType::all();
    $steps = PropertyStep::where('active', 1)
        ->orderBy('order')
        ->get();
    $areaUnits = PropertyProfileOption::whereNotNull('area_unit')->pluck('area_unit');
    $floors = PropertyProfileOption::whereNotNull('floor_no')->pluck('floor_no');
    $availability = PropertyProfileOption::whereNotNull('availability_status')->pluck('availability_status');
    $ownerships = PropertyProfileOption::whereNotNull('ownership')->pluck('ownership');
    $furnishings = PropertyProfileOption::whereNotNull('furnishing')
        ->pluck('furnishing');
    $rentout = PropertyProfileOption::whereNotNull('rent_out')
        ->pluck('rent_out');
    return view('dashboard', compact(
        'purposes',
        'categories',
        'types',
        'steps',
        'areaUnits',
        'floors',
        'availability',
        'ownerships',
        'furnishings',
        'rentout'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //UserPropertyCreation
    Route::post(
        '/property/store',
        [UserPropertyController::class, 'store']
    )->name('property.store');

    //UserPropertyUpdate

    Route::get(
        '/property/{id}/basic/edit',
        [UserPropertyController::class, 'editBasic']
    )
        ->name('property.basic.edit');

    Route::post(
        '/property/{id}/basic/update',
        [UserPropertyController::class, 'updateBasic']
    )
        ->name('property.basic.update');
    //Getlocation page
    Route::get(
        '/property/{id}/location',
        [UserPropertyController::class, 'location']
    )->name('property.location');

    //User property Location creation

    Route::post(
        '/property/{id}/location',
        [UserPropertyController::class, 'saveLocation']
    )->name('property.location.store');

    //User Property Profile creation 
    Route::post('/property/{id}/profile', [UserPropertyController::class, 'saveProfile']);
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

        //Propert steps['basic details','location details']
        Route::resource('property-steps', PropertyStepController::class);


        Route::resource('property-profiles', PropertyProfileController::class);
        Route::resource('property-profiles-option', PropertyProfileOptionController::class);
    });
require __DIR__ . '/auth.php';
