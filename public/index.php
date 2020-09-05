<?php
// Autoloader

use app\core\Application;
use app\controllers\SiteController;
use app\controllers\UserController;
use app\controllers\AuthController;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'db' => [
        'dsn'       => $_ENV['DB_DSN'],
        'user'      => $_ENV['DB_USER'],
        'password'  => $_ENV['DB_PASSWORD']
    ]
];

$app = new Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'index']);

$app->router->get('/contact', [SiteController::class, 'index']);

$app->router->get('/user', [UserController::class, 'index']);

$app->router->get('/userEdit/id', [UserController::class, 'update']);
$app->router->post('/userEdit/id', [UserController::class, 'update']);
$app->router->post('/userDelete/id', [UserController::class, 'delete']);

$app->router->get('/create', [UserController::class, 'create']);
$app->router->post('/create', [UserController::class, 'create']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);


$app->run();
