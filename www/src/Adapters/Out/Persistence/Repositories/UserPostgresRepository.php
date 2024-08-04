<?php

namespace App\Adapters\Out\Persistence\Repositories;

use App\Adapters\Out\Persistence\DAOs\UserPostgresDAO;
use App\Domain\Entities\User;
use App\Domain\Ports\Out\UserRepositoryPort;

class UserPostgresRepository implements UserRepositoryPort
{
    public function __construct(private UserPostgresDAO $user)
    {
    }

    public function save(User $user): bool
    {
        return $this->user->save($user);
    }

    public function findByEmail(string $email): bool | array
    {
        return $this->user->findByEmail($email);
    }

    public function findById(string $id): array | bool
    {
        return $this->user->findById($id);
    }

    public function update(User $user): bool
    {
        return $this->user->update($user);
    }
}
