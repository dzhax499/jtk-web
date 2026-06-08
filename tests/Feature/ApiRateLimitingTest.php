<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class ApiRateLimitingTest extends TestCase
{
    public function test_api_rate_limiter_named_api_is_registered(): void
    {
        $limiter = RateLimiter::limiter('api');

        $this->assertNotNull($limiter, 'Rate limiter "api" harus terdaftar di AppServiceProvider');
    }

    public function test_api_route_has_throttle_middleware(): void
    {
        $routes = Route::getRoutes()->getRoutesByMethod()['GET'];

        $found = false;
        foreach ($routes as $route) {
            if ($route->uri() === 'api/posts') {
                $this->assertContains(
                    'throttle:api',
                    $route->gatherMiddleware(),
                    'Route api/posts harus memiliki middleware throttle:api'
                );
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, 'Route api/posts harus terdaftar');
    }
}
