<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 11:54
*/
/**@var $users \app\models\User */
/**@var $isAdmin bool */
?>
    <h1>Welcome to the admin panel</h1>
<?php if ($isAdmin) : ?>
    <table class="table table-bordered">Registered users
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
                case 2:
                    $userStatus = 'Deleted';
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
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>