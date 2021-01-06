<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 11:54
*/
/**@var $users User */
/**@var $posts \app\models\Post */

/**@var $isAdmin bool */

use app\models\User;
use nicolashalberstadt\phpmvc\Application;

$this->title = 'Admin panel';
?>
<?php if ($isAdmin) : ?>
<!-- User table -->
<div class="table-container">
    <h4 class="text-center">List of users</h4>
    <table class="table admin-table">

        <thead>
        <tr class="table-success">
            <th scope="col">Id</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Type</th>
            <th scope="col">Status</th>
            <th scope="col">Options</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <?php if ($user['status'] != 2): ?>
                <?php
                switch ($user['type']) {
                    case 1:
                        $userType = 'Member';
                        break;
                    case 2:
                        $userType = 'Editor';
                        break;
                    case 3:
                        $userType = 'Admin';
                        break;
                }
                switch ($user['status']) {
                    case 0:
                        $userStatus = 'Inactive';
                        break;
                    case 1:
                        $userStatus = 'Active';
                        break;
                }
                ?>

                <tr>
                    <th scope="row"><?= $user['id'] ?></th>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $userType ?></td>
                    <td><?= $userStatus ?></td>
                    <td><a href="/user/edit?id=<?= $user['id'] ?>">Edit</a></td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <hr>
</div>

<!-- Posts table -->
<div class="table-container">

    <h4 class="text-center">List of posts</h4>
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
                <td><?php $t = strtotime($post['created_at']);
                    echo date('d-m-Y', $t); ?></td>
                <td><?php $t = strtotime($post['updated_at']);
                    echo date('d-m-Y', $t); ?></td>
                <td><?= User::findOne(['id' => $post['user_id']])->getDisplayName() ?></td>

                <td><a class="option-edit" href="/post/edit?id=<?= $post['id'] ?>">Edit</a>
                    <br>
                    <a class="option-delete" onClick="javascript: return confirm('Please confirm deletion');"
                       href="/post/delete?id=<?= $post['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>