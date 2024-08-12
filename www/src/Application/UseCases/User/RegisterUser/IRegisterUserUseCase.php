<?php

namespace App\Application\UseCases\User\RegisterUser;

use App\Application\Dtos\User\RegisterUserDto;
use App\Domain\Entities\User;

interface IRegisterUserUseCase
{
    public function execute(RegisterUserDto $input): User;
}
