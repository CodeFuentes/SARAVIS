<?php

require_once 'persistencias/contactoPersistencia.php';
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
			 $mail = $this->_mensaje;
			 $titulo = "Contacto";
			 $headers = "MIME-Version: 1.0\r\n"; 
			 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			 $headers .= "From: blink242@outlook.com"." >\r\n";
			
		     $id_usuario = $_SESSION['session']['id'];
		     $mensaje = new contactoPersistencia();
		     $mensaje = $mensaje->registrarMensaje($id_usuario, $this->_mensaje, $this->_asunto);

			 $bool = mail("blink242@outlook.com",$titulo,$mail,$headers);
			 if($bool){
			     echo "<script>alert('Mensaje Enviado')</script>";
			     echo "<script>
			     	location.href='./';
			     </script>";
			 }else{
			     echo "<script>alert('Mensaje no Enviado')</script>";
			     echo "<script>
			     	location.href='./';
			     </script>";
			 }
		}
		
	}
	
	
	
	