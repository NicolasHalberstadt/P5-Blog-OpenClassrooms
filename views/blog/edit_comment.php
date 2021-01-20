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
        <?= new TextareaField($model, 'content') ?>
        <div class="buttons">
            <button type="button" onclick="history.back(-1)" class="btn btn-outline-warning">Cancel</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
        <?php Form::end() ?>
    </div>
</div>