<?php


namespace Core;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer extends PHPMailer
{
    static private $host = 'smtp.gmail.com';
    static private $user = 'uioptoday@gmail.com';
    static private $password = 'gerkauiop123';

    public function sendSecurityCodeEmail($email, $name, $link)
    {

        $mail_subject = "Активация аккаунта";
//        $html_body = "";
        $mail_body = " Привет, вот твоя ссылка для активации аккаунта " . $link;
        $email_sent = self::sendEmail($email, $name, $mail_subject, $mail_body);

        return $email_sent;
    }

    public static function sendEmail($to_email, $to_name, $subject, $mailContent)
    {

        $mail = new PHPMailer(true);
        $mail->CharSet = "UTF-8";
        try {
            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host = self::$host;                     //Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   //Enable SMTP authentication
            $mail->Username = self::$user;                     //SMTP username
            $mail->Password = self::$password;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('uioptoday@gmail.com', 'Александр Марков');
            $mail->addAddress('antarctida.inc@gmail.com', 'Joe User');     //Add a recipient

            //Attachments
//            $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//            $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $mailContent;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return 'Message has been sent';
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }


    }
}