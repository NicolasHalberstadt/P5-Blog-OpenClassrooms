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

?>
<h1>Hello <?= Application::$app->user->firstname ?>, welcome to the admin panel</h1>
<?php if ($isAdmin) : ?>
    <!-- User table -->
    <table class="table table-bordered admin-table">Registered users
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Firstname</th>
            <th scope="col">Lastname</th>
            <th scope="col">Type</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php $index = 0;
        foreach ($users as $user) : ?>
            <?php if ($user['status'] != 2): ?>
                <?php $index++;
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
                    <th scope="row"><?= $index ?></th>
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
<!-- Posts table -->
<table class="table table-bordered admin-table">Blog Posts
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Chapo</th>
        <th scope="col">Content</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
        <th scope="col">Author</th>
    </tr>
    </thead>
    <tbody>
    <?php $index = 0;
    foreach ($posts as $post) : ?>
        <?php $index++;
        ?>
        <tr>
            <th scope="row"><?= $index ?></th>
            <td><?= $post['title'] ?></td>
            <td><?= $post['chapo'] ?></td>
            <td><?= $post['content'] ?></td>
            <td><?php $t = strtotime($post['created_at']);
                echo date('d-m-Y', $t); ?></td>
            <td><?php $t = strtotime($post['updated_at']);
                echo date('d-m-Y', $t); ?></td>
            <td><?= User::findOne(['id' => $post['user_id']])->getDisplayName() ?></td>

            <td><a href="/post/edit?id=<?= $post['id'] ?>">Edit</a>
                <br>
                <a onClick="javascript: return confirm('Please confirm deletion');"
                   href="/post/delete?id=<?= $post['id'] ?>">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
