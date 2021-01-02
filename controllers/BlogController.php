<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:29
*/

namespace app\controllers;

use app\core\App;
use app\middlewares\EditorMiddleware;
use app\models\Comment;
use app\models\Post;
use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\Controller;
use nicolashalberstadt\phpmvc\exceptions\ForbiddenException;
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
        $this->registerMiddleware(new EditorMiddleware(['editPost']));
        $this->registerMiddleware(new EditorMiddleware(['deletePost']));
        $this->registerMiddleware(new EditorMiddleware(['validateComment']));
    }

    /* Post management */
    public function showPost(Request $request, Response $response)
    {
        $comment = new Comment();
        $post = Post::findOne(['id' => $_GET['id']]);
        $postId = $post->id;
        $comments = Comment::findAll('updated_at', $postId);
        if (!$post) {
            Application::$app->session->setFlash('error', 'No post with this id exists in the database');
            $response->redirect('/');
        }
        if ($request->isPost()) {
            $comment->loadData($request->getBody());
            if ($comment->validate() && $comment->save(['post_id' => $postId])) {
                Application::$app->session->setFlash('success', 'The comment will be publish when approved by an administrator');
                $response->redirect("/post?id=$postId");
            }
            return $this->render('post', [
                'post' => $post,
                'model' => $comment,
                'comments' => $comments
            ]);
        }

        return $this->render('post', [
            'post' => $post,
            'model' => $comment,
            'comments' => $comments
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
        $post = Post::findOne(['id' => $_GET['id']]);
        if (!$post) {
            Application::$app->session->setFlash('error', 'No post with this id exists in the database');
            $response->redirect('/admin');
        }
        if ($request->isPost()) {
            $post->loadData($request->getBody());
            $format = 'Y-m-d H:i:s';
            $currentDate = date($format);
            $post->updated_at = \DateTime::createFromFormat($format, $currentDate);
            $post->updated_at = $post->updated_at->format($format);
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

    public function deletePost(Request $request, Response $response)
    {
        $post = Post::findOne(['id' => $_GET['id']]);
        if (!$post) {
            Application::$app->session->setFlash('error', 'No post with this id exists in the database');
            $response->redirect('/admin');
        }
        if ($post->delete()) {
            Application::$app->session->setFlash('success', 'The post has been successfully deleted');
            $response->redirect('/admin');
        }
    }

    public function validateComment(Request $request, Response $response)
    {
        $comment = Comment::findOne(['id' => $_GET['id']]);
        $currentUser = App::$app->user;
        if (!App::isEditor()) {
            throw new ForbiddenException();
        }
        $comment->validated = 1;
        if (!$comment) {
            Application::$app->session->setFlash('error', 'No comment with this id exists in the database');
        }
        if ($comment->update()) {
            Application::$app->session->setFlash('success', 'The comment has been successfully validated');
            $postId = $comment->post_id;
            $response->redirect("/post?id=$postId");
        }
    }

    public function editComment(Request $request, Response $response)
    {
        $comment = Comment::findOne(['id' => $_GET['id']]);
        $currentUser = App::$app->user;
        if (!$currentUser) {
            throw new ForbiddenException();
        }
        if ($currentUser->id != $comment->user_id) {
            throw new ForbiddenException();
        }
        if (!$comment) {
            Application::$app->session->setFlash('error', 'Not comment found with this id');
        }
        if ($request->isPost()) {
            $comment->loadData($request->getBody());
            $format = 'Y-m-d H:i:s';
            $currentDate = date($format);
            $comment->updated_at = \DateTime::createFromFormat($format, $currentDate);
            $comment->updated_at = $comment->updated_at->format($format);
            $comment->validated = 0;
            if ($comment->update()) {
                Application::$app->session->setFlash('success', 'The comment has been successfully updated and will be validated by an administrator');
                $postId = $comment->post_id;
                $response->redirect("/post?id=$postId");
            }
            return $this->render('edit_comment', [
                'model' => $comment
            ]);
        }
        return $this->render('edit_comment', [
            'model' => $comment
        ]);
    }
}