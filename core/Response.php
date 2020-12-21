<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 10:34
*/

namespace app\core;

/**
 * Class Response
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core
 */
class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url);
    }
}