<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 09:08
*/

use app\controllers\AuthController;
use app\controllers\BlogController;
use app\controllers\SiteController;
use nicolashalberstadt\phpmvc\Application;
use app\models\User;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

$app = new Application(dirname(__DIR__), $config);

// handling contact form on the home page
$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/', [SiteController::class, 'home']);
$app->router->get('/admin', [SiteController::class, 'admin']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

$app->router->get('/post/add', [BlogController::class, 'addPost']);
$app->router->post('/post/add', [BlogController::class, 'addPost']);

$app->run();