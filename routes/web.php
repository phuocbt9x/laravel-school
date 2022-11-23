<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\DepartmentModel;
use App\Models\TeacherModel;
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

Route::get('/', function () {
    return view('homepage');
})->name('homepage');


Route::middleware('checkLogin')->group(function () {
    Route::group(['controller' => TeacherController::class, 'prefix' => 'teacher', 'as' => 'teacher.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('show/{teacherModel}', 'show')->name('show');
        Route::get('edit/{teacherModel}', 'edit')->name('edit');
        Route::put('update/{teacherModel}', 'update')->name('update');
        Route::delete('destroy/{teacherModel}', 'destroy')->name('destroy');
    });

    //Khoa
    Route::group(['controller' => DepartmentController::class, 'prefix' => 'department', 'as' => 'department.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{departmentModel}', 'edit')->name('edit');
        Route::put('update/{departmentModel}', 'update')->name('update');
        Route::delete('destroy/{departmentModel}', 'destroy')->name('destroy');
    });

    //Ngành
    Route::group(['controller' => MajorController::class, 'prefix' => 'major', 'as' => 'major.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{majorModel}', 'edit')->name('edit');
        Route::put('update/{majorModel}', 'update')->name('update');
        Route::delete('destroy/{majorModel}', 'destroy')->name('destroy');
    });

    //Môn học
    Route::group(['controller' => SubjectController::class, 'prefix' => 'subject', 'as' => 'subject.'], function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{subjectModel}', 'edit')->name('edit');
        Route::put('update/{subjectModel}', 'update')->name('update');
        Route::delete('destroy/{subjectModel}', 'destroy')->name('destroy');
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
});
