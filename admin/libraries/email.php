<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
function send_mail($sent_to_email,$sent_to_fullname,$subject,$content,$option=array()){
    global $config;
    $config_email=$config['email'];
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $config_email['smtp_host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $config_email['smtp_user'];                     //SMTP username
        $mail->Password   = $config_email['smtp_pass'];                               //SMTP password
        $mail->SMTPSecure = $config_email['smtp_recure'];            //Enable implicit TLS encryption
        $mail->Port       = $config_email['smtp_port'];         
        $mail->CharSet = "UTF-8";                           //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('img/acer.png', 'sản phẩm');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = file_get_contents("layout/mail.php");
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        
    } 
    catch (Exception $e) {
        echo "Email không được gửi. Chi tiết lỗi: {$mail->ErrorInfo}";
    }

}

?>