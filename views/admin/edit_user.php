<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 15:36
*/
/** @var $model User */
/** @var $userType string */

/** @var $userStatus string */

use app\core\form\UserStatusSelectInputField;
use app\core\form\UserTypeSelectInputField;
use app\models\User;
use nicolashalberstadt\phpmvc\form\Form;

$this->title = 'Admin panel - Edit user';
?>
<div class="form-container">
    <h3 class="text-center">Edit <?= $this->clean($model->getDisplayName()) ?>'s account</h3>
    <div class="form">
        <?php $form = Form::begin('', 'post') ?>
        <div class="row">
            <div class="col">
                <?= $form->field($model, 'firstname'); ?>
            </div>
            <div class="col">
                <?= $form->field($model, 'lastname') ?>
            </div>
        </div>
        <?= $form->field($model, 'email') ?>
        <?= new UserTypeSelectInputField($model, 'type'); ?>
        <?= new UserStatusSelectInputField($model, 'status'); ?>
        <div class="buttons">
            <div class="cancel">
                <button type="button" onclick="history.back(-1)" class="btn btn-outline-warning">Cancel</button>
            </div>
            <div>
                <a onClick="javascript: return confirm('Please confirm user deletion');"
                   href="/user/delete?id=<?= $this->clean($model->id) ?>"
                   class="btn btn-outline-danger">Delete user</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
        <?php Form::end() ?>

    </div>
</div>