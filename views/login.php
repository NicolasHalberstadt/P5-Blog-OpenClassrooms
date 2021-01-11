<?php
/** @var $model \app\models\User */
$this->title = 'Login';
?>
<div class="form-container">
    <h3 class="text-center">Login</h3>
    <div class="form">
        <?php $form = nicolashalberstadt\phpmvc\form\Form::begin('', 'post') ?>
        <?=  $form->field($model, 'email') ?>
        <?=  $form->field($model, 'password')->passwordField() ?>

        <button type="submit" class="btn btn-primary">Submit</button>

        <?php \nicolashalberstadt\phpmvc\form\Form::end() ?>
    </div>
</div>