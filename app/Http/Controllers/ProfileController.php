<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    protected const PROFILE_DATA = [
        'name'  => 'Ekemezie Ifeanyichukwu Franklin',
        'email' => 'franklynpeter2006@gmail.com',
        'stack' => 'PHP/Laravel'
    ];

    protected const RANDOM_CAT_FACT_API_URL = 'http://localhost:8000/cat-fact';

    public static function getProfileData(?string $randomCatFact)
    {
        return [
            'status'    => $randomCatFact ? 'success' : 'error',
            'message'   => $randomCatFact ? 'Profile information gotten successfully' : 'Could not fetch cat fact from API.',
            'user'      => [
                'email' => self::PROFILE_DATA['email'],
                'name'  => self::PROFILE_DATA['name'],
                'stack' => self::PROFILE_DATA['stack']
            ],
            'timestamp' => now(),
            'fact'      => $randomCatFact,
        ];
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //

        try {
            $response = Http::get(self::RANDOM_CAT_FACT_API_URL);
            $randomCatFact = $response->json()['fact'] ?? null;
        } catch (ConnectionException $e) {
            $randomCatFact = null;
        }

        $profileData = self::getProfileData($randomCatFact);
        if (! $randomCatFact) {
            return response()->json($profileData, 500);
        }

        return response()->json($profileData);
    }
}
