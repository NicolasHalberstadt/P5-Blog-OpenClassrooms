<?php
/* User: nicolashalberstadt
* Date: 07/01/2021
* Time: 19:47
*/

/**@var $posts \app\models\Post */

use app\models\User;

$this->title = 'Admin panel - Posts';
?>
<!-- Posts table -->
<div class="table-container table-responsive">
    <table class="table admin-table">
        <thead>
        <tr class="table-success">
            <?php if (empty($posts)) : ?>
                <th scope="col">No posts have yet been written</th>
            <?php else : ?>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Author</th>
                <th scope="col">Options</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>
        
        <?php foreach ($posts as $post) : ?>
            <tr>
                <th scope="row"><?= $this->clean($post['id']) ?></th>
                <td><?= $this->clean($post['title']) ?></td>
                <td><?php $t = strtotime($post['created_at']); ?>
                    <?= $this->clean(date('d-m-Y', $t)); ?></td>
                <td>
                    <?php if ($post['updated_at'] !== null) :
                        $t = strtotime($post['updated_at']); ?>
                        <?= $this->clean(date('d-m-Y', $t)); ?>
                    <?php else : ?>
                        <?= 'Undefined' ?>
                    <?php endif; ?>
                </td>
                <td><?= $this->clean(User::findOne(['id' => $post['user_id']])->getDisplayName()) ?></td>

                <td>
                    <div class="item-options-btn">
                        <a class="option-edit btn btn-primary"
                           href="/post/edit?id=<?= $this->clean($post['id']) ?>">Edit
                        </a>
                        <a class="option-delete btn btn-danger"
                           onClick="javascript: return confirm('Please confirm deletion');"
                           href="/post/delete?id=<?= $this->clean($post['id']) ?>">Delete
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>