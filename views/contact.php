<?php
/* User: nicolashalberstadt 
* Date: 14/12/2020 
* Time: 10:13
*/

/** @var $this \nicolashalberstadt\phpmvc\View */
/** @var $model \app\models\ContactForm */

use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;

$this->title = 'Contact'
?>
    <h1>Contact</h1>

<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body') ?>

    <button type="submit" class="btn btn-primary">Submit</button>
<?php $form = Form::end(); ?>