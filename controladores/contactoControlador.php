<?php

require_once 'modelos/contacto.php';
require_once 'modelos/usuario.php';
	class contactoControlador
	{
		static public function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'formRegi': 
					self::_formularioRegistro();
				break;
				
				case 'guarRegi': 

					self::_guardarRegistro();
				break;

				case 'regError':
					self::_regError();
				break;
				
				case 'verInf':
					self::_verInf();
					break;		

				default:

					self::_regresarPrincipal();

				break;
			}
		}
		

		private function _regresarPrincipal()
		{
			header('location: ?ctrl=contacto');
		}
		//
		//++++
		//		REGISTRO PERSONA
		//++++
		//

		private function _formularioRegistro()
		{			
			
		
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::agregarDiccionario('link_form_contacto', '?ctrl=contacto&acc=guarRegi');
			vistaGestor::documentoNormal('Contacto', array('vistas/ayuda/formContacto.html'));
		}
		
		private function _guardarRegistro()
		{	
			$asunto = $_POST['asunto'];
			$mensaje = $_POST['mensaje'];
			$correo = $_POST['correo'];
			$clave = $_POST['clave'];
			echo $asunto;
			break;
			$contacto = new contacto($asunto, $mensaje, $correo);
			$resultado = $contacto->solicitarAcceso();
		}

		public function _regError()
		{
			header('Location: ?');
  }

		public function _verInf()
		{
			vistaGestor::documentoNormal('Informacion', array('vistas/ayuda/informacion.html'));
		}
	}
	
	
	
	
