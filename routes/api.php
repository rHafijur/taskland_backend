<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskStatusController;

Route::get('/task_status', [TaskStatusController::class, 'index']);
Route::get('/priority', [PriorityController::class, 'index']);
Route::get('/role', [RoleController::class, 'index']);

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('user', UserController::class);
    Route::resource('project', ProjectController::class);
    Route::resource('task', TaskController::class);
    Route::post('task/complete', [TaskController::class, 'complete']);
    Route::get('dashboard', [DashboardController::class, 'index']);
});
// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
