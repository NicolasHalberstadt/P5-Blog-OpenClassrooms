<?php
/* User: nicolashalberstadt
* Date: 07/01/2021
* Time: 19:05
*/

namespace app\controllers;

use app\core\App;
use app\middlewares\AdminMiddleware;
use app\middlewares\EditorMiddleware;
use app\models\Comment;
use app\models\Post;
use app\models\User;
use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\Controller;
use nicolashalberstadt\phpmvc\Request;
use nicolashalberstadt\phpmvc\Response;

/**
 * Class AdminController
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\controllers
 */
class AdminController extends Controller
{
    
    private Post $post;
    private User $user;
    private Comment $comment;
    
    public function __construct()
    {
        $this->registerMiddleware(new EditorMiddleware(['index']));
        $this->registerMiddleware(new EditorMiddleware(['adminPosts']));
        $this->registerMiddleware(new AdminMiddleware(['adminUsers']));
        $this->registerMiddleware(new AdminMiddleware(['editUsers']));
        $this->registerMiddleware(new AdminMiddleware(['deleteUser']));
        
        $this->user = new User();
        $this->post = new Post();
        $this->comment = new Comment();
    }
    
    public function index()
    {
        $this->layout = 'admin';
        $recentUsers = $this->user::findRecent(3);
        $recentPosts = $this->post::findRecent(3);
        $invalidComments = $this->comment::findInvalid();
        $isAdmin = App::isAdmin();
        return $this->render('/admin/index', [
            'recentUsers' => $recentUsers,
            'recentPosts' => $recentPosts,
            'invalidComments' => $invalidComments,
            'isAdmin' => $isAdmin
        ]);
    }
    
    public function adminUsers()
    {
        $this->layout = 'admin';
        $users = $this->user::findAll();
        return $this->render('admin/users', [
            'users' => $users
        ]);
    }
    
    public function adminPosts()
    {
        $this->layout = 'admin';
        $posts = $this->post::findAll();
        return $this->render('admin/posts', [
            'posts' => $posts
        ]);
    }
    
    public function editUser(Request $request, Response $response)
    {
        $this->layout = 'admin';
        if (isset($request->get['id'])) {
            $userId = $request->get['id'];
        }
        $user = $this->user::findOne(['id' => $userId]);
        if (!$user) {
            Application::$app->session->setFlash('error', 'No user with this id exists');
            $response->redirect('/admin');
        }
        $userType = $this->userType($user);
        $userStatus = $this->userStatus($user);
        // changing userType and userStatus int into string for display
        
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->update()) {
                Application::$app->session->setFlash('success', 'The user has been successfully updated');
                $response->redirect('/admin');
            }
            return $this->render('/admin/edit_user', [
                'userType' => $userType,
                'userStatus' => $userStatus,
                'model' => $user
            ]);
        }
        return $this->render('/admin/edit_user', [
            'userType' => $userType,
            'userStatus' => $userStatus,
            'model' => $user
        ]);
    }
    
    public function deleteUser(Request $request, Response $response)
    {
        $userId = null;
        if (isset($request->get['id'])) {
            $userId = $request->get['id'];
        }
        $user = $this->user::findOne(['id' => $userId]);
        if (!$user) {
            Application::$app->session->setFlash('error', 'No user with this id exists in the database');
            $response->redirect('/admin');
        }
        // make all of user's data empty to avoid post deletion
        $user->firstname = 'member';
        $user->lastname = '';
        $user->email = '';
        $user->status = 2;
        $user->type = 1;
        $user->password = '';
        if ($user->update()) {
            Application::$app->session->setFlash('success', 'The user has been successfully deleted');
            $response->redirect('/admin');
        }
    }
    
    private function userType(User $user): string
    {
        $userType = '';
        switch ($user->type) {
            case 1:
                $userType = 'Member';
                break;
            case 2:
                $userType = 'Editor';
                break;
            case 3:
                $userType = 'Admin';
                break;
        }
        return $userType;
    }
    
    private function userStatus(User $user): string
    {
        $userStatus = '';
        switch ($user->status) {
            case 0:
                $userStatus = 'Inactive';
                break;
            case 1:
                $userStatus = 'Active';
                break;
            case 2:
                $userStatus = 'Deleted';
                break;
        }
        return $userStatus;
    }
}
