<?php

namespace App\Infrastructure\Http;

class Route
{
    private static array $routes = [];

    public function __construct(
        private string $method,
        private string $path,
        private array $controllerWithAction,
        private array $middlewares = []
    ) {
        $this->register();
    }

    public static function get(string $path, array $controllerWithAction): self
    {
        return new self("GET", $path, $controllerWithAction);
    }

    public static function post(string $path, array $controllerWithAction): self
    {
        return new self("POST", $path, $controllerWithAction);
    }

    public static function put(string $path, array $controllerWithAction): self
    {
        return new self("PUT", $path, $controllerWithAction);
    }

    public static function delete(string $path, array $controllerWithAction): self
    {
        return new self("DELETE", $path, $controllerWithAction);
    }

    public function register(): void
    {
        self::$routes[] = [
            "method"      => $this->method,
            "path"        => $this->path,
            "controller"  => $this->controllerWithAction[0],
            "action"      => $this->controllerWithAction[1],
            "middlewares" => $this->middlewares,
        ];
    }

    public function middlewares(string ...$middlewares): self
    {
        array_pop(self::$routes);
        return new self($this->method, $this->path, $this->controllerWithAction, $middlewares);
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }
}
