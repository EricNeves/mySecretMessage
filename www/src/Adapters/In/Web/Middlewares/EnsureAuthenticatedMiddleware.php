<?php

namespace App\Adapters\In\Web\Middlewares;

use App\Infrastructure\Http\Jwt;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class EnsureAuthenticatedMiddleware
{
    public function handle(Request $request, Response $response)
    {
        $token = $request->bearerToken();
        $jwt   = new Jwt();

        $tokenValidated = $jwt->validate($token);

        if (!$tokenValidated) {
            $response->json([
                "message" => "Unauthorized",
            ], 401);
        }

        $request->setUser($tokenValidated);
    }
}
