<?php
/** @var $this View */
/** @var $model ContactForm */

/** @var $posts Post */

use app\models\ContactForm;
use app\models\Post;
use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;
use nicolashalberstadt\phpmvc\View;

$this->title = 'Home'
?>

<div class="presentation-container">
    <div class="presentation">
        <h2>Who am I ?</h2>
        <p>My name is Nicolas Halberstadt, I am 22 years old, I live in Aix-en-Provence and I am a web and web mobile
            developer, specialized in Symfony.
            I am passionate about new technologies, I like to discover new worlds. I love traveling, playing sports and
            coding ... Of course!</p>
        <h2>My journey</h2>
        <p>After looking for my path for a few years after my baccalaureate and having always been attracted by the
            digital
            world, I started looking for training in this field. I chose the O'Clock school, Certified
            <a href="https://www.grandeecolenumerique.fr">
                "Grande École du Numérique"
            </a>
            , modern, dynamic and young: 5 intensive months to become a web developer, learning code in
            (almost) every
            way. 5 months to give us the tools to continue learning. Today, I'm studying PHP and Symfony through
            OpenClassrooms'
            course
            <a href="https://openclassrooms.com/fr/paths/59-developpeur-dapplication-php-symfony">
                "PHP/Symfony Application developer"
            </a>.
        </p>
    </div>
</div>
<!-- Contact form -->
<div class="form-container container">
    <div class="intro">
        <h3 class="text-center"><a id="contact"></a>Contact</h3>
    </div>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>
        <div class="row">
            <div class="col">
                <?php echo $form->field($model, 'firstname') ?>
            </div>
            <div class="col">
                <?php echo $form->field($model, 'lastname') ?>
            </div>
        </div>
        <?php echo $form->field($model, 'email'); ?>
        <?php echo $form->field($model, 'subject'); ?>
        <?php echo new TextareaField($model, 'body') ?>

        <button type="submit" class="btn btn-primary">Submit</button>
        <?php $form = Form::end(); ?>
    </div>
    <!-- Contact form -->
</div>
