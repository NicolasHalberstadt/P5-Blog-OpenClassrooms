<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 15:36
*/
/** @var $model \app\models\User */
/** @var $userType string */
/** @var $userStatus string */
$this->title = 'Admin - edit user';
?>
<div class="form-container">
    <h3 class="text-center">Edit <?= $model->getDisplayName() ?>'s account</h3>
    <div class="form">
        <?php $form = nicolashalberstadt\phpmvc\form\Form::begin('', 'post') ?>

        <?php echo $form->field($model, 'firstname') ?>
        <?php echo $form->field($model, 'lastname') ?>
        <?php echo $form->field($model, 'email') ?>
        <?php echo new \app\core\form\UserTypeSelectInputField($model, 'type'); ?>
        <?php echo new \app\core\form\UserStatusSelectInputField($model, 'status'); ?>
        <button type="submit" class="btn btn-primary">Save</button>
        <a onClick="javascript: return confirm('Please confirm user deletion');"
           href="/user/delete?id=<?= $model->id ?>"
           class="btn btn-danger">Delete user</a>
        <?php \nicolashalberstadt\phpmvc\form\Form::end() ?>

    </div>
</div>