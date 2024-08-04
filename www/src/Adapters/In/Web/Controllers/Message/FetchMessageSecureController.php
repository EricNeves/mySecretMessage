<?php

namespace App\Adapters\In\Web\Controllers\Message;

use App\Adapters\Out\Factories\Message\FetchMessageSecureFactory;
use App\Application\Dtos\Message\FetchMessageSecureDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class FetchMessageSecureController
{
    public function __construct(private FetchMessageSecureFactory $fetchMessageSecure)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $fields = $request->validate(['secret_key' => 'required|string']);

        $fetchMessageSecureDto = new FetchMessageSecureDto(
            $request->user()->id,
            $fields['secret_key']
        );

        return $response->json([
            'data' => $this->fetchMessageSecure->init()->execute($fetchMessageSecureDto),
        ]);
    }
}
