<?php
/* User: nicolashalberstadt 
* Date: 20/12/2020 
* Time: 18:46
*/

namespace app\core\exceptions;

/**
 * Class NotFoundException
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core\exceptions
 */
class NotFoundException extends \Exception
{
    protected $code = 404;
    protected $message = 'Page not found';
}