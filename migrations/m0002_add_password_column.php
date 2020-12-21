<?php
/* User: nicolashalberstadt 
* Date: 17/12/2020 
* Time: 17:25
*/

class m0002_add_password_column {
    public function up()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users ADD COLUMN password VARCHAR(512) NOT NULL ");
    }

    public function down()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $db->pdo->exec("ALTER TABLE users DROP COLUMN password");
    }
}