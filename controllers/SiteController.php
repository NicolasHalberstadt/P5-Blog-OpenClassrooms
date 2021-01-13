<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 10:51
*/

namespace app\controllers;

use app\core\App;
use app\middlewares\AdminMiddleware;
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
    private Post $post;
    
    public function __construct()
    {
        $this->post = new Post();
    }
    
    // handling contact form on the home page
    public function home(Request $request, Response $response)
    {
        $posts = $this->post::findAll('updated_at');
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send($request)) {
                Application::$app->session->setFlash(
                    'success',
                    'Thanks for contacting me, I will get back to you soon'
                );
                return $response->redirect('/');
            }
        }
        return $this->render('home', [
            'model' => $contact,
            'posts' => $posts
        ]);
    }
}