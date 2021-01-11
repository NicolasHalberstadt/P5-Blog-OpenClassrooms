<?php
/* User: nicolashalberstadt 
* Date: 30/12/2020 
* Time: 16:42
*/
?>
<?php

use app\models\Post;
use nicolashalberstadt\phpmvc\form\TextareaField;
use nicolashalberstadt\phpmvc\form\Form;

/**@var $model Post */
$this->title = 'Edit comment';
?>
<div class="form-container">
    <h3 class="text-center">Edit comment</h3>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>
        <?=  new TextareaField($model, 'content') ?>
        <button type="submit" class="btn btn-primary">Save</button>

        <?php \nicolashalberstadt\phpmvc\form\Form::end() ?>
    </div>
</div>