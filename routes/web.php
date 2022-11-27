<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SubjectController;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/demo' , function(){
    return view('layout.demo');
});
Route::group(['controller' => LoginController::class, 'prefix' => 'login', 'as' => 'login.'], function () {
    Route::get('/', 'index')->name('index');
    Route::post('process', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('checkLogin')->group(function () {
    Route::get('/', function () {
        return view('homepage');
    })->name('homepage');
    Route::middleware('checkLevelLogin')->group(function(){
        Route::group(['controller' => TeacherController::class, 'prefix' => 'teacher', 'as' => 'teacher.'], function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('show/{teacherModel}', 'show')->name('show');
                Route::get('edit/{teacherModel}', 'edit')->name('edit');
                Route::put('update/{teacherModel}', 'update')->name('update');
                Route::delete('destroy/{teacherModel}', 'destroy')->name('destroy');
        });
    });
    //Sinh viên
    Route::group(['controller' => StudentController::class, 'prefix' => 'student', 'as' => 'student.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('show/{studentModel}', 'show')->name('show');
        Route::get('edit/{studentModel}', 'edit')->name('edit');
        Route::put('update/{studentModel}', 'update')->name('update');
        Route::middleware('checkLevelLogin')->group(function(){
            Route::delete('destroy/{studentModel}', 'destroy')->name('destroy');
        });
    });

    //Khoa
    Route::group(['controller' => DepartmentController::class, 'prefix' => 'department', 'as' => 'department.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{departmentModel}', 'edit')->name('edit');
        Route::middleware('checkLevelLogin')->group(function(){        
            Route::put('update/{departmentModel}', 'update')->name('update');
            Route::delete('destroy/{departmentModel}', 'destroy')->name('destroy');
        });
    });

    //Ngành
    Route::group(['controller' => MajorController::class, 'prefix' => 'major', 'as' => 'major.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{majorModel}', 'edit')->name('edit');
        Route::middleware('checkLevelLogin')->group(function(){
            Route::put('update/{majorModel}', 'update')->name('update');
            Route::delete('destroy/{majorModel}', 'destroy')->name('destroy');
        });
    });

    //Môn học
    Route::group(['controller' => SubjectController::class, 'prefix' => 'subject', 'as' => 'subject.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{subjectModel}', 'edit')->name('edit');
        Route::middleware('checkLevelLogin')->group(function(){
            Route::put('update/{subjectModel}', 'update')->name('update');
            Route::delete('destroy/{subjectModel}', 'destroy')->name('destroy');
        });
    });

    //Ca học
    Route::group(['controller' => ShiftController::class, 'prefix' => 'shift', 'as' => 'shift.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{shiftModel}', 'edit')->name('edit');
        Route::put('update/{shiftModel}', 'update')->name('update');
        Route::delete('destroy/{shiftModel}', 'destroy')->name('destroy');
    });

    //Lớp học
    Route::group(['controller' => CourseController::class, 'prefix' => 'course', 'as' => 'course.'], function () {
        Route::get('/', 'index')->name('index');
        Route::middleware('checkLevelLogin')->group(function(){
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('edit/{courseModel}', 'edit')->name('edit');
            Route::put('update/{courseModel}', 'update')->name('update');
            Route::delete('destroy/{courseModel}', 'destroy')->name('destroy');
        });
    });
});
