<?php

namespace Tests\Feature;

use Tests\TestCase;

class SecurityHeadersMiddlewareTest extends TestCase
{
    public function test_security_headers_are_sent_on_homepage(): void
    {
        $response = $this->get('/');

        $response->assertHeader('X-Frame-Options');
        $response->assertHeader('X-Content-Type-Options');
        $response->assertHeader('X-XSS-Protection');
        $response->assertHeader('Referrer-Policy');
        $response->assertHeader('Content-Security-Policy');
        $response->assertHeader('Permissions-Policy');
        $response->assertHeader('Cross-Origin-Opener-Policy');
        $response->assertHeader('Cross-Origin-Embedder-Policy');
        $response->assertHeader('Cross-Origin-Resource-Policy');
    }

    public function test_security_header_values_are_correct(): void
    {
        $response = $this->get('/');

        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Content-Security-Policy');
        $response->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
        $response->assertHeader('Cross-Origin-Opener-Policy', 'same-origin');
        $response->assertHeader('Cross-Origin-Embedder-Policy', 'credentialless');
        $response->assertHeader('Cross-Origin-Resource-Policy', 'same-origin');
    }

    public function test_security_headers_are_sent_on_api_endpoints(): void
    {
        $response = $this->get('/api/posts');

        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Content-Security-Policy');
    }
}
