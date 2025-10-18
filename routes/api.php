<?php
declare(strict_types=1);

use App\Http\Controllers\ProfileController;


Route::get('/me', ProfileController::class)->name('me');

