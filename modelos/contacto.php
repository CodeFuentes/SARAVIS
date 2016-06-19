<?php

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
		
		public function enviarCertificado()
		{
			//postmaster@localhost
		  	$mail = new PHPMailer();
			
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'saravis.upta@gmail.com';                 // SMTP username
			$mail->Password = 'SARAVIS2016@';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'saravis.upta@gmail.com';
			$mail->FromName = 'APP SARAVIS';

			//$email = "blink242@outlook.com";
			//$email1 = "codefuentes@outlook.com";
			$email2 = "saravis.upta@gmail.com";


			//$mail->addAddress($email);         // Add attachments
			//$mail->addAddress($email1);
			$mail->addAddress($this->_correo);
        	$mail->AddAttachment('recursos/'.$this->_archivo);
			    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = ''.$this->_asunto;
			$mail->Body    = '<b>'.$this->_mensaje;

	     	$id_usuario = $_SESSION['session']['id'];
		    $mensaje = new contactoPersistencia();
		    $mensaje = $mensaje->registrarMensaje($id_usuario, $this->_asunto, $this->_mensaje);
		    $id = $this->_idEdicion;
			if(!$mail->send()) {
				echo "<script>
						alert('Certificado no Enviado.');
						window.location='?ctrl=edicion&acc=menuEdic&id=$id';
					</script>";
			} else {
				echo "<script>
						alert('Certificado Enviado.');
						window.location='?ctrl=edicion&acc=menuEdic&id=$id';
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
			$mail->Username = 'saravis.upta@gmail.com';                 // SMTP username
			$mail->Password = 'SARAVIS2016@';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			$mail->From = 'saravis.upta@gmail.com';
			$mail->FromName = 'APP SARAVIS';

			//$email = "blink242@outlook.com";
			//$email1 = "codefuentes@outlook.com";
			$email2 = "saravis.upta@gmail.com";


			//$mail->addAddress($email);         // Add attachments
			//$mail->addAddress($email1);
			$mail->addAddress($this->_correo);
			    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = ''.$this->_asunto;
			$mail->Body    = '<b>'.$this->_mensaje;

	     	$id_usuario = $_SESSION['session']['id'];
		    $mensaje = new contactoPersistencia();
		    $mensaje = $mensaje->registrarMensaje($id_usuario, $this->_asunto, $this->_mensaje);

			if(!$mail->send()) {
				echo "<script>
						alert('Mensaje no Enviado.');
						window.location='?';
					</script>";
			} else {
				echo "<script>
						alert('Mensaje Enviado.');
						window.location='?';
					</script>";
			}
		}

		
	}	