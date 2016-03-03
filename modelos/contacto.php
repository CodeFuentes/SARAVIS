<?php

require_once 'persistencias/contactoPersistencia.php';

	class Contacto
	{
		private $_correo;
		private $_mensaje;
	
	
		public function __construct($correo, $mensaje)
		{
			$this->_correo = $correo;
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
	
		public function dameCorreo(){
			return $this->_correo;
		}
		
		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		
		public function enviar()
		{
			// $mail = dameMensaje();
			// $correo = dameCorreo();
			// $titulo = "Contacto";
			// $headers = "MIME-Version: 1.0\r\n"; 
			// $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			// $headers .= "From: ".$correo." >\r\n";
		
			// $bool = mail("blink242@outlook.com",$titulo,$mail,$headers);
			// if($bool){
			//     echo "Mensaje enviado";
			// }else{
			//     echo "Mensaje no enviado";
			// }
			echo dameMensaje();

			echo "<script> 
				alert('Mensaje Enviado');
				location.href='./';
			</script>";		
		}
		
	}
	
	
	
	