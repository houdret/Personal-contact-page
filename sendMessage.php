<?php
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require './PHPMailer/src/Exception.php';
    require './PHPMailer/src/PHPMailer.php';
    require './PHPMailer/src/SMTP.php';

    

    function sendMail($s, $m, $adr, $name)
    {
                    
        $mail = new PHPMailer(true);
        
        try {



            
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->SMTPDebug = 2;                                       //test
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.sendgrid.net';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true; 
            $mail->Username   = 'apikey';                     //SMTP username
            $mail->Password   = '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';                               //SMTP password
            $mail->SMTPSecure = 25;            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('jeanhoudret@gmail.com', 'Mailer');
            $mail->addAddress($adr, $name);     //Add a recipient
            

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Validation';
            $mail->Body    = 'Vous êtes le bien venu sur mon site</b>';
            

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        };                     
                    
    }
?>