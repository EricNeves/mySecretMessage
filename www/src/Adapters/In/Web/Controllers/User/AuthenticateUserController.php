<?php

namespace App\Adapters\In\Web\Controllers\User;

use App\Adapters\Out\Factories\User\AuthenticateUserFactory;
use App\Application\Dtos\User\AuthenticateUserDto;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

class AuthenticateUserController
{
    public function __construct(private AuthenticateUserFactory $authenticateUser)
    {
    }

    public function handle(Request $request, Response $response)
    {
        $fields = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $authenticateUserDto = new AuthenticateUserDto($fields['email'], $fields['password']);

        $authenticate = $this->authenticateUser->init()->execute($authenticateUserDto);

        return $response->json([
            "data" => $authenticate,
        ]);
    }
}
