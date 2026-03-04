<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Attaches essential security HTTP headers to every response.
 *
 * Mitigates: XSS, Clickjacking, MIME-sniffing, information disclosure,
 * and enforces HTTPS with HSTS.
 */
class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Stop browsers from MIME-type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Enable XSS filter in older browsers
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Content Security Policy – tightened for a Blade + Vite/Stripe app
        $scriptSrc = "'self' 'unsafe-inline' 'unsafe-eval' https://js.stripe.com https://cdn.jsdelivr.net";
        $styleSrc = "'self' 'unsafe-inline' https://fonts.googleapis.com https://cdn.jsdelivr.net";
        $connectSrc = "'self' https://api.stripe.com https://api.open-meteo.com";

        if (app()->environment('local')) {
            $viteUrls = ' http://localhost:5173 http://127.0.0.1:5173 ws://localhost:5173 ws://127.0.0.1:5173 wss://localhost:5173 wss://127.0.0.1:5173';
            $scriptSrc .= $viteUrls;
            $styleSrc .= ' http://localhost:5173 http://127.0.0.1:5173';
            $connectSrc .= $viteUrls;
        }

        $formAction = "'self' https://checkout.stripe.com";
        if (app()->environment('local')) {
            $formAction .= ' http://localhost:8000 http://127.0.0.1:8000';
        }

        $csp = implode('; ', [
            "default-src 'self'",
            "script-src {$scriptSrc}",
            "style-src {$styleSrc}",
            "font-src 'self' https://fonts.gstatic.com data:",
            "img-src 'self' data: https:",
            "connect-src {$connectSrc}",
            'frame-src https://js.stripe.com https://hooks.stripe.com',
            "object-src 'none'",
            "base-uri 'self'",
            "form-action {$formAction}",
        ]);
        $response->headers->set('Content-Security-Policy', $csp);

        // Enforce HTTPS (only in production to avoid local dev issues)
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }

        // Remove server version disclosure
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('Server');

        return $response;
    }
}
