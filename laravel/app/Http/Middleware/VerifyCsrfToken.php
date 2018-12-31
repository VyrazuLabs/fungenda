<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'add_to_favourite_event',
        'remove_to_favourite_event',
        'add_to_favourite_business',
        'remove_to_favourite_business',
    ];
}
