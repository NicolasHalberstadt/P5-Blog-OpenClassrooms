<?php
/* User: nicolashalberstadt 
* Date: 17/12/2020 
* Time: 17:25
*/

class m0006_add_updatedat_column_posts {
    public function up()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $db->pdo->exec("ALTER TABLE posts ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP AFTER created_at");
    }

    public function down()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $db->pdo->exec("ALTER TABLE posts DROP COLUMN updated_at");
    }
}