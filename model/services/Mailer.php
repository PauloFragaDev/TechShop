<?php

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mailer extends PHPMailer
{

    function mailServerSetup()
    {
        try {
            //Server settings
//            $this->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->isSMTP();                                            //Send using SMTP
            $this->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $this->SMTPAuth = true;                                   //Enable SMTP authentication
            $this->Username = 'paulofragadawprueba@gmail.com';                     //SMTP username
            $this->Password = 'rvniicjscujdtcfp';                               //SMTP password
            $this->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->ErrorInfo}";
        }
    }

    function addRec($to, $cc, $bcc)
    {
        foreach ($to as $addr) {
            $this->addAddress($addr);
        }

        foreach ($cc as $c) {
            $this->addCC($c);
        }

        foreach ($bcc as $bc) {
            $this->addBCC($bc);
        }
    }

    function addAtt($att)
    {
        foreach ($att as $at) {
            $this->addAttachment($at);
        }
    }

    function addVerifyContent($user)
    {
        $this->isHTML(true);                                  //Set email format to HTML
        $this->Subject = 'Validar compte';
        $cos = '<h3>Hola ' . $user->getFullname() . '</h3>';
        $cos .= '<p>Para poder comprar en la tienda tienes que verificar la cuenta, dale click al boton!!!</p>';
        $cos .= '<a style="background-color: blueviolet; color: white; padding: 4px; text-decoration: none;" href="http://localhost/controllers/user/verificarCorreoController.php?id=' . $user->getIdUser() . '&token=' . $user->getToken() . '">Validar</a>';
        $this->Body = $cos;
        $this->AltBody = 'This is the body in plain text for non-HTML mail clients';
    }


}