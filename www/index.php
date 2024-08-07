<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/Infrastructure/config/bootstrap.php";
require_once __DIR__ . "/src/Infrastructure/config/cors.php";
require_once __DIR__ . "/src/Adapters/In/Web/routes/api.php";

$middlewares = require_once __DIR__ . "/src/Infrastructure/config/middlewares.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Infrastructure\Exceptions\HandleExceptions;
use App\Infrastructure\Http\Route;

set_exception_handler([HandleExceptions::class, "handle"]);

allowCors();

dispatch(Route::getRoutes(), $middlewares);
