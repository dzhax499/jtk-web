<?php

namespace Tests\Feature;

use App\Http\Middleware\RestrictAdminByIp;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class RestrictAdminByIpMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['app.admin_allowed_ips' => '127.0.0.1,::1,10.10.0.0/16']);
    }

    public function test_localhost_is_allowed(): void
    {
        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '127.0.0.1']);
        $next = fn ($req) => response('ok');

        $response = (new RestrictAdminByIp)->handle($request, $next);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_external_ip_is_blocked(): void
    {
        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '1.2.3.4']);
        $next = fn ($req) => response('ok');

        try {
            (new RestrictAdminByIp)->handle($request, $next);
            $this->fail('Expected HttpException was not thrown.');
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }
    }

    public function test_cidr_range_allowed(): void
    {
        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '10.10.0.5']);
        $next = fn ($req) => response('ok');

        $response = (new RestrictAdminByIp)->handle($request, $next);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_cidr_outside_range_blocked(): void
    {
        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '10.11.0.5']);
        $next = fn ($req) => response('ok');

        try {
            (new RestrictAdminByIp)->handle($request, $next);
            $this->fail('Expected HttpException was not thrown.');
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }
    }
}
