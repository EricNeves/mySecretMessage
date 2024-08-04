<?php

namespace App\Domain\Ports\Out;

use App\Domain\Entities\Message;

interface MessageRepositoryPort
{
    public function save(Message $message): void;
    public function exists(string $id): bool;
    public function fetchMessageByID(string $id): array;
    public function update(Message $message): void;
    public function remove(string $id): void;
}
