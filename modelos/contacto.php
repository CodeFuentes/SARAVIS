<?php

require_once 'persistencias/contactoPersistencia.php';

	class contacto
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
		
		
		public function registrar()
		{
			 $mail = $this->_mensaje;
			 $titulo = "Contacto";
			 $headers = "MIME-Version: 1.0\r\n"; 
			 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
			 $headers .= "From: blink242@outlook.com"." >\r\n";
		
			 $bool = mail("blink242@outlook.com",$titulo,$mail,$headers);
			 if($bool){
			     echo "Mensaje enviado";
			     echo "<script>
			     	location.href='./';
			     </script>";
			 }else{
			     echo "Mensaje no enviado";
			     echo "<script>
			     	location.href='./';
			     </script>";
			 }
		}
		
	}
	
	
	
	