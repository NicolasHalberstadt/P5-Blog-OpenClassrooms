<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:20
*/

namespace app\models;

use nicolashalberstadt\phpmvc\Application;
use nicolashalberstadt\phpmvc\db\DbModel;

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
        return ['title', 'chapo', 'content', 'updated_at'];
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
        ];
    }

    public function labels(): array
    {
        return [
            'title' => 'Post title',
            'chapo' => 'Chapo',
            'content' => 'Post content',
        ];
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $userId = Application::$app->user->id;

        $statement = self::prepare("INSERT INTO $tableName (" . implode(',', $attributes) . ",user_id)
                VALUES(" . implode(',', $params) . ", (SELECT id FROM users WHERE users.id = $userId))");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }
}