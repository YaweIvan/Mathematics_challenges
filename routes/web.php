<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ChallengeController;

// General Routes
Route::get('/', function () {
    return view('user.user');
})->name('userhome');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admins.dashboard');
    
    Route::get('/upload-questions', function () {
        return view('admin.upload-questions');
    })->name('admin.upload-questions');
    
    Route::post('/upload-questions', [ChallengeController::class, 'uploadQuestions'])->name('admin.upload-questions.post');
    
    Route::get('/manage-schools', function () {
        return view('admin.manage-schools');
    })->name('admin.manage-schools');

    Route::get('/set-challenge', function () {
        return view('admin.set-challenge');
    })->name('admin.set-challenge');

    Route::post('/set-challenge', [ChallengeController::class, 'setChallenge'])->name('admin.set-challenge.post');
    
    Route::get('/view-challenge', [ChallengeController::class, 'viewChallenges'])->name('admin.view-challenge');
    
    Route::get('/edit-challenge/{id}', [ChallengeController::class, 'editChallenge'])->name('admin.challenge.edit');
    Route::put('/update-challenge/{id}', [ChallengeController::class, 'updateChallenge'])->name('admin.challenge.update');
    
    Route::get('/upload-excel-questions', [ChallengeController::class, 'showExcelUploadForm'])->name('admin.upload-excel-questions');
    Route::post('/upload-excel-questions', [ChallengeController::class, 'uploadQuestions'])->name('admin.upload-excel-questions.post');

    Route::get('/upload-excel-answers', [ChallengeController::class, 'showExcelAnswersUploadForm'])->name('admin.upload-excel-answers');
    Route::post('/upload-excel-answers', [ChallengeController::class, 'uploadExcelAnswers'])->name('admin.upload-excel-answers.post');
    
    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('admin.analytics');
});

// School Routes
Route::resource('schools', SchoolController::class);

// The login to dashboard route
Route::get('/admin/dashboards', [AuthController::class, 'Showdashboard'])->name('dashboardss');
