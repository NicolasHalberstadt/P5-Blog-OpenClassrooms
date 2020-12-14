<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 09:08
*/

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\Application;

$app = new Application();

$app->router->get('/', function () {
    return 'Hello World';
});
$app->router->get('/contact', function () {
    return 'Contact';
});

$app->run();