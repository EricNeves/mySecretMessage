<?php

namespace App\Infrastructure\Exceptions;

use App\Infrastructure\Http\Response;
use Throwable;

class HandleExceptions
{
    public static function handle(Throwable $exception)
    {
        $response = new Response();

        $erros_code = [
            '23505' => [
                'message' => 'Sorry, email already exists',
                'status'  => 400,
            ],
            '401'   => [
                'message' => $exception->getMessage(),
                'status'  => $exception->getCode(),
            ],
            '7'     => [
                'message' => 'Sorry, could not connect to the Postgres database',
                'status'  => 500,
            ],
        ];

        if (array_key_exists($exception->getCode(), $erros_code)) {
            $response->json([
                "message" => $erros_code[$exception->getCode()]['message'],
            ], $erros_code[$exception->getCode()]['status']);
        }

        $response->json([
            "message" => $exception->getMessage(),
        ], 400);
    }
}
