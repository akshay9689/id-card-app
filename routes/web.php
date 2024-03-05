<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin', [AdminController::class, 'get_admin'])->name('admin');
    Route::post('/add-admin', [AdminController::class, 'add_admin'])->name('add-admin');
    Route::post('/add-school', [AdminController::class, 'add_school'])->name('add-school');
    Route::post('/update-school/{id}', [AdminController::class, 'update_school'])->name('update-school');
    Route::post('/update-admin/{id}', [AdminController::class, 'update_admin'])->name('update-admin');
    Route::post('/change-admin-status', [AdminController::class, 'change_admin_status'])->name('change-admin-status');
    Route::post('/delete-admin', [AdminController::class, 'delete_admin'])->name('delete-admin');
    Route::get('/teacher', [AdminController::class, 'get_teacher'])->name('teacher');
    Route::post('/teacher', [AdminController::class, 'add_teacher'])->name('teacher');
    Route::post('/reset-password', [AdminController::class, 'reset_password'])->name('reset-password');
    Route::get('/view-profile', [AdminController::class, 'view_profile'])->name('view-profile');
    Route::post('/update-teacher/{id}', [AdminController::class, 'update_teacher'])->name('update-teacher');
    Route::get('/edit-class/{id}', [AdminController::class, 'edit_class'])->name('edit-class');
    Route::get('/sections', [AdminController::class, 'get_division'])->name('sections');
    Route::post('/sections', [AdminController::class, 'add_division']);
    Route::post('/update-division/{id}', [AdminController::class, 'update_division'])->name('update-division');
    Route::post('/delete-division', [AdminController::class, 'delete_division'])->name('delete-division');
    Route::get('/classes', [AdminController::class, 'get_classes'])->name('classes');
    Route::post('/classes', [AdminController::class, 'add_class']);
    Route::get('/student', [StudentController::class, 'get_student'])->name('student');
    Route::post('/student', [StudentController::class, 'add_student'])->name('student');
    Route::post('/get_division_by_id', [StudentController::class, 'get_division_by_id'])->name('get_division_by_id');
    Route::get('/edit-student/{id}', [StudentController::class, 'edit_student'])->name('edit-student');
    Route::get('/view-student/{id}', [StudentController::class, 'view_student'])->name('view-student');
    Route::post('/update-student', [StudentController::class, 'update_student'])->name('update-student');
    Route::get('/import_student', [StudentController::class, 'import_student'])->name('import_student');
    Route::post('/import_student', [StudentController::class, 'student_list_add'])->name('import_student');
    Route::get('/assign', [StudentController::class, 'get_assign'])->name('assign');
    Route::post('/assign', [StudentController::class, 'post_assign']);
    
    // show form route
    Route::post('/delete-student', [StudentController::class, 'delete_student'])->name('delete-student');
    Route::get('/edit-assign/{id}', [StudentController::class, 'edit_assign'])->name('edit_assign');
    Route::post('/update_class', [AdminController::class, 'update_class'])->name('update_class');
    

});
