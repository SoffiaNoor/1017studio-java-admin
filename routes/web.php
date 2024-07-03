<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactInformationController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageInformationController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectImageController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\ProjectTypeImageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsImageController;
use App\Http\Controllers\ProjectImage360Controller;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::resource('/profile', ProfileController::class);
    Route::resource('/information', InformationController::class);
    Route::resource('/imageInformation', ImageInformationController::class);
    Route::resource('/contact', ContactController::class);
    Route::resource('/contact_information', ContactInformationController::class);
    Route::resource('/projectImage', ProjectImageController::class);
    Route::resource('/facility', FacilityController::class);
    Route::resource('/project', ProjectController::class);
    Route::resource('/projectType', ProjectTypeController::class);
    Route::resource('/projectTypeImage', ProjectTypeImageController::class);
    Route::resource('/projectTypeImage360', ProjectImage360Controller::class);
    Route::resource('/news', NewsController::class);
    Route::resource('/newsImage', NewsImageController::class);
    Route::resource('/user', ProfileController::class);
    Route::post('user/{user}/change-password', [ProfileController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});