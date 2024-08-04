<?php

namespace App\Infrastructure\Http;

use stdClass;

class Jwt
{
    public function generate(mixed $data = []): string
    {
        $header  = json_encode(['alg' => 'HS256', 'typ' => 'JWT']);
        $payload = json_encode($data);

        $header_encoded  = $this->base64url_encode($header);
        $payload_encoded = $this->base64url_encode($payload);

        $signature = $this->signature($header_encoded, $payload_encoded);

        $jwt = "$header_encoded.$payload_encoded.$signature";

        return $jwt;
    }

    private function signature(string $header, string $payload): string
    {
        $signature = hash_hmac('sha256', $header . '.' . $payload, $_ENV['JWT_SECRET'], true);

        return $this->base64url_encode($signature);
    }

    private function base64url_encode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private function base64url_decode(string $data): stdClass
    {
        $padding = strlen($data) % 4;

        if ($padding) {
            $data .= str_repeat("=", 4 - $padding);
        }

        $data = strtr($data, '-_', '+/');

        return json_decode(base64_decode($data));
    }

    public function validate(string $token): bool | stdClass
    {
        $tokenPartials = explode('.', $token);

        if (count($tokenPartials) !== 3) {
            return false;
        }

        [$header_encoded, $payload_encoded, $signature] = $tokenPartials;

        if ($signature !== $this->signature($header_encoded, $payload_encoded)) {
            return false;
        }

        return $this->base64url_decode($payload_encoded);
    }
}
