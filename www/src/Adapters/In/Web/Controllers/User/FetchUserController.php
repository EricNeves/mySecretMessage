<?php

namespace App\Adapters\In\Web\Controllers\User;

use App\Adapters\Out\Factories\User\FetchUserFactory;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class FetchUserController
{
    public function __construct(private FetchUserFactory $fetchUser)
    {
    }

    public function handle(Request $request, Response $response)
    {
        return $response->json([
            "data" => $this->fetchUser->init()->execute($request->user()->id),
        ]);
    }
}
