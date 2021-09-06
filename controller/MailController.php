<?php

namespace app\controller;

use app\core\Controller;
use app\core\Mailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{

    public function sentMailToSubscribers($subscribers, $content)
    {
        try {
            $mailer = new Mailer('philosophy684@gmail.com', 'VKe%@D?;B"56*?4e', 'Ali Bingul | Philosophy');
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
            $mailer = new Mailer('philosophy684@gmail.com', 'VKe%@D?;B"56*?4e', 'Ali Bingul | Philosophy');
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
            $mailer = new Mailer('philosophy684@gmail.com', 'VKe%@D?;B"56*?4e', 'Ali Bingul | Philosophy');
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
