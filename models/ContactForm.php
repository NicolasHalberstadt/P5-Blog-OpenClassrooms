<?php
/* User: nicolashalberstadt 
* Date: 20/12/2020 
* Time: 19:01
*/

namespace app\models;

use app\core\Model;

/**
 * Class ContactForm
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\models
 */
class ContactForm extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'email' => 'Your email',
            'body' => 'Enter your message',
        ];
    }

    public function send()
    {
        return true;
    }
}