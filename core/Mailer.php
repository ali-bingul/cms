<?php

namespace app\core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public PHPMailer $mail;
    public function __construct($email, $password, $username)
    {
        global $mail;
        $mail = new PHPMailer(true); // passing true enables exceptions

        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        // $mail->Username   = 'philosophy684@gmail.com';                     //SMTP username
        $mail->Username   = $email;                     //SMTP username
        // $mail->Password   = 'VKe%@D?;B"56*?4e';                               //SMTP password
        $mail->Password   = $password;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = 'UTF-8';

        $mail->setFrom($email, $username);
        
    }
    
    public function addRecipients($subscribers = []) {
        global $mail;
        foreach($subscribers as $subscriber){
            $mail->addAddress($subscriber['email']);
        }
    }
    
    public function addRecipient($member){
        global $mail;
        $mail->addAddress($member->email);
    }
    
    public function addRecipientString($recipient){
        global $mail;
        $mail->addAddress($recipient);
    }
    
    public function setReplyTo($replyEmail, $replyName){
        global $mail;
        $mail->addReplyTo($replyEmail, $replyName);
    }

    public function setContent($content){
        global $mail;
        $mail->isHTML(true);
        $mail->Subject = 'Ali Bingul | Philosophy';
        // $mail->Body = '<h1>' . $content->title . '</h1><br><a href="/cms/"' . Application::slugify($content->title) . '></a>';
        $mail->Body = '<h4>New Content Avaliable Check It Out!</h4><br><a href="http://localhost/cms/' . Application::slugify($content->title) . '">' . $content->title .  ' </a><hr>';
        
    }

    public function setSpecificContent($subject, $body){
        global $mail;
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
    }

    public function sendMail(){
        global $mail;
        $mail->send();
    }
}
