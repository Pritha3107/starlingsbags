<?php

require_once "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class User
{
    private $email;
    private $db;
    private $reset_token_expiry;


    public function __construct($db)
    {
        // $this->email = $email;
        //$this->password = $password;
        $this->db = $db;
        $this->reset_token_expiry = 1800;
    }

    public function forgotPassword($mail)
    {
        $result = $this->db->query("SELECT * FROM `authentication` WHERE `email_id` = '$mail'");
        //print_r($result);
        //die();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['id'];
            list($reset_token, $expiry_time) = $this->generateToken();
            // echo $reset_token;
            // echo $expiry_time;
            // die();
            if ($row['reset_token'] != NULL) {
                $this->delExitToken($user_id);
            }

            $this->db->query("UPDATE authentication SET reset_token = '$reset_token',expiry_time = '$expiry_time'  WHERE id = $user_id");

            $this->sendResetLink($reset_token, $mail);
            //$this->sendgridMail();
            return true;
        } else {
            return false;
        }
    }

    private function generateToken()
    {
        $reset_token =  md5(uniqid(rand(), true));
        $expiry_time = date("Y-m-d H:i:s");
        return array($reset_token, $expiry_time);
    }
    public function delExitToken($id)
    {
        if ($id) {
            $sql = "UPDATE authentication SET reset_token = NULL WHERE id = '$id'";
            $this->db->query($sql);
            return true;
        } else {
            echo "error";
            return false;
        }
    }
    private function sendResetLink($reset_token, $mail)
    {
        $mailer = new PHPMailer(true);
        $mailtmpt = file_get_contents('updatepasswordtmpt.phtml');
        $mailtmpt = str_replace('%mail%', $mail, $mailtmpt);
        $mailtmpt = str_replace('%token%', $reset_token, $mailtmpt);
        try {
            //Server settings
            $mailer->SMTPDebug = 0;                      //Enable verbose debug output
            $mailer->isMail();                                            //Send using SMTP
            $mailer->Host       = 'localhost';                    //Set the SMTP server to send through
            $mailer->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mailer->Username   = 'info@starlingbagsni.co.uk';                     //SMTP username
            $mailer->Password   = 'info@starlingbagsni.co.uk';
            // $mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                 //SMTP password
            $mailer->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mailer->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mailer->setFrom('info@starlingbagsni.co.uk', 'admin');
            $mailer->addAddress($mail);     //Add a recipient
            //$mailer->addReplyTo('your_email@gmail.com', 'admin');

            //Attachments (optional)
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachmentshttp://localhost/DJ-BAGS/forgotpassword.php
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mailer->isHTML(true);                                  //Set email format to HTML
            $mailer->Subject = 'Password Reset Link from Starling bags';
            $mailer->Body = $mailtmpt;
            //$mailer->Body    = "we got a request form you to reset Password! <br>Click the link bellow: <br><a href='http://localhost/DJ-BAGS/updatePassword.php?email=$this->email&reset_token=$reset_token'>reset password</a>";
            $mailer->AltBody = 'Plain text message of the email';
            
              //This should be the same as the domain of your From address
              $mailer->DKIM_domain = 'starlingbagsni.co.uk';
              //See the DKIM_gen_keys.phps script for making a key pair -
              //here we assume you've already done that.
              //Path to your private key:
              $mailer->DKIM_private = 'dkim_private.pem';
              //Set this to your own selector
              $mailer->DKIM_selector = 'default';
              //Put your private key's passphrase in here if it has one
              $mailer->DKIM_passphrase = '';
              //The identity you're signing as - usually your From address
              $mailer->DKIM_identity = $mailer->From;
              //Suppress listing signed header fields in signature, defaults to true for debugging purpose
              $mailer->DKIM_copyHeaderFields = false;

            
            $mailer->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mailer->ErrorInfo}";
        }
    }
}