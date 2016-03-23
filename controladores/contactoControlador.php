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
					
					index::permitirAcceso('personas');
					self::_formularioRegistro();
					
				break;
				
				case 'guarRegi': 
				
					index::permitirAcceso('personas');
					self::_guardarRegistro();
					
				break;

				case 'formBusq': 
				
					self::_formularioBusqueda();
					
				break;
				
				case 'buscPers': 
				
					self::_realizarBusqueda();
					
				break;
				
				case 'formModi': 
					
					index::permitirAcceso('personas');
					self::_formularioModificar();
					
				break;
				
				case 'guarModi': 
				
					index::permitirAcceso('personas');
					self::_guardarModificar();
					
				break;

				case 'verInf':
					self::_verInf();
					break;
				

				default:

					self::_formularioBusqueda();

				break;
			}
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
			
			$a = $_POST['mensaje'];
			$b = $_POST['asunto'];

			$contacto = new contacto($_POST['asunto'], $_POST['mensaje']);

			$resultado = $contacto->registrar();

		}

		public function _verInf()
		{
			vistaGestor::documentoNormal('Informacion', array('vistas/ayuda/informacion.html'));
		}
	}
	
	
	
	