<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'payment/callback',
        '/payment/verify/sadad',
        '/payment/verify/saman',
        '/payment/verify/irankish',
        '/payment/verify/parsian',

    ];
}
