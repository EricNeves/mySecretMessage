<?php

namespace App\Domain\Ports\Out;

use App\Domain\Entities\User;

interface UserRepositoryPort
{
    public function save(User $user): bool;
    public function findByEmail(string $email): bool | array;
    public function findById(string $id): bool | array;
    public function update(User $user): bool;
}
