<?php

namespace App\Application\UseCases\User\AuthenticateUser;

use App\Application\Dtos\User\AuthenticateUserDto;
use App\Domain\Ports\In\AuthenticationPort;

class AuthenticateUserUseCase implements IAuthenticateUserUseCase
{
    public function __construct(private AuthenticationPort $authentication)
    {
    }

    public function execute(AuthenticateUserDto $authenticateUserDto): mixed
    {
        return $this->authentication->authenticate($authenticateUserDto->email, $authenticateUserDto->password);
    }
}
