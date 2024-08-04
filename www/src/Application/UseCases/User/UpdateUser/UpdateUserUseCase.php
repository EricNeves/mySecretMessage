<?php

namespace App\Application\UseCases\User\UpdateUser;

use App\Application\Dtos\User\UpdateUserDto;
use App\Domain\Entities\User;
use App\Domain\Ports\In\PasswordHasherPort;
use App\Domain\Ports\Out\UserRepositoryPort;
use Exception;

class UpdateUserUseCase implements IUpdateUserUseCase
{
    public function __construct(private UserRepositoryPort $userRepository, private PasswordHasherPort $passwordHasher)
    {
    }

    public function execute(UpdateUserDto $updateUserDto): array
    {
        $passwordHash = $this->passwordHasher->hash($updateUserDto->password);

        $user = new User($updateUserDto->id, $updateUserDto->name, null, $passwordHash);

        $update = $this->userRepository->update($user);

        if (!$update) {
            throw new Exception("Sorry, we couldn't update your user.");
        }

        $getUser = $this->userRepository->findById($updateUserDto->id);

        return $getUser;
    }
}
