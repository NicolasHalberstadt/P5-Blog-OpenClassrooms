<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 09:08
*/

use app\controllers\AdminController;
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

// Site
$app->router->get('/', [SiteController::class, 'home']);
$app->router->post('/', [SiteController::class, 'home']);
$app->router->get('/cv', [SiteController::class, 'cv']);

// Admin
$app->router->get('/admin', [AdminController::class, 'index']);
$app->router->get('/admin/posts', [AdminController::class, 'adminPosts']);
$app->router->get('/admin/users', [AdminController::class, 'adminUsers']);
$app->router->get('/user/edit', [AdminController::class, 'editUser']);
$app->router->post('/user/edit', [AdminController::class, 'editUser']);
$app->router->get('/user/delete', [AdminController::class, 'deleteUser']);
$app->router->post('/user/delete', [AdminController::class, 'deleteUser']);

// Auth
$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);

// Blog
$app->router->get('/blog', [BlogController::class, 'blog']);
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
$app->router->get('/comment/delete', [BlogController::class, 'deleteComment']);
$app->router->post('/comment/delete', [BlogController::class, 'deleteComment']);

$app->run();