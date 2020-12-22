<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 14:02
*/

namespace app\core;

use nicolashalberstadt\phpmvc\Application;

/**
 * Class App
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\core
 */
class App extends Application
{
    public static function isEditor(): bool
    {
        if (Application::$app->user) {
            $userType = Application::$app->user->user_type;
            if ($userType == 2 || $userType == 3) {
                return true;
            }
            return false;
        }
        return false;
    }

    public static function isAdmin(): bool
    {
        if (Application::$app->user) {
            $userType = Application::$app->user->user_type;
            if ($userType == 3) {
                return true;
            }
            return false;
        }
        return false;
    }
}