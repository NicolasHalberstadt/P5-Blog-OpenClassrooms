<?php
/* User: nicolashalberstadt 
* Date: 02/01/2021 
* Time: 10:58
*/

namespace app\models;

use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\db\DbModel;

/**
 * Class Comment
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\models
 */
class Comment extends DbModel
{
    public string $content = '';
    public int $validated = 0;

    public static function tableName(): string
    {
        return 'comments';
    }

    public function attributes(): array
    {
        return ['content', 'validated'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'content' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'content' => 'Add your comment',
        ];
    }

    public function save($options = [])
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $userId = Application::$app->user->id;
        $postId = $options['post_id'];
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ", user_id, post_id)
                VALUES(" . implode(',', $params) . ", 
                (SELECT id FROM users WHERE users.id = $userId), 
                (SELECT id FROM posts WHERE posts.id = $postId))");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function findAll($orderBy = 'created_at', $postId = null): array
    {
        $tableName = self::tableName();

        try {
            $statement = self::prepare("SELECT * FROM $tableName WHERE `post_id` = $postId ORDER BY $orderBy DESC");
            $statement->execute();
            return $statement->fetchAll();
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function authorize()
    {

    }
}