<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 11:54
*/
/**@var $recentUsers User */
/**@var $recentPosts \app\models\Post */
/**@var $invalidComments \app\models\Comment */

/**@var $isAdmin bool */

use app\models\User;
use nicolashalberstadt\phpmvc\Application;

$this->title = 'Admin panel';
$latestPostsClass = '';
?>
<!-- Latest Users -->

<div class="latest-container">
    <?php if ($isAdmin) : ?>
        <div class="latest latest-users-container">
            <h4 class="latest-title">Latest users</h4>
            <div>
                <?php foreach ($recentUsers as $user) : ?>
                    <?php if ($user['status'] != 2): ?>
                        <?php
                        $userType = '';
                        $userStatus = '';
                        // User type display
                        if ($user['type'] == 3) {
                            $userType = 'Admin';
                        } elseif ($user['type'] == 2) {
                            $userType = 'Editor';
                        } elseif ($user['type'] == 1) {
                            $userType = 'Member';
                        }
                        // User status display
                        if ($user['status'] == 0) {
                            $userStatus = 'Inactive';
                        } elseif ($user['status'] == 1) {
                            $userStatus = 'Active';
                        }
                        ?>
                        <div class="latest-item">
                            <h5><?= User::findOne(['id' => $user['id']])->getDisplayName() ?></h5>
                            <p>Type : <?= $userType ?><br>
                                Status : <?= $userStatus ?>
                            </p>
                            <div class="item-info">
                                <div class="item-options-btn">
                                    <a class="option-edit btn btn-primary"
                                       href="/user/edit?id=<?= $user['id'] ?>">Edit</a>
                                    <br>
                                    <a class="option-delete btn btn-danger"
                                       onClick="javascript: return confirm('Please confirm deletion');"
                                       href="/user/delete?id=<?= $user['id'] ?>">Delete</a>
                                </div>
                                <div class="item-date">
                                    <p><?php $t = strtotime($user['created_at']);?>
                                        <?= date('jS M, Y', $t); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!$isAdmin) :
        $latestPostsClass = 'w-100';
    endif; ?>
    <div class="latest latest-posts-container <?= $latestPostsClass ?>">
        <h4 class="latest-title">Latest posts</h4>
        <div>
            <?php foreach ($recentPosts as $post) : ?>
                <div class="latest-item">
                    <h5><?= User::findOne(['id' => $post['user_id']])->getDisplayName() ?></h5>
                    <p><?= $post['title'] ?></p>
                    <div class="item-info">
                        <div class="item-options-btn">
                            <a class="option-edit btn btn-info"
                               href="/post?id=<?= $post['id'] ?>">Read
                            </a>
                            <a class="option-edit btn btn-primary"
                               href="/post/edit?id=<?= $post['id'] ?>">Edit
                            </a>
                            <br>
                            <a class="option-delete btn btn-danger"
                               onClick="javascript: return confirm('Please confirm deletion');"
                               href="/post/delete?id=<?= $post['id'] ?>">Delete
                            </a>
                        </div>
                        <div class="item-date">
                            <p><?php $t = strtotime($post['created_at']);?>
                                <?= date('jS M, Y', $t); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="invalid-comments">
    <h5 class="latest-title">Comments waiting for validation</h5>
    <?php if (empty($invalidComments)) : ?>
        <div class="invalid-comment">
            <p>Every comments have been validated</p>
        </div>
    <?php endif; ?>
    <?php foreach ($invalidComments as $comment) : ?>
        <div class="invalid-comment">
            <h5>From : <?= User::findOne(['id' => $comment['user_id']])->getDisplayName() ?></h5>
            <p>Content : "<?= $comment['content'] ?>"
                <br>
                <br>
                Posted on <?php $t = strtotime($comment['created_at']);?>
                <?= date('jS M, Y', $t); ?>
                on post number
                <a href="/post?id=<?= $comment['post_id'] ?>">
                    <?= $comment['post_id'] ?>
                </a>
            </p>
            <div class="item-info">
                <div class="item-options-btn">
                    <a class="option-edit btn btn-primary"
                       href="/comment/validate?id=<?= $comment['id'] ?>">Validate
                    </a>
                    <br>
                    <a class="option-delete btn btn-danger"
                       onClick="javascript: return confirm('Please confirm deletion');"
                       href="/comment/delete?id=<?= $comment['id'] ?>">Delete
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<!-- All Users table -->


