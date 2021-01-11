<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 11:54
*/
/**@var $users User */
/**@var $recentPosts \app\models\Post */

/**@var $isAdmin bool */

use app\models\User;

$this->title = 'Admin panel - Users';
?>
<!-- All Users table -->
<div class="table-container table-responsive">
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
                <tr>
                    <th scope="row"><?= $user['id'] ?></th>
                    <td><?= $user['firstname'] ?></td>
                    <td><?= $user['lastname'] ?></td>
                    <td><?= $userType ?></td>
                    <td><?= $userStatus ?></td>
                    <td>
                        <div class="item-options-btn">
                            <a class="option-edit btn btn-primary"
                               href="/user/edit?id=<?= $user['id'] ?>">Edit
                            </a>
                            <a class="option-delete btn btn-danger"
                               onClick="javascript: return confirm('Please confirm deletion');"
                               href="/user/delete?id=<?= $user['id'] ?>">Delete
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>