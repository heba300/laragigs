<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', [ListingController::class, 'index']);

Route::group(["middleware" => 'auth', 'prefix' => '/listings'], function () {

    Route::get('/create', [ListingController::class, 'create']);
    Route::post('/', [ListingController::class, 'store']);

    Route::get('/{listing}/edit', [ListingController::class, 'edit']);
    Route::put('/{listing}', [ListingController::class, 'update']);

    Route::delete('/{listing}', [ListingController::class, 'destroy']);

    Route::get('/manage', [ListingController::class, 'manage']);
});

Route::get('/listings/{listing}', [ListingController::class, 'show']);
