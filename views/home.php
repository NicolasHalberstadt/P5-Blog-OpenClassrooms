<?php
/** @var $this View */
/** @var $model ContactForm */

/** @var $posts Post */

use app\core\App;
use app\models\ContactForm;
use app\models\Post;
use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;
use nicolashalberstadt\phpmvc\View;

$this->title = 'Home'
?>

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
