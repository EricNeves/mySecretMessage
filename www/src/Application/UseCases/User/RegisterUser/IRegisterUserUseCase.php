<?php

namespace App\Application\UseCases\User\RegisterUser;

use App\Application\Dtos\User\RegisterUserDto;

interface IRegisterUserUseCase
{
    public function execute(RegisterUserDto $input): array;
}
