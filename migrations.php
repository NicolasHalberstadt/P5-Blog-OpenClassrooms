<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020
* Time: 09:08
*/

use app\models\User;
use nicolashalberstadt\phpmvc\Application;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'userClass' => User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ],
];

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();