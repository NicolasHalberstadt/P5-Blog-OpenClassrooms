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
 * Class AdminMiddleware
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\middlewares
 */
class AdminMiddleware extends BaseMiddleware
{

    public array $actions;

    /**
     * AdminMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (!App::isAdmin()) {
            if (empty($this->actions) || in_array(App::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
