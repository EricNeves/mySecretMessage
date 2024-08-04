<?php

namespace App\Adapters\In\Web\Controllers\Home;

use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class ShowMessageController
{
    public function handle(Request $request, Response $response)
    {
        return $response->json([
            "author"  => "Eric Neves <github.com/ericneves>",
            "message" => "Hello World Human! 👽",
        ]);
    }
}
