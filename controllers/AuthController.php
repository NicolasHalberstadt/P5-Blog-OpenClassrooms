<?php
/* User: nicolashalberstadt 
* Date: 17/12/2020 
* Time: 12:08
*/

namespace app\controllers;

use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\Controller;
use nicolashalberstadt\phpmvc\middlewares\AuthMiddleware;
use nicolashalberstadt\phpmvc\Request;
use nicolashalberstadt\phpmvc\Response;
use app\models\LoginForm;
use app\models\User;

/**
 * Class AuthController
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\controllers
 */
class AuthController extends Controller
{

    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                return $response->redirect('/');
            }
        }

        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->logout();
        $response->redirect('/');
    }
}