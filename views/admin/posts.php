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
        <tr class=" table-success">
            <th scope="col">Id</th>
            <th scope="col">Title</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Author</th>
            <th scope="col">Options</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($posts as $post) : ?>
            <tr>
                <th scope="row"><?= $post['id'] ?></th>
                <td><?= $post['title'] ?></td>
                <td><?php $t = strtotime($post['created_at']); ?>
                    <?= date('d-m-Y', $t); ?></td>
                <td><?php
                    if ($post['updated_at'] !== null) :
                        $t = strtotime($post['updated_at']); ?>
                        <?= date('d-m-Y', $t); ?>
                    <?php else : ?>
                        <?= 'Undefined'; ?>
                    <?php endif; ?>
                </td>
                <td><?= User::findOne(['id' => $post['user_id']])->getDisplayName() ?></td>

                <td>
                    <div class="item-options-btn">
                        <a class="option-edit btn btn-primary"
                           href="/post/edit?id=<?= $post['id'] ?>">Edit
                        </a>
                        <a class="option-delete btn btn-danger"
                           onClick="javascript: return confirm('Please confirm deletion');"
                           href="/post/delete?id=<?= $post['id'] ?>">Delete
                        </a>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>