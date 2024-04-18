<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UploadController;

// Authentication
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

//User
Route::get("/users", [UserController::class, "getUsers"]);
Route::get("/users/{id}", [UserController::class, "getUser"]);

// Tasks

// Test Protected Routes 
Route::group(["middleware" => ["auth:sanctum"]], function() {
  Route::get("/tasks", [TaskController::class, "getTasks"]);
  Route::get("/tasks/{id}", [TaskController::class, "getTask"]);
  Route::post("/tasks", [TaskController::class, "setTask"]);
  Route::put("/tasks/{id}", [TaskController::class, "updateTask"]);
  Route::delete("/tasks/{id}", [TaskController::class, "deleteTask"]);

  // Upload
  Route::post("/upload-image", [UploadController::class, "uploadImage"]);

  Route::post("/logout", [AuthController::class, "logout"]);
});
