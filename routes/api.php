<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

// Authentication
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

// Tasks

// Test Protected Routes 
Route::group(["middleware" => ["auth:sanctum"]], function() {
  Route::get("/tasks", [TaskController::class, "getTasks"]);
  Route::get("/tasks/{id}", [TaskController::class, "getTask"]);
  Route::post("/tasks", [TaskController::class, "setTask"]);
  Route::put("/tasks/{id}", [TaskController::class, "updateTask"]);
  Route::delete("/tasks/{id}", [TaskController::class, "deleteTask"]);

  Route::post("/logout", [AuthController::class, "logout"]);
});
