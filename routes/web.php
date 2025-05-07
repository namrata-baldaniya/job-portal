<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Employer\CompanyProfileController;
use App\Http\Controllers\Employer\DashboardController as EmployerDashboardController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeeker\ApplicationController;
use App\Http\Controllers\JobSeeker\DashboardController as JobSeekerDashboardController;
use App\Http\Controllers\JobSeeker\JobController;
use App\Http\Controllers\JobSeeker\ResumeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'is_jobseeker'])->prefix('jobseeker')->name('jobseeker.')->group(function () {
    Route::get('/dashboard', [JobSeekerDashboardController::class, 'index'])->name('dashboard');
});

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth', 'is_employer'])->prefix('employer')->name('employer.')->group(function () {
    Route::get('/dashboard', [EmployerDashboardController::class, 'index'])->name('dashboard');

    Route::resource('job_posts', \App\Http\Controllers\Employer\JobPostController::class);

    Route::get('applications', [\App\Http\Controllers\Employer\ApplicationController::class, 'index'])
        ->name('applications.index');
    Route::get('applications/{application}', [\App\Http\Controllers\Employer\ApplicationController::class, 'show'])
        ->name('applications.show');
    Route::put('applications/{application}', [\App\Http\Controllers\Employer\ApplicationController::class, 'update'])
        ->name('applications.update');

    Route::get('company_profile', [\App\Http\Controllers\Employer\CompanyProfileController::class, 'edit'])
        ->name('company_profile.edit');
    Route::put('company_profile', [\App\Http\Controllers\Employer\CompanyProfileController::class, 'update'])
        ->name('company_profile.update');
});
Route::middleware(['auth', 'is_jobseeker'])->prefix('jobseeker')->name('jobseeker.')->group(function () {
    Route::get('/dashboard', [JobSeekerDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('resume', ResumeController::class)->only([
        'index', 'create', 'store', 'edit', 'update', 'destroy'
    ]);
    
    Route::resource('applications', ApplicationController::class)->only([
        'index', 'create', 'store', 'show'
    ]);
    
    Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
    Route::get('jobs/{jobPost}', [JobController::class, 'show'])->name('jobs.show');
});