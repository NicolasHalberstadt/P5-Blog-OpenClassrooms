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

$form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'title') ?>
<?php echo $form->field($model, 'chapo') ?>
<?php echo new TextareaField($model, 'content') ?>
<button type="submit" class="btn btn-primary">Save</button>

<?php \nicolashalberstadt\phpmvc\form\Form::end() ?>
