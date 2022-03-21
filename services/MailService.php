<?php

namespace app\services;

use app\core\Mailer;
use Exception;

class MailService {
    public function sentMailToSubscribers($subscribers, $content)
    {
        try {
            $mailer = new Mailer($_ENV['EMAIL_USERNAME'], $_ENV['EMAIL_PASSWORD'], 'Ali Bingül');
            $mailer->addRecipients($subscribers);
            $mailer->setContent($content);
            $mailer->sendMail();
            return true;
        } catch (Exception $e) {
            return $e->ErrorInfo;
        }
    }

    public function sentMailToMember($member, $subject, $body)
    {
        try {
            $mailer = new Mailer($_ENV['EMAIL_USERNAME'], $_ENV['EMAIL_PASSWORD'], 'Ali Bingül');
            $mailer->addRecipient($member);
            $mailer->setSpecificContent($subject, $body);
            $mailer->sendMail();
            return true;
        } catch (Exception $e) {
            return $e->ErrorInfo;
        }
    }
    
    public function sentMailToAdmin($name, $email, $website, $message){
        try{
            $mailer = new Mailer($_ENV['EMAIL_USERNAME'], $_ENV['EMAIL_PASSWORD'], 'Ali Bingül');
            $mailer->addRecipientString("alibingul40@gmail.com");
            $mailer->setSpecificContent($name, $message . ' Website : <a href="' . $website . '">Website</a> | Email : ' . $email);
            $mailer->setReplyTo($email, $name);
            $mailer->sendMail();
            return true;
        } catch(Exception $e){
            return $e->ErrorInfo;
        }
    }
}