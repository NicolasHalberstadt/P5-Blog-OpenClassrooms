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
    public function __construct()
    {
        $this->registerMiddleware(new EditorMiddleware(['admin']));
        $this->registerMiddleware(new AdminMiddleware(['deleteUser']));
    }

    // handling contact form on the home page
    public function home(Request $request, Response $response)
    {
        $posts = Post::findAll('updated_at');
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send($request)) {
                Application::$app->session->setFlash('success', 'Thanks for contacting me, I will get back to you soon');
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
        $posts = Post::findAll();
        $isAdmin = App::isAdmin();
        $this->layout = 'admin';
        return $this->render('admin', [
                'users' => $users,
                'posts' => $posts,
                'isAdmin' => $isAdmin
            ]
        );
    }

    public function editUser(Request $request, Response $response)
    {
        $userId = $_GET['id'];
        $user = User::findOne(['id' => $userId]);
        $userType = null;
        $userStatus = null;
        // changing userType and userStatus int into string for display
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
        if (!$user) {
            Application::$app->session->setFlash('error', 'No user with this id exists');
            $response->redirect('/admin');
        }
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->update()) {
                Application::$app->session->setFlash('success', 'The user has been successfully updated');
                $response->redirect('/admin');
            }
            return $this->render('edit_user', [
                'userType' => $userType,
                'userStatus' => $userStatus,
                'model' => $user
            ]);
        }
        return $this->render('edit_user', [
            'userType' => $userType,
            'userStatus' => $userStatus,
            'model' => $user
        ]);
    }

    public function deleteUser(Response $response)
    {
        $user = User::findOne(['id' => $_GET['id']]);
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
}