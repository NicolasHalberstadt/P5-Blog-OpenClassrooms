<?php
/* User: nicolashalberstadt 
* Date: 22/12/2020 
* Time: 11:20
*/

namespace app\models;

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
    public string $user_id = '';
    public $updated_at;

    public static function tableName(): string
    {
        return 'posts';
    }

    public function attributes(): array
    {
        return ['title', 'chapo', 'content', 'user_id', 'updated_at'];
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
            'user_id' => 'Author',
        ];
    }

    public static function findRecent(int $limit): array
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName ORDER BY created_at DESC LIMIT $limit");
        $statement->execute();
        return $statement->fetchAll();
    }
}