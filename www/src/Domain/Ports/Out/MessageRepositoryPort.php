<?php

namespace App\Domain\Ports\Out;

use App\Domain\Entities\Message;

interface MessageRepositoryPort
{
    public function save(Message $message): void;
    public function exists(string $id): bool;
    public function fetchMessageByID(string $id): ?Message;
    public function update(Message $message): void;
    public function remove(string $id): void;
}
