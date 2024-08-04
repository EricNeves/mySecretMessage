<?php

namespace App\Application\UseCases\User\FetchUser;

use App\Domain\Ports\Out\UserRepositoryPort;
use Exception;

class FetchUserUseCase implements IFetchUserUseCase
{
    public function __construct(private UserRepositoryPort $userRepository)
    {
    }

    public function execute(string $id): array
    {
        $user = $this->userRepository->findById($id);

        if (!$user) {
            throw new Exception("Sorry, we couldn't find user");
        }

        return $user;
    }
}
