<?php

namespace App\Infrastructure\Http;

use Exception;
use stdClass;

class Request
{
    private stdClass $user;

    public function getMethod(): string
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public function body(): array
    {
        $json = json_decode(file_get_contents("php://input"), true) ?? [];

        $data = match ($this->getMethod()) {
            "GET" => $_GET,
            "POST" => $json,
            "PUT" => $json,
            "DELETE" => $json,
            default => []
        };

        return $data;
    }

    public function validate(array $fields): array
    {
        foreach ($fields as $field => $rules) {
            $value = $this->body()[$field] ?? null;

            foreach (explode("|", $rules) as $rule) {
                $this->validateRules($field, $value, $rule);
            }
        }

        return $this->body();
    }

    private function validateRules(string $field, mixed $value, string $rule): void
    {
        if ($rule === "required" && is_null($value)) {
            throw new Exception("The field {$field} is required");
        }

        if ($rule === "email" && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("The field {$field} is not a valid email");
        }

        if ($rule === "numeric" && !is_numeric($value)) {
            throw new Exception("The field {$field} is not a valid integer");
        }

        if ($rule === "string" && !is_string($value)) {
            throw new Exception("The field {$field} is not a valid string");
        }
    }

    public function bearerToken(): string
    {
        $headers = getallheaders();

        if (!isset($headers['Authorization'])) {
            throw new Exception("Please, provide a bearer token", 401);
        }

        $tokenPartials = explode(" ", $headers["Authorization"]);

        if (count($tokenPartials) !== 2 || $tokenPartials[0] !== "Bearer") {
            throw new Exception("Please, provide a bearer token", 401);
        }

        return $tokenPartials[1];
    }

    public function setUser(stdClass $user): void
    {
        $this->user = $user;
    }

    public function user(): stdClass
    {
        return $this->user;
    }
}
