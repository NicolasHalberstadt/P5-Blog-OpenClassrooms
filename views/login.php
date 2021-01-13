<?php
/** @var $model \app\models\User */

use nicolashalberstadt\phpmvc\form\Form;

$this->title = 'Login';
?>
<div class="form-container">
    <h3 class="text-center">Login</h3>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordField() ?>

        <button type="submit" class="btn btn-primary">Submit</button>
        
        <?php Form::end() ?>
    </div>
</div>