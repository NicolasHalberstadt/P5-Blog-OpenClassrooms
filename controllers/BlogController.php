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

    public function showPost(Request $request, Response $response)
    {
        $post = Post::findOne(['id' => $_GET['id']]);
        if (!$post) {
            Application::$app->session->setFlash('error', 'No post with this id exists in the database');
            $response->redirect('/');
        }
        return $this->render('post', [
            'post' => $post
        ]);
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

    public function editPost(Request $request, Response $response)
    {
        $postId = $_GET['id'];
        $post = Post::findOne(['id' => $postId]);
        if (!$post) {
            Application::$app->session->setFlash('error', 'No post with this id exists in the database');
            $response->redirect('/admin');
        }
        if ($request->isPost()) {
            $post->loadData($request->getBody());
            if ($post->update()) {
                Application::$app->session->setFlash('success', 'The post has been successfully updated');
            }
            return $this->render('edit_post', [
                'model' => $post
            ]);
        }
        return $this->render('edit_post', [
            'model' => $post
        ]);
    }
}