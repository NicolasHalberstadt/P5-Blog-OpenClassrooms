<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 10:51
*/

namespace app\controllers;

use app\core\App;
use app\middlewares\EditorMiddleware;
use app\models\Post;
use app\models\User;
use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\Controller;
use nicolashalberstadt\phpmvc\Request;
use nicolashalberstadt\phpmvc\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new EditorMiddleware(['admin']));
    }

    /* public function home()
     {
         return $this->render('home');
     }*/

    // handling contact form on the home page
    public function home(Request $request, Response $response)
    {
        $posts = Post::findAll();
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send($request)) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us, we will get back to you soon');
                return $response->redirect('/');
            }
        }
        return $this->render('home', [
            'model' => $contact,
            'posts' => $posts
        ]);
    }

    public function admin()
    {
        $users = User::findAll();
        $isAdmin = App::isAdmin();
        $this->layout = 'admin';
        return $this->render('admin', [
                'users' => $users,
                'isAdmin' => $isAdmin
            ]
        );
    }
}