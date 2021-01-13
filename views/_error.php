<?php
/* User: nicolashalberstadt
* Date: 14/12/2020
* Time: 10:48
*/
/**@var $exception Exception */
$this->title = 'Error ' . $exception->getCode();
?>
<?php
$code = $exception->getCode();
$string = "" . $exception->getCode() . "";
$error = str_split($string, 1);
?>
<div class="mainbox">
    <div class="error-code">
        <div class="err"><?= $this->clean($error[0]); ?></div>
        <i class="far fa-question-circle fa-spin"></i>
        <div class="err2"><?= $this->clean($error[2]) ?></div>
    </div>
    <div class="error-code-mobile err">
        <p><?= $exception->getCode() ?></p>
    </div>
    <?php if ($code === 404) : ?>
        <div class="msg">
            Maybe this page moved? Got deleted? Is hiding out in quarantine? Never existed in the first
            place?
            <p>Let's go <a href="/">home</a> and try from there.</p>
        </div>
    <?php elseif ($code === 403) : ?>
        <div class="msg">Unfortunately you don't have the right to access this page...
            <p>Let's go <a href="/">home</a> and try from there.</p>
        </div>
    <?php else : ?>
        <div class="msg"><?= $exception->getMessage(); ?>
            <p>Let's go <a href="/">home</a> and try from there.</p>
        </div>
    <?php endif; ?>

</div>

