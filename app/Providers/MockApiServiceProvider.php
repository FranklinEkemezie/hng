<?php

namespace App\Providers;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class MockApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

        if(! app()->environment(['local', 'testing'])) return;

        // mock apis here
        Http::fake([
            url('/cat-fact') => static::catFactApi()
        ]);

    }

    public static function catFactApi(): PromiseInterface
    {
        // simulate latency
        $noOfMilliseconds = fake()->numberBetween(1, 2);
        sleep($noOfMilliseconds);

        // generate a random cat
        $catFact = fake()->optional(0.6)->sentence;
        if (! $catFact) {
            return Http::response([
                'status'    => 'error',
                'message'   => 'Failed to generate a random cat fact. Please try again!',
                'fact'      => null
            ], 500);
        }

        return Http::response([
            'status'    => 'success',
            'message'   => 'Generated a random cat fact successfully!',
            'fact'      => $catFact
        ]);
    }
}
