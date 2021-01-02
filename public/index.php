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

// Home
$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/', [SiteController::class, 'home']);

// Admin
$app->router->get('/admin', [SiteController::class, 'admin']);
$app->router->get('/user/edit', [SiteController::class, 'editUser']);
$app->router->post('/user/edit', [SiteController::class, 'editUser']);
$app->router->get('/user/delete', [SiteController::class, 'deleteUser']);
$app->router->post('/user/delete', [SiteController::class, 'deleteUser']);


// Auth
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/profile', [AuthController::class, 'profile']);

// Blog
$app->router->get('/post', [BlogController::class, 'showPost']);
$app->router->post('/post', [BlogController::class, 'showPost']);
$app->router->get('/post/add', [BlogController::class, 'addPost']);
$app->router->post('/post/add', [BlogController::class, 'addPost']);
$app->router->get('/post/edit', [BlogController::class, 'editPost']);
$app->router->post('/post/edit', [BlogController::class, 'editPost']);
$app->router->post('/post/delete', [BlogController::class, 'deletePost']);
$app->router->get('/post/delete', [BlogController::class, 'deletePost']);
$app->router->get('/comment/validate', [BlogController::class, 'validateComment']);
$app->router->post('/comment/validate', [BlogController::class, 'validateComment']);
$app->router->get('/comment/edit', [BlogController::class, 'editComment']);
$app->router->post('/comment/edit', [BlogController::class, 'editComment']);

$app->run();