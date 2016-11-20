<?php
set_time_limit(500);
require_once 'persistencias/contactoPersistencia.php';
include 'nucleo/PHPMailer/PHPMailerAutoload.php';
	
	class contacto
	{
		private $_asunto;
		private $_mensaje;
		private $_archivo;
		private $_correo;
		private $_idCurso;
		private $_idEdicion;

		public function __construct($asunto, $mensaje, $correo, $archivo, $idCurso, $idEdicion)
		{
			$this->_asunto = $asunto;
			$this->_mensaje = $mensaje;
			$this->_archivo = $archivo;
			$this->_correo = $correo;
			$this->_idCurso = $idCurso;
			$this->_idEdicion = $idEdicion;
		}
		
		//
		//++
		//+++++
		//		METODOS GETTERS
		//+++++
		//++
		//
		
		public function dameMensaje(){
			return $this->_mensaje;
		}
	
		public function dameAsunto(){
			return $this->_asunto;
		}
		
		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		
		public function solicitarAcceso(){
			//postmaster@localhost
		  	//postmaster@localhost
		  	$mail = new PHPMailer();
			
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ugueto.luis19@gmail.com';                 // SMTP username
			$mail->Password = 'LuisUgueto...';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'saravis.upta@gmail.com';
			$mail->FromName = 'APP SARAVIS';

			//$email = "blink242@outlook.com";
			//$email1 = "codefuentes@outlook.com";
			$email2 = "saravis.upta@gmail.com";


			//$mail->addAddress($email);         // Add attachments
			//$mail->addAddress($email1);
			$mail->addAddress('ugueto.luis19@gmail.com');         // Add attachments
			//$mail->addAddress($this->_correo);
			    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = ''.$this->_asunto;
			$mail->Body    = '<h1 style="color:red;">Un usuario quiere tener acceso a la aplicacion con el correo: '.$this->_correo.' <br>Y ha dejado este mensaje: '.$this->_mensaje.'</h1>';

		    if(!$mail->send())
		    {
		    	echo 0;
				/*echo "<script>
						alert('Enviando mensaje...');
						window.location='?';
					</script>";*/
		    }
		    else
		    {
		    	echo 1;
		    	/*
		    	echo "<script>
						alert('Enviando mensaje...');
						window.location='?';
					</script>"; */
		    }

		}


		public function enviarCertificado()
		{
			
			$mail = new PHPMailer();
			
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->CharSet = "UTF-8"; 
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ugueto.luis19@gmail.com';                 // SMTP username
			$mail->Password = 'LuisUgueto...';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'saravis.upta@gmail.com';
			$mail->FromName = 'APP SARAVIS';

			//$email = "blink242@outlook.com";
			//$email1 = "codefuentes@outlook.com";

			//$mail->addAddress($email);         // Add attachments
			//$mail->addAddress($email1);
                           // Set email format to HTML
			$mail->IsHTML(true);
			$mail->Subject = ''.$this->_asunto;
			$mail->Body    = ''.$this->_mensaje;
			$mail->addAddress($this->_correo);
        	$mail->AddAttachment('recursos/Certificado.pdf', 'Certificado.pdf');
			    // Optional name
	

	     	$id_usuario = $_SESSION['session']['id'];
		  
		    $id = $this->_idEdicion;
			if(!$mail->send()) {
				echo "<script>
						alert('Certificado no Enviado.');
						window.location='?ctrl=documento&acc=envCert';
					</script>";
			} else {
				echo "<script>
						alert('Certificado Enviado.');
						window.location='?ctrl=documento&acc=envCert';
					</script>";
			}
		}

		public function enviarCorreo()
		{
			//postmaster@localhost
		  	$mail = new PHPMailer();
			
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'ugueto.luis19@gmail.com';                 // SMTP username
			$mail->Password = 'LuisUgueto...';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'saravis.upta@gmail.com';
			$mail->FromName = 'APP SARAVIS';

			//$email = "blink242@outlook.com";
			//$email1 = "codefuentes@outlook.com";
			$email2 = "saravis.upta@gmail.com";


			$mail->addAddress('ugueto.luis19@gmail.com');         // Add attachments
			//$mail->addAddress($email1);
			//$mail->addAddress($this->_correo);
			    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = ''.$this->_asunto;
			$mail->Body    = '<h1 style="color:red;">Un usuario quiere comunicarse con usted con el correo: '.$this->_correo.' <br>Y ha dejado este mensaje: '.$this->_mensaje.'</h1>';

	     	// $id_usuario = $_SESSION['session']['id'];
		    // $mensaje = new contactoPersistencia();
		    // $mensaje = $mensaje->registrarMensaje($id_usuario, $this->_asunto, $this->_mensaje);
		    if(!$mail->send())
		    {
		    	echo 0;
				/*echo "<script>
						alert('Enviando mensaje...');
						window.location='?';
					</script>";*/
		    }
		    else
		    {
		    	echo 1;
		    	/*
		    	echo "<script>
						alert('Enviando mensaje...');
						window.location='?';
					</script>"; */
		    }
			
		}	
	}	