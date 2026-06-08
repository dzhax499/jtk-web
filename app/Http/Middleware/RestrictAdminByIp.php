<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RestrictAdminByIp
{
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
        $whitelist = explode(',', (string) (config('app.admin_allowed_ips') ?: env('ADMIN_ALLOWED_IPS', '127.0.0.1,::1')));
        $whitelist = array_map('trim', $whitelist);

        foreach ($whitelist as $entry) {
            if ($entry === $ip) {
                return $next($request);
            }

            if (str_contains($entry, '/') && $this->ipInCidr($ip, $entry)) {
                return $next($request);
            }
        }

        Log::warning("Blocked admin access from IP: {$ip}");
        abort(403, 'Akses admin hanya diizinkan dari jaringan kampus POLBAN.');
    }

    private function ipInCidr(string $ip, string $cidr): bool
    {
        $parts = explode('/', $cidr);
        $range = $parts[0];
        $prefix = (int) ($parts[1] ?? 32);

        $ipLong = ip2long($ip);
        $rangeLong = ip2long($range);

        if ($ipLong === false || $rangeLong === false) {
            return false;
        }

        $mask = -1 << (32 - $prefix);

        return ($ipLong & $mask) === ($rangeLong & $mask);
    }
}
