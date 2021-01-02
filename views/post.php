<?php
/* User: nicolashalberstadt 
* Date: 30/12/2020 
* Time: 16:50
*/

/**@var $post       \app\models\Post */
/**@var $comments   \app\models\Comment */

/**@var $model      \app\models\Comment */

use app\core\App;
use app\models\User;
use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;

?>
<div class="post">
    <h1><?= $post->title ?></h1>
    <h3><?= $post->chapo ?></h3>
    <p><?= $post->content ?></p>
    <p class="small-text">Written the <?= $post->created_at ?></p>
    <p class="small-text">Written by <?= User::findOne(['id' => $post->user_id])->getDisplayName() ?></p>
    <?php if (App::isEditor()) : ?>
        <div class="">
            <a href="/post/edit?id=<?= $post->id ?>">Edit Post</a>
        </div>
    <?php endif; ?>
</div>
<div>
    <h3>Comments section</h3>
    <p>Note : every submitted comment will be display after validation from an administrator</p>
    <?php if (!App::isGuest()): ?>
        <!--Comment section -->
        <!-- Comment form -->
        <?php Form::begin('', 'post'); ?>
        <?php echo new TextareaField($model, 'content') ?>
        <button type="submit" class="btn btn-primary">Submit</button>
        <?php Form::end(); ?>
        <!-- Comment form -->
        <!-- Comments display -->
        <div class="comments">
            <?php foreach ($comments as $comment) :
                if ($comment['validated'] == 1): ?>
                    <div class="comment">
                        <p class="" style="color:green"><?= $comment['content'] ?> </p>
                        <?php if (App::$app->user) :
                            if (App::$app->user->id === $comment['user_id']) : ?>
                                <a href="/comment/edit?id=<?= $comment['id'] ?>">Edit my comment</a>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                <?php elseif ($comment['validated'] != 1 && App::isEditor()): ?>
                    <div class="comment">
                        <p class="" style="color:red;"><?= $comment['content'] ?> </p>
                        <a href="/comment/validate?id=<?= $comment['id'] ?>">Validate comment</a>
                    </div>
                <?php endif;
            endforeach; ?>
        </div>
        <!-- Comments display -->
    <?php else : ?>
        <p>Note : You have to be sign in to be able to post a comment</p>
    <?php endif; ?>
</div>