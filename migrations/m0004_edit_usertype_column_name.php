<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 15:29
*/

class m0004_edit_usertype_column_name
{
    public function up()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $sql = "ALTER TABLE users CHANGE user_type type TINYINT DEFAULT 1 NOT NULL";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $sql = "ALTER TABLE users CHANGE type user_type TINYINT DEFAULT 1 NOT NULL";
        $db->pdo->exec($sql);
    }
}