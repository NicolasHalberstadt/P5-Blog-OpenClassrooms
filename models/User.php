<?php
/* User: nicolashalberstadt 
* Date: 17/12/2020 
* Time: 15:15
*/

namespace app\models;

use nicolashalberstadt\phpmvc\UserModel;

/**
 * Class RegisterModel
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\models
 */
class User extends UserModel
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_DELETED = 2;

    const USER_MEMBER = 1;
    const USER_EDITOR = 2;
    const USER_ADMIN = 3;

    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public int $status = self::STATUS_INACTIVE;
    public int $type = self::USER_MEMBER;
    public string $password = '';
    public string $confirmPassword = '';

    public static function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save(): bool
    {
        $this->type = self::USER_MEMBER;
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function update()
    {
        return parent::update();
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class
                ]],
            'password' => [self::RULE_REQUIRED,
                [self::RULE_MIN, 'min' => 8]],
            'confirmPassword' => [self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'email', 'password', 'status', 'type'];
    }

    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm password',
            'status' => 'Status',
            'type' => 'Type'
        ];
    }

    public function getDisplayName(): string
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public static function findRecent(int $limit): array
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT * FROM $tableName WHERE users.status != 2 ORDER BY created_at DESC LIMIT $limit");
        $statement->execute();
        return $statement->fetchAll();
    }

}