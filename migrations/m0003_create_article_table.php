<?php

/* User: nicolashalberstadt
* Date: 21/12/2020 
* Time: 16:04
*/

use nicolashalberstadt\phpmvc\Application;

class m0003_create_article_table
{
    public function up()
    {
        $db = Application::$app->db;
        $sql = "CREATE TABLE posts (
            id INT AUTO_INCREMENT PRIMARY KEY ,
            title VARCHAR(255) NOT NULL ,
            chapo VARCHAR(255) NOT NULL,
            content TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP       
        ) ENGINE=INNODB;";
        $db->pdo->exec($sql);
    }

    public function down()
    {
        $db = Application::$app->db;
        $sql = "DROP TABLE posts";
        $db->pdo->exec($sql);
    }
}