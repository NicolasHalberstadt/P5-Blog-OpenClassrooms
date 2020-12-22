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
<h1>Home</h1>

<!-- Posts lists -->
<h2>Posts list</h2>
<?php foreach ($posts as $post) : ?>
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= $post['chapo'] ?></p>
                    <a href="#" class="btn btn-primary">Read the post</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!-- Posts lists -->
<!-- Contact form -->
<h3><a id="contact"></a>Contact</h3>

<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body') ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php $form = Form::end(); ?>
<!-- Contact form -->
