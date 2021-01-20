<?php
/** @var $model \app\models\User */

use nicolashalberstadt\phpmvc\form\Form;

$this->title = 'Register';
?>
<div class="form-container">
    <h3 class="text-center">Create an account</h3>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'firstname') ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'lastname') ?>
            </div>
        </div>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordField() ?>
        <?= $form->field($model, 'confirmPassword')->passwordField() ?>
        <div class="buttons">
            <div class="cancel">
                <button type="button" onclick="history.back(-1)" class="btn btn-outline-warning">Cancel</button>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
        
        <?php Form::end() ?>
    </div>
</div>