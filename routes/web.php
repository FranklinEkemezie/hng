<?php

use Illuminate\Support\Facades\Route;

require_once __DIR__ . '/api.php';

Route::get('/', function () {
    return view('welcome');
});
