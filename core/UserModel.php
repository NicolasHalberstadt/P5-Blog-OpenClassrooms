<?php
/* User: nicolashalberstadt 
* Date: 18/12/2020 
* Time: 13:39
*/

namespace app\core;

/**
 * Class UserModel
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core
 */
abstract class UserModel extends DbModel
{
    abstract public function getDisplayName();

}