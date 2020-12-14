<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 09:34
*/

namespace app\core;

/**
 * Class Request
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core
 */
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return $path = substr($path, 0, $position);
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);

    }
}