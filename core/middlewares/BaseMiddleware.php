<?php
/* User: nicolashalberstadt 
* Date: 18/12/2020 
* Time: 13:50
*/

namespace app\core\middlewares;

/**
 * Class BaseMiddleware
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\middlewares
 */
abstract class BaseMiddleware
{
    abstract public function execute();
}