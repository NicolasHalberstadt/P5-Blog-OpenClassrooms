<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 12:06
*/

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * Class Controller
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';

    /**
     * @var BaseMiddleware
     */
    protected array $middlewares = [];

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view, $params);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @return BaseMiddleware
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * @param BaseMiddleware $middlewares
     */
    public function setMiddlewares($middlewares): void
    {
        $this->middlewares = $middlewares;
    }
}