<?php

namespace App\Adapters\Out\Persistence\DAOs;

use App\Domain\Entities\User;
use PDO;

class UserPostgresDAO
{
    public function __construct(private PDO $pdo)
    {
    }

    public function save(User $user): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO hx_users (name, email, password)
            VALUES (?, ?, ?)
        ");

        $stmt->execute([
            $user->name,
            $user->email,
            $user->password,
        ]);

        return $this->pdo->lastInsertId() > 0;
    }

    public function findByEmail(string $email): ?User
    {
        $stmt = $this->pdo->prepare("
            SELECT * FROM hx_users WHERE email = ?
        ");

        $stmt->execute([$email]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new User($result['id'], $result['name'], $result['email'], $result['password']);
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->pdo->prepare("
            SELECT id, name, email FROM hx_users WHERE id = ?
        ");

        $stmt->execute([$id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return null;
        }

        return new User($result["id"], $result["name"], $result["email"], null);
    }

    public function update(User $user): bool
    {
        $stmt = $this->pdo->prepare("
            UPDATE hx_users SET name = ?, password = ? WHERE id = ?
        ");

        $stmt->execute([
            $user->name,
            $user->password,
            $user->id,
        ]);

        return $stmt->rowCount() > 0;
    }
}
