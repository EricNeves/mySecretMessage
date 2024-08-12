<?php

namespace App\Application\UseCases\User\FetchUser;

use App\Domain\Entities\User;
use App\Domain\Ports\Out\UserRepositoryPort;
use Exception;

class FetchUserUseCase implements IFetchUserUseCase
{
    public function __construct(private UserRepositoryPort $userRepository)
    {
    }

    public function execute(string $id): User
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new Exception("Sorry, we couldn't find user");
        }

        unset($user->password);

        return $user;
    }
}
