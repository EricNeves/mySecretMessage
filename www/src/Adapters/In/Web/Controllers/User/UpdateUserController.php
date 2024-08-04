<?php

namespace App\Adapters\In\Web\Controllers\User;

use App\Adapters\Out\Factories\User\UpdateUserFactory;
use App\Application\Dtos\User\UpdateUserDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class UpdateUserController
{
    public function __construct(private UpdateUserFactory $updateUser)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $fields = $request->validate([
            "name"     => "required",
            "password" => "required",
        ]);

        $updateUserDTO = new UpdateUserDto(
            $request->user()->id,
            $fields["name"],
            $fields["password"]
        );

        $user = $this->updateUser->init()->execute($updateUserDTO);

        return $response->json([
            "data" => $user,
        ]);
    }
}
