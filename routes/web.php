<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SchoolController;

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
    
    Route::post('/upload-questions', function () {
        // Handle file upload and processing
    });
    
    Route::get('/manage-schools', function () {
        return view('admin.manage-schools');
    })->name('admin.manage-schools');
    
    Route::get('/set-challenge', function () {
        return view('admin.set-challenge');
    })->name('admin.set-challenge');
    
    Route::post('/set-challenge', function () {
        // Handle setting challenge parameters
    });
    
    Route::get('/view-challenge', function () {
        return view('admin.view-challenge');
    })->name('admin.view-challenge');
    
    Route::get('/analytics', function () {
        return view('admin.analytics');
    })->name('admin.analytics');
});


// Miscellaneous Routes



// The login to dashboard route
Route::get('/admin/dashboards', [AuthController::class, 'Showdashboard'])->name('dashboardss');

// Additional Routes (if needed)

Route::resource('schools', SchoolController::class);

use App\Http\Controllers\ChallengeController;

// Existing routes...

Route::prefix('admin')->group(function () {
    // Existing routes...

    Route::get('/set-challenge', function () {
        return view('admin.set-challenge');
    })->name('admin.set-challenge');
    
    Route::post('/set-challenge', [ChallengeController::class, 'setChallenge'])->name('admin.set-challenge.post');
    
    Route::get('/view-challenge', [ChallengeController::class, 'viewChallenges'])->name('admin.view-challenge');
});

//EXCEL QUESTIONS


Route::prefix('admin')->group(function () {
    // Other routes...
    
    Route::post('/upload-questions', [ChallengeController::class, 'uploadQuestions'])->name('admin.upload-questions.post');
});



// routes/web.php


Route::get('/admin/upload-excel-questions', [App\Http\Controllers\ChallengeController::class, 'showExcelUploadForm'])->name('admin.upload-excel-questions');





// Route to show the form
Route::get('/admin/upload-excel-questions', [ChallengeController::class, 'showExcelUploadForm'])->name('admin.upload-excel-questions');

// Route to handle the form submission
Route::post('/admin/upload-questions', [ChallengeController::class, 'uploadQuestions'])->name('admin.upload-questions.post');
 



// Other routes...

// Route to show the form for uploading answers


// Route to show the form for uploading answers
Route::get('/admin/upload-excel-answers', [ChallengeController::class, 'showExcelAnswersUploadForm'])->name('admin.upload-excel-answers');


// Route to show the form for uploading answers
Route::get('/admin/upload-excel-answers', [ChallengeController::class, 'showExcelAnswersUploadForm'])->name('admin.upload-excel-answers');

// Route to handle the form submission for uploading answers
Route::post('/admin/upload-excel-answers', [ChallengeController::class, 'uploadExcelAnswers'])->name('admin.upload-excel-answers.post');
