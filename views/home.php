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
<h1>Home</h1>

<!-- Posts lists -->
<h2>Posts list</h2>
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($posts as $post) : ?>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $post['title'] ?></h5>
                    <p class="card-text"><?= $post['chapo'] ?></p>
                    <p class="card-text"><small
                                class="text-muted">Last modified on <?php $t = strtotime($post['updated_at']);
                            echo date('F jS Y', $t); ?></small>
                    </p>
                    <a href="post?id=<?= $post['id'] ?>" class="btn btn-primary">Read the post</a>
                    <?php if (App::isEditor()): ?>
                        <a href="post/edit?id=<?= $post['id'] ?>" class="btn btn-info">Edit the post</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<!-- Posts lists -->
<!-- Contact form -->
<h3><a id="contact"></a>Contact</h3>

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
<!-- Contact form -->
