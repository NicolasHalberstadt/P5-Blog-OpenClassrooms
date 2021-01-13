<?php
/* User: nicolashalberstadt 
* Date: 18/12/2020 
* Time: 10:29
*/

namespace app\models;

use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\Model;

/**
 * Class LoginForm
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\models
 */
class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';
    
    private User $user;
    
    public function __construct()
    {
        $this->user = new User();
    }
    
    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED]
        ];
    }
    
    public function labels(): array
    {
        return [
            'email' => 'Your email',
            'password' => 'Your password'
        ];
    }
    
    public function login()
    {
        $user = $this->user::findOne(['email' => $this->email]);
        if (!$user || $user->status === 2) {
            $this->addError('email', 'User does not exist with this email address');
            return false;
        }
        if ($user->status === 0) {
            $this->addError(
                'email',
                'The user with this email has not yet been approved,
                please wait until an administrator activate your account.'
            );
            return false;
        }
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        
        return Application::$app->login($user);
    }
}