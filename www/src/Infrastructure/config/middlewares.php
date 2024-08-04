<?php

use App\Adapters\In\Web\Middlewares\EnsureAuthenticatedMiddleware;

return [
    'auth' => EnsureAuthenticatedMiddleware::class,
];
