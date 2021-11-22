<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../vendor/autoload.php';  

    function sendMail($s, $m, $adr, $name)
    {
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            //$mail->SMTPDebug  = 2;                                       //test
            $mail->isSMTP();  
            $mail->CharSet    = 'UTF-8';                                          //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true; 
            $mail->Username   = 'jeanhoudret@gmail.com';                     //SMTP username
            $mail->Password   = 'jcogslpaldapqaql';                              //SMTP password
            $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('jeanhoudret@gmail.com');
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
