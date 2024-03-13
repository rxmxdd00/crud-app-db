<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/department', [DepartmentController::class, "getData"]);
Route::post('/department/create', [DepartmentController::class, "storeDepartment"]);
Route::put('/department/update/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('/department/delete/{id}', [DepartmentController::class, 'deleteDepartment']);

Route::get('/student', [StudentController::class, "getStudent"]);
Route::post('/student', [StudentController::class, "addStudent"]);
Route::put('/student/update/{id}', [StudentController::class, 'updateStudent']);
Route::delete('/student/delete/{id}', [StudentController::class, 'deleteStudent']);

Route::get('/course', [CourseController::class, "getCourses"]);
Route::post('/course', [CourseController::class, "addCourse"]);
Route::put('/course/update/{id}', [CourseController::class, 'updateCourse']);
Route::delete('/course/delete/{id}', [CourseController::class, 'deleteCourse']);

Route::get('/enrollment', [EnrollmentController::class, "getEnrollment"]);
Route::post('/enrollment', [EnrollmentController::class, "addEnrollment"]);
Route::put('/enrollment/update/{id}', [EnrollmentController::class, 'updateEnrollment']);
Route::delete('/enrollment/delete/{id}', [EnrollmentController::class, 'deleteEnrollment']);