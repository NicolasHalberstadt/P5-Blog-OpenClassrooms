<?php
/** @var $model \app\models\User */
$this->title = 'Register';
?>
<div class="form-container">
    <h3 class="text-center">Create an account</h3>
    <div class="form">
        <?php $form = nicolashalberstadt\phpmvc\form\Form::begin('', 'post') ?>
        <div class="row">
            <div class="col">
                <?php echo $form->field($model, 'firstname') ?>
            </div>
            <div class="col">
                <?php echo $form->field($model, 'lastname') ?>
            </div>
        </div>
        <?php echo $form->field($model, 'email') ?>
        <?php echo $form->field($model, 'password')->passwordField() ?>
        <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php \nicolashalberstadt\phpmvc\form\Form::end() ?>
    </div>
</div>