<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 11:37
*/

/**@var $model \app\models\Post */

use app\core\form\PostUserSelectInputField;
use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;

$this->title = 'Add blog post';
?>
<div class="form-container">
    <h3 class="text-center">Add a blog post</h3>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>
        
        <?= $form->field($model, 'title') ?>
        <?= $form->field($model, 'chapo') ?>
        <?= new TextareaField($model, 'content') ?>
        <?= new PostUserSelectInputField($model, 'user_id') ?>
        <div class="buttons">
            <div>
                <button type="button" onclick="history.back(-1)" class="btn btn-outline-warning">Cancel</button>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        <?php Form::end() ?>
    </div>
</div>
