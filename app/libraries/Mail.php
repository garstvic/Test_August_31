<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require APPROOT.'/helpers/phpmailer/src/Exception.php';
require APPROOT.'/helpers/phpmailer/src/PHPMailer.php';
require APPROOT.'/helpers/phpmailer/src/SMTP.php';

class Mail
{
    public static $smtp='';
    
    public static function sendConfirmMessage($recipient,$token,$name)
    {
        $subject='SkySilk - Activate your account';

        $message='
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>SkySilk - Activate your account</title>
            </head>
            <body>
                <h1>Activate Your Account</h1>
                <p>We just need to validate your email address to activate your SkySilk account. Simply click the following link:</p>
                <p><a href="'.URLROOT.'/index.php?url=user/confirm/'.$token.'">'.URLROOT.'/index.php?url=user/confirm/'.$token.'</a></p>
            </body>
            </html>';

        self::send($recipient,$name,$subject,$message);
    }
    
    private static function send($to,$name,$subject,$message)
    {
        $mail=new PHPMailer(true);
        
        try{
            $mail->CharSet = 'UTF-8';
    
            $mail->Host=MAILHOST;
            $mail->SMTPDebug=0;
            $mail->SMTPAuth=true;
            $mail->Port=25;
            $mail->Username=MAILUSERNAME;
            $mail->Password=MAILPASSWORD;
    
            $mail->isHTML(true);
    
            $mail->From='donotreply@skysilk.com';
            $mail->FromName='SkySilk';
            $mail->addAddress($to,$name);
    
            $mail->Subject=$subject;
            $mail->Body=$message;
    
            $mail->send();
        }catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}