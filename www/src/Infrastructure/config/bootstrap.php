<?php
use App\Infrastructure\Http\Controller;
use App\Infrastructure\Http\Request;
use App\Infrastructure\Http\Response;

function dispatch(array $routes, array $middlewares): void
{
    $url = "/";

    isset($_GET["url"]) && $url .= $_GET["url"];

    $url !== "/" && $url = rtrim($url, "/");

    $routerFound = false;

    $request  = new Request();
    $response = new Response();

    foreach ($routes as $route) {
        $pattern = "#^" . preg_replace('/{id}/', "([\w-]+)", $route['path']) . "$#";

        if (preg_match($pattern, $url, $params)) {
            array_shift($params);

            $routerFound = true;

            if ($route['method'] !== $request->getMethod()) {
                $response->json([
                    "message" => "Method not allowed",
                ], 405);
            }

            foreach ($route['middlewares'] as $middleware) {
                if (array_key_exists($middleware, $middlewares)) {
                    $middlewareClass = new $middlewares[$middleware]();
                    $middlewareClass->handle($request, $response);
                }
            }

            $controller = Controller::resolveDependecies($route['controller']);
            $action     = $route['action'];

            $controller->$action($request, $response, $params);
        }
    }

    if (!$routerFound) {
        $response->json([
            "message" => "Route not found",
        ], 404);
    }
}
