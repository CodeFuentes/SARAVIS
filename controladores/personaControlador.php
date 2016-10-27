<?php

require_once 'modelos/persona.php';

	class personaControlador
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
			if(!empty($_GET['documento']))
			{
				list($tipo, $documento) = explode('-', $_GET['documento']);
				
				vistaGestor::agregarDiccionario('post_documentoPers', $documento);
				vistaGestor::agregarDiccionario('selected_tipo_' . $tipo, 'selected="selected"');
				
			}
		
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::agregarDiccionario('link_form_persona', '?ctrl=persona&acc=guarRegi');
			vistaGestor::documentoNormal('Registrar una Persona', array('vistas/persona/formPersona.html'));
		}
		
		private function _guardarRegistro()
		{		
			$errores .= validarCampo::validarDato($_POST['documentoPers'], 'documentoPers', 'NUMERICO', 'no', '4-8');
			$errores .= validarCampo::validarSelect($_POST['tipoDocumentoPers'], 'tipoDocumentoPers', 'no');
			$errores .= validarCampo::validarDato($_POST['nombrePers'], 'nombrePers', 'NOMBRE', 'no', '3-30', 'palabras');
			$errores .= validarCampo::validarDato($_POST['apellidoPers'], 'apellidoPers', 'NOMBRE', 'no', '3-30', 'palabras');
			$errores .= validarCampo::validarSelect($_POST['sexoPers'], 'sexoPers', 'no');
			$errores .= validarCampo::validarFecha($_POST['fechaNacimientoPers'], 'fechaNacimientoPers', 'no');
			$errores .= validarCampo::validarDato($_POST['telefonoPers'], 'telefonoPers', 'NUMERICO', 'no', '11');
			$errores .= validarCampo::validarDato($_POST['direccionPers'], 'direccionPers', 'NINGUNO', 'no', '3-200');
			
			if ($_POST['correoPers'] != $_POST['confCorreoPers']) $errores .= "ERROR";

			vistaGestor::agregarDiccionario('selected_sexo_' . $_POST['sexoPers'], 'selected="selected"');
			vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoDocumentoPers'], 'selected="selected"');
			
			if(empty($errores))
			{
				$persona = new persona(
										NULL, 
										$_POST['tipoDocumentoPers'] . '-' . $_POST['documentoPers'], 
										$_POST['nombrePers'], 
										$_POST['apellidoPers'], 
										$_POST['sexoPers'], 
										invertirFecha($_POST['fechaNacimientoPers']),
										$_POST['telefonoPers'], 
										$_POST['direccionPers'],
										$_POST['correoPers']
									);

				$resultado = $persona->registrar();
				if($resultado == 'exito')
				{
					vistaGestor::agregarNotificacion('exito', 'Se ha registrado con &eacute;xito a la persona');
					self::_formularioBusqueda();
				}
				elseif($resultado == 'existeDocumento')
				{
					vistaGestor::agregarErrorForm('documentoPers', 'El documento ya existe');
					self::_formularioRegistro();
				}
			}
			else
			{
				self::_formularioRegistro();
			}
		}
		
		//
		//++++
		//		BUSQUEDA PERSONA
		//++++
		//
		
		private function _formularioBusqueda()
		{			
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::documentoNormal('Buscar Persona', array('vistas/persona/formBusqueda.html'));
		}
		
		private function _realizarBusqueda()
		{
			$errores .= validarCampo::validarDato($_POST['documentoPers'], 'busqueda', 'NUMERICO', 'no', '4-8');
			$errores .= validarCampo::validarSelect($_POST['tipoDocumentoPers'], 'busqueda', 'no');
			
			vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoDocumentoPers'], 'selected="selected"');

			if(empty($errores))
			{
				$persona = persona::buscar($_POST['tipoDocumentoPers'] . '-' . $_POST['documentoPers']);
				
				if(empty($persona)){
					list($tipo, $documento) = explode('-', $_GET['documento']);
					vistaGestor::agregarDiccionario('post_documentoPers', $documento);
					vistaGestor::agregarDiccionario('selected_tipo_' . $tipo, 'selected="selected"');
					vistaGestor::agregarArchivoCss('formularios');
					vistaGestor::agregarDiccionario('link_form_persona', '?ctrl=persona&acc=guarRegi');
					vistaGestor::documentoNormal('Registrar una Persona', array('vistas/persona/formPersona.html'));
					}
				

				if(!empty($persona))
				{
					vistaGestor::agregarDiccionario('link_modificar', '?ctrl=persona&acc=formModi&id=' . $persona->dameId());
					
					vistaGestor::agregarDiccionario('datoNombre', $persona->dameNombre());
					vistaGestor::agregarDiccionario('datoApellido', $persona->dameApellido());
					vistaGestor::agregarDiccionario('datoDocumento', $persona->dameDocumento());
					vistaGestor::agregarDiccionario('datoTelefono', $persona->dameTelefono());
					vistaGestor::agregarDiccionario('datoCorreo', $persona->dameCorreo());
					
					vistaGestor::agregarArchivoCss('formularios');
					vistaGestor::documentoNormal('Buscar Persona', array('vistas/persona/formBusqueda.html', 'vistas/persona/opcionesPersona.html'));
				}

				// else
				// {
				// 	vistaGestor::agregarDiccionario('link_registrar', '?ctrl=persona&acc=formRegi&documento=' . $_POST['tipoDocumentoPers'] . '-' . $_POST['documentoPers']);
					
				// 	vistaGestor::agregarArchivoCss('formularios');
				// 	vistaGestor::documentoNormal('Buscar Persona', array('vistas/persona/formBusqueda.html', 'vistas/persona/preguntaRegistrar.html'));
				// }
			}
			else
			{
				self::_formularioBusqueda();
			}
		}
		
		//
		//++++
		//		NODIFICAR PERSONA
		//++++
		//
		
		private function _formularioModificar()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idPersona'] = $_GET['id'];
			}
			
			vistaGestor::agregarDiccionario('link_form_persona', '?ctrl=persona&acc=guarModi');
			
			$persona = persona::cargarPersona($_SESSION['formulario']['idPersona']);
			
			if(!empty($persona))
			{		
				vistaGestor::agregarDiccionario('datoNombre', $persona->dameNombre());
				vistaGestor::agregarDiccionario('datoApellido', $persona->dameApellido());
				vistaGestor::agregarDiccionario('datoDocumento', $persona->dameDocumento());
								
				if(empty($_POST))
				{
					vistaGestor::agregarDiccionario('post_nombrePers', $persona->dameNombre());
					vistaGestor::agregarDiccionario('post_apellidoPers', $persona->dameApellido());
					
					list($tipoDocumento, $documento) = explode('-', $persona->dameDocumento());
					
					vistaGestor::agregarDiccionario('selected_tipo_' . $tipoDocumento, 'selected="selected"');
					vistaGestor::agregarDiccionario('post_documentoPers', $documento);
					
					vistaGestor::agregarDiccionario('post_telefonoPers', $persona->dameTelefono());					
					vistaGestor::agregarDiccionario('selected_sexo_' . $persona->dameSexo(), 'selected="selected"');
					
					vistaGestor::agregarDiccionario('post_fechaNacimientoPers', invertirFecha($persona->dameFechaNacimiento()));
					vistaGestor::agregarDiccionario('post_direccionPers', $persona->dameDireccion());
					vistaGestor::agregarDiccionario('post_correoPers', $persona->dameCorreo());
					vistaGestor::agregarDiccionario('post_confCorreoPers', $persona->dameCorreo());
				}
				
				vistaGestor::agregarArchivoCss('formularios');

				vistaGestor::documentoNormal('Modificar una Persona', array('vistas/persona/seleccionPersona.html', 'vistas/persona/formPersona.html'));
			}
			else
			{
				unset($_SESSION['formulario']['idPersona']);
				self::_formularioBusqueda();
			}
		}

		private function _guardarModificar()
		{
			if(!empty($_SESSION['formulario']['idPersona']))
			{
				$errores .= validarCampo::validarDato($_POST['documentoPers'], 'documentoPers', 'NUMERICO', 'no', '4-8');
				$errores .= validarCampo::validarSelect($_POST['tipoDocumentoPers'], 'tipoDocumentoPers', 'no');
				$errores .= validarCampo::validarDato($_POST['nombrePers'], 'nombrePers', 'NOMBRE', 'no', '3-30', 'palabras');
				$errores .= validarCampo::validarDato($_POST['apellidoPers'], 'apellidoPers', 'NOMBRE', 'no', '3-30', 'palabras');
				$errores .= validarCampo::validarSelect($_POST['sexoPers'], 'sexoPers', 'no');
				$errores .= validarCampo::validarFecha($_POST['fechaNacimientoPers'], 'fechaNacimientoPers', 'no');
				$errores .= validarCampo::validarDato($_POST['telefonoPers'], 'telefonoPers', 'NUMERICO', 'no', '11');
				$errores .= validarCampo::validarDato($_POST['direccionPers'], 'direccionPers', 'NINGUNO', 'no', '3-200');
				
				if ($_POST['correoPers'] != $_POST['confCorreoPers']) $errores .= "ERROR";

				vistaGestor::agregarDiccionario('selected_sexo_' . $_POST['sexoPers'], 'selected="selected"');
				vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoDocumentoPers'], 'selected="selected"');
				
				if(empty($errores))
				{								
					$persona = new persona(
											$_SESSION['formulario']['idPersona'], 
											$_POST['tipoDocumentoPers'] . '-' . $_POST['documentoPers'], 
											$_POST['nombrePers'], 
											$_POST['apellidoPers'], 
											$_POST['sexoPers'], 
											invertirFecha($_POST['fechaNacimientoPers']),
											$_POST['telefonoPers'], 
											$_POST['direccionPers'],
											$_POST['correoPers']
										);

					$resultado = $persona->modificar();

					if($resultado == 'exito')
					{
						vistaGestor::agregarNotificacion('exito', 'Se han modificado los datos de la persona con &eacute;xito');
						self::_formularioBusqueda();
					}
					elseif($resultado == 'existeDocumento')
					{
						vistaGestor::agregarErrorForm('documentoPers', 'El documento ya existe');
						self::_formularioModificar();
					}
				}
				else
				{
					self::_formularioModificar();
				}
			}
			else
			{
				self::_formularioBusqueda();
			}
		}
	}
	
	
	
	