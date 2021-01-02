<?php

/* User: nicolashalberstadt
* Date: 02/01/2021 
* Time: 10:59
*/

use nicolashalberstadt\phpmvc\Application;

class m0007_create_comment_table
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE comments (
            id INT AUTO_INCREMENT PRIMARY KEY ,
            content TEXT NOT NULL,
            validated BOOL NOT NULL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,      
            updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            user_id INT,
            post_id INT,
            FOREIGN KEY (user_id) REFERENCES users(id),
            FOREIGN KEY (post_id) REFERENCES posts(id)
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE comments";
        $db->pdo->exec($sql);
    }
}