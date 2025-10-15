<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/me', function () {

    $fullName = 'Ekemezie Ifeanyichukwu Franklin';
    $email = 'franklynpeter2006@gmail.com';
    $stack = 'PHP/Laravel';

    $randomCatFactUrl = 'http://localhost:8000/cat-fact';
    $response = Http::get($randomCatFactUrl);
    $randomCatFact = $response->json()['fact'] ?? null;


    $getProfileData = function () use ($email, $fullName, $stack, $randomCatFact) {
        return [
            'status'    => $randomCatFact ? 'success' : 'error',
            'message'   => $randomCatFact ? 'Profile information gotten successfully' : 'Could not fetch cat fact from API.',
            'user'      => [
                'email' => $email,
                'name'  => $fullName,
                'stack' => $stack
            ],
            'timestamp' => now(),
            'fact'      => $randomCatFact,
        ];
    };

    $profileData = $getProfileData();
    if (! $randomCatFact) {
        return response()->json($profileData, 500);
    }

    return response()->json($profileData);
});
