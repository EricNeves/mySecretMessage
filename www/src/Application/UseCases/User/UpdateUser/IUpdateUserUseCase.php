<?php

namespace App\Application\UseCases\User\UpdateUser;

use App\Application\Dtos\User\UpdateUserDto;
use App\Domain\Entities\User;

interface IUpdateUserUseCase
{
    public function execute(UpdateUserDto $updateUserDto): User;
}
