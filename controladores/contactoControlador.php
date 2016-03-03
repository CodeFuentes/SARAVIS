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
			if(!empty($_GET['documento']))
			{
				list($tipo, $documento) = explode('-', $_GET['documento']);
				
				vistaGestor::agregarDiccionario('post_documentoContact', $documento);
				vistaGestor::agregarDiccionario('selected_tipo_' . $tipo, 'selected="selected"');
				
			}
		
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::agregarDiccionario('link_form_contacto', '?ctrl=contacto&acc=guarRegi');
			vistaGestor::documentoNormal('Contacto', array('vistas/contacto/formContacto.html'));
		}
		
		private function _guardarRegistro()
		{		
			echo "<script> 
				alert('Mensaje Enviado');
			</script>";
			header("Location: ./");
		}
		
		
	}
	
	
	
	