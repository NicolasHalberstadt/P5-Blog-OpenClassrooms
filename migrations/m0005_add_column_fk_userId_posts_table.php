<?php
/* User: nicolashalberstadt 
* Date: 30/12/2020 
* Time: 12:05
*/

class m0005_add_column_fk_userId_posts_table
{
    public function up()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $db->pdo->exec("ALTER TABLE posts 
                                ADD COLUMN user_id INT, 
                                ADD CONSTRAINT fk_post_user_id FOREIGN KEY (user_id) 
                                REFERENCES users(id)");
    }

    public function down()
    {
        $db = \nicolashalberstadt\phpmvc\Application::$app->db;
        $db->pdo->exec("ALTER TABLE posts DROP COLUMN user_id");
    }
}