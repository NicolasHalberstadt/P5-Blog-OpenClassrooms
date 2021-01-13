<?php
/* User: nicolashalberstadt 
* Date: 02/01/2021
* Time: 19:34
*/

/**@var $posts \app\models\Post */

use app\core\App;

$this->title = 'Blog'
?>
<!-- Posts lists -->
<div class="team-boxed">
    <div class="container">
        <div class="row people">
            <?php foreach ($posts as $post) : ?>
                <div class="col-md-4 col-lg-6 item">
                    <div class="box">
                        <h3 class="name">
                            <a href="post?id=<?= $this->clean($post['id']) ?>">
                                <?= $this->clean($post['title']) ?>
                            </a>
                        </h3>
                        <p class="title"><?= $this->clean($post['chapo']) ?></p>
                        <p class="description">
                            <?php
                            if ($post['updated_at'] !== null) :
                                $t = strtotime($post['updated_at']); ?>
                                Last modified on
                            <?php else :
                                $t = strtotime($post['created_at']); ?>
                                Created on
                            <?php endif;?>
                            <?= $this->clean(date('F jS Y', $t)); ?>
                        </p>

                        <div class="social">
                            <a href="post?id=<?= $post['id'] ?>">
                                <i class="fab fa-readme"></i>
                            </a>
                            <?php if (App::isEditor()) : ?>
                                <a href="post/edit?id=<?= $this->clean($post['id']) ?>">
                                    <i class="far fa-edit"></i>
                                </a>
                                <a onClick="javascript: return confirm('Please confirm deletion');"
                                   href="post/delete?id=<?= $this->clean($post['id']) ?>">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Posts lists -->
