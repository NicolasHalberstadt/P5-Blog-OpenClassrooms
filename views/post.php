<?php
/* User: nicolashalberstadt 
* Date: 30/12/2020 
* Time: 16:50
*/

/**@var $post \app\models\Post */

use app\core\App;
use app\models\User;
?>

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