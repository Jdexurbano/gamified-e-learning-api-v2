<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\StudentLessonController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/',function(){
//     return 'hello World';
// });

//public routes
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('students',StudentController::class);
    Route::apiResource('announcements',AnnouncementController::class);
    Route::apiResource('teachers',TeacherController::class);
    Route::apiResource('admin/students',AdminController::class);
    Route::apiResource('games',GameController::class);
    Route::apiResource('lessons',LessonController::class);
    Route::apiResource('student/lessons',StudentLessonController::class);
    Route::apiResource('activities',ActivityController::class);
});