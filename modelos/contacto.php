<?php

require_once 'persistencias/contactoPersistencia.php';
require_once 'nucleo/PHPMailer/class.phpmailer.php';
	
	class contacto
	{
		private $_asunto;
		private $_mensaje;
	
	
		public function __construct($asunto, $mensaje)
		{
			$this->_asunto = $asunto;
			$this->_mensaje = $mensaje;
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
		
		
		public function registrar()
		{
			//postmaster@localhost
			 $mail = $this->_mensaje;

			 $correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()
 
			//Usamos el SetFrom para decirle al script quien envia el correo
			$correo->SetFrom("ugueto.luis18@gmail.com", "Prueba");
			 
			//Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
			$correo->AddReplyTo("ugueto.luis19@gmail.com","Prueba");
			 
			//Usamos el AddAddress para agregar un destinatario
			$correo->AddAddress("ugueto.luis19@gmail.com", "Prueba");
			 
			//Ponemos el asunto del mensaje
			$correo->Subject = "Prueba";
			 
			/*
			 * Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
			 * $correo->MsgHTML("<strong>Mi Mensaje en HTML</strong>");
			 * Si deseamos enviarlo en texto plano, haremos lo siguiente:
			 * $correo->IsHTML(false);
			 * $correo->Body = "Mi mensaje en Texto Plano";
			 */
			$correo->IsHTML(false);
			$correo->Body = "Prueba";
			 
			//Enviamos el correo
			if(!$correo->Send()) {
			  $msg = "Hubo un error: " . $correo->ErrorInfo;
   			  echo "<script>alert($msg)</script>";
		      echo "<script>
			     	location.href='./';
			     </script>";
			} else {
			   echo "<script>alert('Mensaje Enviado')</script>";
			     echo "<script>
			     	location.href='./';
			     </script>";
			}

			 $id_usuario = $_SESSION['session']['id'];
		     $mensaje = new contactoPersistencia();
		     $mensaje = $mensaje->registrarMensaje($id_usuario, $this->_asunto, $this->_mensaje);
		}
		
	}	