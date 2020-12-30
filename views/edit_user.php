<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 15:36
*/
/** @var $model \app\models\User */
/** @var $userType string */
/** @var $userStatus string */

?>
    <h1>Edit <?= $model->getDisplayName() ?>'s account</h1>
<?php $form = nicolashalberstadt\phpmvc\form\Form::begin('', 'post') ?>

<?php echo $form->field($model, 'firstname') ?>
<?php echo $form->field($model, 'lastname') ?>
<?php echo $form->field($model, 'email') ?>
<?php echo new \app\core\form\DisabledInputField($model, 'password') ?>
<?php echo new \app\core\form\UserTypeSelectInputField($model, 'type'); ?>
<?php echo new \app\core\form\UserStatusSelectInputField($model, 'status'); ?>
    <button type="submit" class="btn btn-primary">Save</button>

<?php \nicolashalberstadt\phpmvc\form\Form::end() ?>