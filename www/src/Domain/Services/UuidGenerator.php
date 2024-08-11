<?php

namespace App\Domain\Services;

interface UuidGenerator
{
    public function generate(): string;
}
