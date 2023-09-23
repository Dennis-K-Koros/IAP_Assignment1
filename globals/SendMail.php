<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

class SendMail{
    public function SendeMail($details=array(), $conf){
        if(!empty($details["email_receiver"]) & !empty($details["name_receiver"]) & !empty($details["email_subject_line"]) & !empty($details["email_message"])){
            
            $mail = new PHPMailer(true); // Passing `true` enables exceptions
            try {
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'richmanswealth@gmail.com';                     // SMTP username
                $mail->Password   = 'tsxe cwtf vnyl xnls';                               // SMTP password
                $mail->SMTPSecure = 'ssl';         
                $mail->Port       = 465;                                   
                // Recipients
                $mail->setFrom('admin@icse.rochella.org', 'Admin');
                $mail->addAddress($details["email_receiver"], $details["name_receiver"]);     // Add a recipient
                
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $details["email_subject_line"];
                $mail->Body    = $details["email_message"];
                $mail->send();
                echo 'Message has been sent';
                
            } catch(Exception $e) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
             
        }
    }
}    