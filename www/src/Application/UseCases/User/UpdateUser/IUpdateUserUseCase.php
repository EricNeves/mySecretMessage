<?php

namespace App\Application\UseCases\User\UpdateUser;

use App\Application\Dtos\User\UpdateUserDto;

interface IUpdateUserUseCase
{
    public function execute(UpdateUserDto $updateUserDto): array;
}
