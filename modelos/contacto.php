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
		
		
		public function enviar()
		{
			
		}
		
	}
	
	
	
	