<?php
/* User: nicolashalberstadt
* Date: 22/12/2020
* Time: 11:54
*/
/**@var $users \app\models\User */

?>
<h1>Welcome to the admin panel</h1>


<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Type</th>
    </tr>
    </thead>
    <tbody>
    <?php $index = 0;
    foreach ($users as $user) : ?>
        <?php $index++; ?>
        <tr>
            <th scope="row"><?= $index ?></th>
            <td><?= $user['firstname'] ?></td>
            <td><?= $user['lastname'] ?></td>
            <td><?= $user['user_type'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>