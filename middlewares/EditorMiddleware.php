<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:49
*/

namespace app\middlewares;

use app\core\App;
use nicolashalberstadt\phpmvc\exceptions\ForbiddenException;
use nicolashalberstadt\phpmvc\middlewares\BaseMiddleware;

/**
 * Class EditorMiddleware
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\middlewares
 */
class EditorMiddleware extends BaseMiddleware
{

    public array $actions;

    /**
     * AuthMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (!App::isEditor()) {
            if (empty($this->actions) || in_array(App::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}