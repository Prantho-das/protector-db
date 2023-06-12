<?php

use Illuminate\Support\Facades\Route;
use Pranthokumar\ProtectDb\App\Controllers\ProtectDbController;

Route::get("/", [ProtectDbController::class, 'index']);
Route::post("/protect", [ProtectDbController::class, 'protect'])->name('protect-db.protect');