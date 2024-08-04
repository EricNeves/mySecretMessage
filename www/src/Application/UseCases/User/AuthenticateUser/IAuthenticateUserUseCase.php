<?php

namespace App\Application\UseCases\User\AuthenticateUser;

use App\Application\Dtos\User\AuthenticateUserDto;

interface IAuthenticateUserUseCase
{
    public function execute(AuthenticateUserDto $input): mixed;
}
