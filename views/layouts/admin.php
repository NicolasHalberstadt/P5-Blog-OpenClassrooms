<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 10:25
*/

use app\core\App;
use nicolashalberstadt\phpmvc\Application;

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=""/>
    <meta name="author" content=""/>

    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/4b9ba14b0f.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet"
          type="text/css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="/css/theme.css">
    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" href="/assets/img/favicon.ico">

    <title><?= $this->title ?> | Nicolas Halberstadt - Symfony/PHP web developer</title>
</head>
<body>
<div class="alert-container container fixed-bottom">
    <?php if (Application::$app->session->getFlash('error')): ?>
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?=  Application::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
    <?php if (Application::$app->session->getFlash('success')): ?>
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?=  Application::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
</div>
<nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/assets/img/profilepic.jpg" alt="">
        </a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded"
                type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if (App::isEditor()): ?>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                           href="/post/add">Add a post
                            <i class="fas fa-pen-fancy"></i>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                       href="/blog">Blog
                        <i class="far fa-newspaper"></i>
                    </a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a target="_blank" class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                       href="assets/img/cv.pdf">CV
                        <i class="fas fa-user-circle"></i>
                    </a>
                </li>
                <li class="nav-item mx-0 mx-lg-1">
                    <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                       href="/#contact">Contact
                        <i class="fas fa-envelope-open-text"></i>
                    </a>
                </li>
                <?php if (Application::isGuest()): ?>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                           href="/login">Login</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                           href="/register">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger"
                           href="/logout">Logout
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <header class="masthead bg-primary text-white text-center">
        <div class="d-flex align-items-center flex-column">
            <!-- Masthead Avatar Image-->
            <!--<img class="masthead-avatar mb-5" src="assets/img/avataaars.svg" alt=""/>-->
            <!-- Masthead Heading-->
            <h1 class="masthead-heading text-uppercase mb-0">Admin panel</h1>
            <!-- Icon Divider-->
            <div class="divider-custom divider-light">
                <div class="divider-custom-line"></div>
                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                <div class="divider-custom-line"></div>
            </div>
            <!-- Masthead Subheading-->
            <p class="masthead-subheading font-weight-light mb-0">Hello <?= Application::$app->user->firstname ?>,
                welcome to the admin panel</p>
        </div>
    </header>
    <?php $currentPage = $_SERVER['REQUEST_URI']; ?>
    <div class="admin">
        <nav class="admin-nav">
            <?php if (App::isAdmin()) :
                $links = [
                    'Admin' => '/admin',
                    'Users' => '/admin/users',
                    'Posts' => '/admin/posts',
                ];
            elseif (App::isEditor()) :
                $links = [
                    'Admin' => '/admin',
                    'Posts' => '/admin/posts',
                ];
            endif; ?>
            <ul class="nav flex-column">
                <?php foreach ($links as $link => $href) :
                    if ($currentPage == $href) :?>
                        <li class="nav-item active">
                    <?php else : ?>
                        <li class="nav-item">
                    <?php endif; ?>
                    <a class="nav-link"
                       href=<?= $href ?>><?= $link ?>
                    </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        {{content}}
    </div>
</div>
<footer class="footer text-center">
    <div class="container">
        <div class="row">
            <!-- Footer Location-->
            <div class="col-lg-3 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Location</h4>
                <p class="lead mb-0">
                    Aix-en-Provence, 13100
                    <br/>
                    France
                </p>
            </div>
            <!-- Footer Social Icons-->
            <div class="col-lg-3 mb-5 mb-lg-0">
                <h4 class="text-uppercase mb-4">Around the Web</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="https://www.linkedin.com/in/nicolashalberstadt/">
                    <i class="fab fa-fw fa-linkedin-in"></i>
                </a>
                <a class="btn btn-outline-light btn-social mx-1" href="https://github.com/NicolasHalberstadt">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Footer About Text-->
            <div class="col-lg-3">
                <h4 class="text-uppercase mb-4">About Freelancer</h4>
                <p class="lead mb-0">
                    Freelance is a free to use, MIT licensed Bootstrap theme created by
                    <a href="http://startbootstrap.com">Start Bootstrap</a>
                    .
                </p>
            </div>
            <div class="col-lg-3">
                <h4 class="text-uppercase mb-4">Admin panel</h4>
                <a class="btn btn-outline-light btn-social mx-1" href="/admin">
                    <i class="fas fa-user-lock"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

<!-- Option 2: jQuery, Popper.js, and Bootstrap JS
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
-->
</body>
</html>