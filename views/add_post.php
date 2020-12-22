<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:37
*/

/**@var $model \app\models\Post */

use nicolashalberstadt\phpmvc\form\TextareaField;

?>
    <h1>Add a post</h1>
<?php $form = nicolashalberstadt\phpmvc\form\Form::begin('', 'post') ?>

<?php echo $form->field($model, 'title') ?>
<?php echo $form->field($model, 'chapo') ?>
<?php echo new TextareaField($model, 'content') ?>

    <button type="submit" class="btn btn-primary">Submit</button>

<?php \nicolashalberstadt\phpmvc\form\Form::end() ?>