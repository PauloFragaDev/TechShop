<?php
require_once 'Mailer.php';

class MailService
{

    public static function sendVerifyEmail($user)
    {
        $mail = new Mailer(true);
        $mail->mailServerSetup();
        $mail->addRec([$user->getEmail()], [], []);
        $mail->addVerifyContent($user);
        $mail->send();
        $mail->smtpClose();
    }
}