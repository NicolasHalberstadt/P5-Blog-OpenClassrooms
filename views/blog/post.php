<?php
/* User: nicolashalberstadt 
* Date: 30/12/2020 
* Time: 16:50
*/

/**@var $post       \app\models\Post */
/**@var $comments   \app\models\Comment */

/**@var $model      \app\models\Comment */
$this->title = $post->title;

use app\core\App;
use app\models\User;
use nicolashalberstadt\phpmvc\form\Form;
use nicolashalberstadt\phpmvc\form\TextareaField;

?>
<div class="post-container">
    <div class="post">
        <h3 class="post-title text-center"><?= $post->title ?></h3>
        <h4 class="post-chapo text-center"><?= $post->chapo ?></h4>
        <p class="post-content"><?= $post->content ?></p>
        <p class="small-text">Written the
            <?php $t = strtotime($post->created_at);?>
            <?= date('F jS Y', $t); ?>
            by
            <?= User::findOne(['id' => $post->user_id])->getDisplayName() ?>
        </p>

        <?php if (App::isEditor()) : ?>
            <a class="btn btn-info" href="/post/edit?id=<?= $post->id ?>">Edit Post</a>
        <?php endif; ?>
    </div>
    <!--Comment section -->
    <!-- Comment form -->
    <div class="comments-form-container">
        <div class="form-container">
            <h3 class="text-center">Comments section</h3>
            <?php if (App::isGuest()): ?>
                <p class="text-center">Note : You have to be <a href="/login">logged in</a> to be able to post a comment
                </p>
            <?php else : ?>
                <p class="text-center">Note : every submitted comment will be display after validation from an
                    administrator</p>
                <div class="form">
                    <?php Form::begin('', 'post'); ?>
                    <?=  new TextareaField($model, 'content') ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <?php Form::end(); ?>
                </div>
            <?php endif; ?>
            <hr>
        </div>
        <!-- Comment form -->
        <!-- Comments display -->
        <div class="comments-container">
            <?php foreach ($comments as $comment) :
                if ($comment['validated'] == 1):
                    $commentsList[] = $comment;
                    ?>
                    <div class="comment">
                        <p><?= $comment['content'] ?></p>
                        <p>
                            <small class="text-muted">By
                                <?= User::findOne(['id' => $comment['user_id']])->getDisplayName(); ?>
                            </small>
                        </p>
                        <?php if (App::$app->user) : ?>
                            <div class="item-options-btn edit-delete">
                                <?php if (App::$app->user->id === $comment['user_id']) : ?>
                                    <a class="comment-edit option-edit btn btn-primary"
                                       href="/comment/edit?id=<?= $comment['id'] ?>">Edit my comment
                                    </a>
                                <?php endif; ?>
                                <?php if (App::$app->user->id === $comment['user_id'] || App::isEditor()) : ?>
                                    <a class="option-delete btn btn-danger"
                                       onClick="javascript: return confirm('Please confirm deletion');"
                                       href="/comment/delete?id=<?= $comment['id'] ?>">Delete
                                    </a>
                                <?php endif ?>
                            </div>
                        <?php endif ?>
                    </div>
                <?php elseif ($comment['validated'] != 1 && App::isEditor()): ?>
                    <div class="comment">
                        <p class="" style="color:red;"><?= $comment['content'] ?> </p>
                        <p><small class="text-muted">By
                                <?= User::findOne(['id' => $comment['user_id']])->getDisplayName(); ?>
                            </small></p>
                        <div class="item-options-btn">
                            <a class="comment-validate option-validate btn btn-primary"
                               href="/comment/validate?id=<?= $comment['id'] ?>">Validate
                            </a>
                            <a class="option-delete btn btn-danger"
                               onClick="javascript: return confirm('Please confirm deletion');"
                               href="/comment/delete?id=<?= $comment['id'] ?>">Delete
                            </a>
                        </div>
                    </div>
                <?php endif;
            endforeach; ?>
            <?php if (empty($commentsList)) : ?>
                <p>No comments on this post yet, write the first one !</p>
            <?php endif; ?>
        </div>
    </div>
</div>