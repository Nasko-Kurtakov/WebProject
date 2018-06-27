<?php
/**
 * Created by PhpStorm.
 * User: Atanas Kurtakov
 * Date: 27.6.2018 г.
 * Time: 15:04
 */

namespace libs;

require_once 'phpMailer/src/Exception.php';
require_once 'phpMailer/src/PHPMailer.php';
require_once 'phpMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class MailSender
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);                // Passing `true` enables exceptions
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPDebug = 2;                                 // Enable verbose debug output
        $this->mail->isSMTP();                                      // Set mailer to use SMTP
        $this->mail->SMTPAuth = true;                               // Enable SMTP authentication
        $this->mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $this->mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $this->mail->Port = '465';
        $this->mail->Username = 'testify.fmi@gmail.com';                 // SMTP username
        $this->mail->Password = 'testify123';                           // SMTP password
        $this->mail->SetFrom('testify.fmi@gmail.com');

    }

    public function sendEmailForNewAssignedTest(string $name,string $email){
        $this->mail->addAddress($email, $name);       // Add a recipient
        $this->mail->Subject = "[Testify@fmi] Нов тест за оценка";
        $this->mail->Body    = "Здравейте, ".$name." имате назначен тест, който трябва да оцените.\n Моля влезте в системата Testify, за да го направите.\n Поздрави,\n Tesify";
        $this->mail->send();
    }
}