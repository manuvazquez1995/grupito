<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

/* si utilizaramos composer

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


// Load Composer's autoloader
require 'vendor/autoload.php';
*/

function enviarMail($mailUser,$asunto,$mensaje){

		// Instantiation and passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
				//Server settings
				$mail->SMTPDebug = 0; //SMTP::DEBUG_SERVER;                       // Enable verbose debug output
				$mail->isSMTP();    

				/*$mail->SMTPOptions = array(
					'ssl'=>array(
						'verify_peer' => true,
						'verify_depth' => 3,
						'cafile' => '/etc/openssl/certs/ca.crt'
					)
				);*/


				// Send using SMTP
				$mail->Host       = 'smtp.gmail.com';                    					// Set the SMTP server to send through
				$mail->SMTPAuth   = true;                                   			// Enable SMTP authentication
				$mail->Username   = 'manuvazquez1995@gmail.com';                     		// SMTP username
				$mail->Password   = 'hozjaynewqyixoih';                               			// SMTP password
				$mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_STARTTLS;      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
				$mail->Port       = 587;                                    			// TCP port to connect to

				//Recipients
				$mail->setFrom($mailUser, 'Formulario contacto');
				$mail->addAddress('manuvazquez1995@gmail.com', 'Manuel Vázquez');     // Add a recipient
				//$mail->addAddress('pedromartinezleis@gmail.com');               				// Name is optional
				$mail->addReplyTo($mailUser, 'Cliente');
				//$mail->addCC('cc@example.com');
				//$mail->addBCC('bcc@example.com');

				/*
				// Attachments
				$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
				*/

				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = $asunto;
				$mail->Body    = $mensaje;
				//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				$mail->send();
				$correcto=TRUE;
				
		} catch (Exception $e) {
				$correcto=FALSE;
				echo "El mensaje no se pudo enviar. Mailer Error: {$mail->ErrorInfo}";
		}
	return $correcto;
}
?>