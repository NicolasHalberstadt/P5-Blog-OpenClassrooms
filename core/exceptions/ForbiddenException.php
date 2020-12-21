<?php
/* User: nicolashalberstadt 
* Date: 18/12/2020 
* Time: 13:57
*/

namespace app\core\exceptions;

/**
 * Class ForbiddenException
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\exceptions
 */
class ForbiddenException extends \Exception
{
    protected $code = 403;
    protected $message = 'You don\'t have permission to access this page';
}