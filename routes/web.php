<?php


use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscussionController;

use App\Http\Controllers\SendEmailController;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/send-email', function () {
    $data = [
        'title' => 'Test Email',
        'message' => 'This is a test email sent from Laravel using Gmail SMTP.'
    ];

    Mail::to('riskyahmad0506@gmail.com')->send(new SendEmail($data));

    return 'Email Sent Successfully!';
});


Route::middleware('guest')->group(function () {
    Route::get('', function () {
        return view('authentication.login');
    })->name('auth');

    Route::get('auth', [AuthenticationController::class, 'index'])->name('auth');
    Route::get('registasi', [AuthenticationController::class, 'registrasi'])->name('registrasi');

    // auth
    Route::post('login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('registrasi.store', [AuthenticationController::class, 'store'])->name('registrasi.store');
});

Route::middleware(['auth'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    })->middleware('role:mahasiswa,dosen');

    Route::prefix('course')->group(function () {
        Route::get('', [CourseController::class, 'dashboard'])->name('course');
        Route::get('index', [CourseController::class, 'index'])->name('course.index');
        Route::post('', [CourseController::class, 'store'])->name('course.store');
        Route::delete('{id}', [CourseController::class, 'destroy'])->name('course.destroy');
        Route::put('{id}', [CourseController::class, 'update'])->name('course.update');
        Route::get('course/{id}', [CourseController::class, 'detail'])->name('course.detail');
        Route::post('{id}/materials', [CourseController::class, 'materials_store'])->name('materials.store');
        Route::post('{id}/assignment', [CourseController::class, 'assignment_store'])->name('assignment.store');
        Route::get('course/assignment/{id}', [CourseController::class, 'detail_assignment'])->name('assignment.detail');
    })->middleware('role:mahasiswa,dosen');

    // Halaman daftar course untuk diskusi
    Route::get('discussion', [DiscussionController::class, 'allCourses'])
        ->name('discussion.all')
        ->middleware('auth');

    // Halaman diskusi per course
    Route::get('discussion/{courseId}', [DiscussionController::class, 'index'])
        ->name('discussion.index')
        ->middleware('auth');

    // Store discussion
    Route::post('discussion/store', [DiscussionController::class, 'store'])
        ->name('discussion.store')
        ->middleware('auth');

    // Store reply
    Route::post('discussion/{discussionId}/reply', [DiscussionController::class, 'reply'])
        ->name('discussion.reply')
        ->middleware('auth');






    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

});

Route::get('404', function () {
    return view('errors.404');
})->name('errors');

Route::fallback(function () {
    return redirect()->route('errors');
});
