<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 10:51
*/

namespace app\controllers;

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
    /* public function home()
     {
         return $this->render('home');
     }*/

    // handling contact form on the home page
    public function home(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send($request)) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us, we will get back to you soon');
                return $response->redirect('/');
            }
        }
        return $this->render('home', [
            'model' => $contact
        ]);
    }
}