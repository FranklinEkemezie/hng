<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\getJson;

it('returns profile information', function () {

    $url = route('me');
    $user = [
        'email' => 'franklynpeter2006@gmail.com',
        'name'  => 'Ekemezie Ifeanyichukwu Franklin',
        'stack' => 'PHP/Laravel',
    ];

    $response = getJson($url);
    $data = $response->json();

    if ($response->isSuccessful()) {
        $response->assertOk();
        expect($data)->toMatchArray([
            'status'    => 'success',
            'message'   => 'Profile information with random cat fact sent successfully!',

        ]);
    }

    $response->assertJsonStructure([
        'status', 'message',
        'user' => ['email', 'name', 'stack'],
        'timestamp', 'fact'
    ]);

    expect($response->json())->toMatchArray([
        'user'      => [
            'email' => $user['email'],
            'name'  => $user['name'],
            'stack' => $user['stack']
        ]
    ]);

});

it('returns 500 if external cat fact API fails', function () {
    $response = getJson(route('me'));
    $data = $response->json();

    $response->assertInternalServerError();
    expect($data)->toMatchArray([
        'status'    => 'error',
        'message'   => 'Could not fetch random cat fact. Profile information sent successfully.',
    ]);
});

it('calls the external cat fact API', function () {
    Http::fake();

    getJson(route('me'));

    Http::assertSent(function (Request $request) {
        return $request->url() === url('cat-fact')
            && $request->method() === 'GET';
    });
});
