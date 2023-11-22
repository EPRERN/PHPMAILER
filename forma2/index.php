<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  //Server settings
  $mail->SMTPDebug = 0;            
  $mail->isSMTP();                                 
  $mail->Host       = 'mail.eprern.gov.ar';                     
  $mail->SMTPAuth   = true;       
  $mail->SMTPAutoTLS = false;
                            
  $mail->Username   = 'administrador@eprern.gov.ar';                     
  $mail->Password   = 'c1G482ur@37';
  $mail->SMTPSecure = '';  // Sin SSL ni TLS                
  $mail->Port       = 587;                                    

  $mail->setFrom('administrador@eprern.gov.ar', 'admin');
  $mail->addAddress('lavila@eprern.gov.ar');     
  $mail->addAddress('dsilvera@eprern.gov.ar');        
  $mail->addAddress('pbejarano@eprern.gov.ar');          
   
   
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

   
    // $mail->addAttachment('/var/tmp/file.tar.gz');
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); 




    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Hola Mundo desde PHP';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}