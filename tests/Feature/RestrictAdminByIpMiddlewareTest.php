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

    public function test_x_forwarded_for_spoofing_is_ignored(): void
    {
        $request = Request::create('/admin', 'GET', server: [
            'REMOTE_ADDR' => '1.2.3.4',
            'HTTP_X_FORWARDED_FOR' => '127.0.0.1',
        ]);
        $next = fn ($req) => response('ok');

        try {
            (new RestrictAdminByIp)->handle($request, $next);
            $this->fail('Expected HttpException was not thrown.');
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }
    }

    public function test_ipv6_localhost_is_allowed(): void
    {
        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '::1']);
        $next = fn ($req) => response('ok');

        $response = (new RestrictAdminByIp)->handle($request, $next);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_empty_whitelist_blocks_all(): void
    {
        config(['app.admin_allowed_ips' => '']);

        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '127.0.0.1']);
        $next = fn ($req) => response('ok');

        try {
            (new RestrictAdminByIp)->handle($request, $next);
            $this->fail('Expected HttpException was not thrown.');
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }
    }

    public function test_malformed_cidr_does_not_crash(): void
    {
        config(['app.admin_allowed_ips' => '999.999.999.999/99']);

        $request = Request::create('/admin', 'GET', server: ['REMOTE_ADDR' => '127.0.0.1']);
        $next = fn ($req) => response('ok');

        try {
            (new RestrictAdminByIp)->handle($request, $next);
            $this->fail('Expected HttpException was not thrown.');
        } catch (HttpException $e) {
            $this->assertEquals(403, $e->getStatusCode());
        }
    }
}
