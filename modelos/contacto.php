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


			 $correo->IsSMTP();
			//Esto es para activar el modo depuración. En entorno de pruebas lo mejor es 2, en producción siempre 0
			// 0 = off (producción)
			// 1 = client messages
			// 2 = client and server messages
			$correo->SMTPDebug  = 0;
			//Ahora definimos gmail como servidor que aloja nuestro SMTP
			$correo->Host       = 'smtp.gmail.com';
			//El puerto será el 587 ya que usamos encriptación TLS
			$correo->Port       = 587;
			//Definmos la seguridad como TLS
			$correo->SMTPSecure = 'tls';
			//Tenemos que usar gmail autenticados, así que esto a TRUE
			$correo->SMTPAuth   = true;
			//Definimos la cuenta que vamos a usar. Dirección completa de la misma
			$correo->Username   = "prueba";
			//Introducimos nuestra contraseña de gmail
			$correo->Password   = "";
			//Definimos el remitente (dirección y, opcionalmente, nombre)
			$correo->SetFrom('ugueto.luis18@gmail.com', 'Mi nombre');
			//Esta línea es por si queréis enviar copia a alguien (dirección y, opcionalmente, nombre)
			//$correo->AddReplyTo('ugueto.luis18@gmail.com','El de la réplica');
			//Y, ahora sí, definimos el destinatario (dirección y, opcionalmente, nombre)
			$correo->AddAddress('ugueto.luis18@gmail.com', 'El Destinatario');
			//Definimos el tema del email
			$correo->Subject = 'Esto es un correo de prueba';

			 
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