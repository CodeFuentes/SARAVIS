<?php

require_once 'modelos/contacto.php';

	class contactoControlador
	{
		static public function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'formRegi': 
					
					index::permitirAcceso('personas');
					self::_formularioRegistro();
					
				break;
				
				case 'guarRegi': 
				
					index::permitirAcceso('personas');
					self::_guardarRegistro();
					
				break;				

				default:

					self::_formularioBusqueda();

				break;
			}
		}
		
		//
		//++++
		//		REGISTRO CONTACTO
		//++++
		//
		
		private function _formularioRegistro()
		{			
		
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::agregarDiccionario('link_form_contacto', '?ctrl=contacto&acc=guarRegi');
			vistaGestor::documentoNormal('Contacto', array('vistas/contacto/formContacto.html'));
		}
		
		private function _guardarRegistro()
		{	
			$contacto = new contacto($_POST['correo'], $_POST['mensaje']);
			$enviar = $contacto->enviar();
		}
		
		
	}
	
	
	
	