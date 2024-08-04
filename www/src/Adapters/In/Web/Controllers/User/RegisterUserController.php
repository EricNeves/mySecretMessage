<?php

namespace App\Adapters\In\Web\Controllers\User;

use App\Adapters\Out\Factories\User\RegisterUserFactory;
use App\Application\Dtos\User\RegisterUserDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class RegisterUserController
{
    public function __construct(private RegisterUserFactory $registerUser)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $fields = $request->validate([
            "name"     => "required",
            "email"    => "required|email",
            "password" => "required",
        ]);

        $registerUserDTO = new RegisterUserDto(
            $fields["name"],
            $fields["email"],
            $fields["password"],
        );

        $user = $this->registerUser->init()->execute($registerUserDTO);

        return $response->json([
            "data" => $user,
        ], 201);
    }
}
