<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:29
*/

namespace app\controllers;

use app\middlewares\EditorMiddleware;
use app\models\Post;
use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\Controller;
use nicolashalberstadt\phpmvc\middlewares\AuthMiddleware;
use nicolashalberstadt\phpmvc\Request;
use nicolashalberstadt\phpmvc\Response;

/**
 * Class BlogController
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\controllers
 */
class BlogController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new EditorMiddleware(['addPost']));
    }

    public function addPost(Request $request, Response $response)
    {
        $post = new Post();
        if ($request->isPost()) {
            $post->loadData($request->getBody());
            if ($post->validate() && $post->save()) {
                Application::$app->session->setFlash('success', 'The post has been published successfully');
                Application::$app->response->redirect('/');
            }
            return $this->render('add_post', [
                'model' => $post
            ]);
        }
        return $this->render('add_post', [
            'model' => $post
        ]);
    }
}