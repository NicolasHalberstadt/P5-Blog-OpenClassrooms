<?php
/* User: nicolashalberstadt 
* Date: 30/12/2020 
* Time: 16:42
*/
?>
<?php

use app\core\form\PostUserSelectInputField;
use app\models\Post;
use nicolashalberstadt\phpmvc\form\TextareaField;
use nicolashalberstadt\phpmvc\form\Form;

/**@var $model Post */
$this->title = 'Edit post';
?>
<div class="form-container">
    <h3 class="text-center">Edit post</h3>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>

        <?php echo $form->field($model, 'title') ?>
        <?php echo $form->field($model, 'chapo') ?>
        <?php echo new TextareaField($model, 'content') ?>
        <?php echo new PostUserSelectInputField($model, 'user_id') ?>
        <button type="submit" class="btn btn-primary">Save</button>

        <?php \nicolashalberstadt\phpmvc\form\Form::end() ?>
    </div>
</div>