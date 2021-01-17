<?php
/* User: nicolashalberstadt
* Date: 20/12/2020
* Time: 19:01
*/

namespace app\models;

use nicolashalberstadt\phpmvc\Model;
use nicolashalberstadt\phpmvc\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

/**
 * Class ContactForm
 *
 * @author Nicolas Halberstadt <halberstadtnicolas@gmail.com>
 * @package app\models
 */
class ContactForm extends Model
{
    public string $firstname = '';
    public string $lastname = '';
    public string $subject = '';
    public string $email = '';
    public string $body = '';
    
    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'subject' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }
    
    public function labels(): array
    {
        return [
            'firstname' => 'Your firstname',
            'lastname' => 'Your lastname',
            'subject' => 'Enter your subject',
            'email' => 'Your email',
            'body' => 'Enter your message',
        ];
    }
    
    public function send(Request $request): bool
    {
        // ContactForm data :
        $body = $request->getBody();
        $contactFormFirstname = $body['firstname'];
        $contactFormLastname = $body['lastname'];
        $contactFormAddress = $body['email'];
        $contactFormBody = $body['body'];
        $contactFormSubject = $body['subject'];
        
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = 'halberstadtnicolas@gmail.com';
        $mail->Password = 'mqfhmazuqfjygsip';
        
        $mail->addReplyTo($contactFormAddress, 'Contact form');
        $mail->setFrom($contactFormAddress, 'Contact form');
        $mail->addAddress('halberstadtnicolas@gmail.com', 'Nicolas Halberstadt');
        
        $mail->isHTML(true);
        $mail->Subject = $contactFormSubject;
        
        $mailBody = "Nouveau message de la part de
$contactFormFirstname $contactFormLastname - $contactFormAddress.
<br>Message : $contactFormBody";
        $mail->Body = $mailBody;
        $mail->AltBody = $contactFormBody;
        
        if (!$mail->send()) {
            echo htmlspecialchars('Mailer Error: ' . $mail->ErrorInfo);
        }
        return true;
    }
}
