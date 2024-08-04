<?php

namespace App\Infrastructure\Http;

class Response
{
    public function json(mixed $data = [], int $status = 200): void
    {
        header("Content-Type: application/json");
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
}
