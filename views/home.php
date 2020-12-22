<?php
/** @var $this View */
/** @var $model ContactForm */

use app\models\ContactForm;
use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;
use nicolashalberstadt\phpmvc\View;

$this->title = 'Home'
?>
<h1>Home</h1>


<h1>Contact</h1>

<?php $form = Form::begin('', 'post') ?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body') ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php $form = Form::end(); ?>