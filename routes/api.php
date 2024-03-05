<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::group([
    
    'middleware' => 'api'
  
], function ($router) {
    
    Route::post('/login', [ApiController::class, 'login'])->name('login');
    Route::post('/forget_password', [ApiController::class, 'forget_password'])->name('forget_password');
    Route::post('/get_student', [ApiController::class, 'get_student'])->name('get_student');
    Route::post('/student_details', [ApiController::class, 'student_details'])->name('get_student');
    Route::post('/update_student', [ApiController::class, 'update_student'])->name('update_student');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    
});


Route::get('/test', [ApiController::class, 'test'])->name('test');

