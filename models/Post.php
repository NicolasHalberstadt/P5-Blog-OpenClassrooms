<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:20
*/

namespace app\models;

use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\db\DbModel;
use PDOException;

/**
 * Class Post
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\models
 */
class Post extends DbModel
{
    public string $title = '';
    public string $chapo = '';
    public string $content = '';

    public static function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array
    {
        return ['title', 'chapo', 'content', 'user_id'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'title' => [self::RULE_REQUIRED],
            'chapo' => [self::RULE_REQUIRED],
            'content' => [self::RULE_REQUIRED],
            'user_id' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'title' => 'Post title',
            'chapo' => 'Chapo',
            'content' => 'Post content',
            'user_id' => 'Author',
        ];
    }

    public function save(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $userId = Application::$app->user->id;
        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes)
            . ",user_id)
             VALUES(" . implode(',', $params)
            . ", (SELECT id FROM users WHERE users.id = $userId))");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }
}