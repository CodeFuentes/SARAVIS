<?php

require_once 'modelos/curso.php';
require_once 'modelos/edicion.php';

	class cursoControlador
	{
		static public function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'formRegiC': 
					index::permitirAcceso('cursos');
					self::_formularioRegistro();
				break;
				
				case 'guarRegiC': 	
					index::permitirAcceso('cursos');				
					self::_guardarRegistro();					
				break;

				case 'formBusqC': 				
					self::_formularioBusqueda();					
				break;
				
				case 'buscCurso': 				
					self::_realizarBusqueda();					
				break;

				case 'formModiC': 		
					index::permitirAcceso('cursos');
					self::_formularioModificar();					
				break;

				case 'guarModiC': 
					index::permitirAcceso('cursos');
					self::_guardarModificar();					
				break;

				case 'verEdic': 
					self::_verEdiciones();					
				break;

				case 'veriCodi': 
					self::_verificarCodigo();					
				break;

				case 'busqCodi': 
					self::_busquedaCodigo();					
				break;
				
				default:

					self::_formularioBusqueda();

				break;
			}
		}
		
		private function _verificarCodigo()
		{
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::documentoNormal('Verificar codigo de Participacion', array('vistas/curso/formVerificar.html'));
		}
		
		private function _busquedaCodigo()
		{
			$errores .= validarCampo::validarDato(&$_POST['buscarCodigo'], 'buscarCodigo', 'NINGUNO', 'no', '5-30');
			
			if(empty($errores))
			{
				$codigoCorrecto = 'NO';
				
				list($idCurso, $idEdicion, $idPersona) = explode('-', $_POST['buscarCodigo']);

				$curso = curso::cargarCurso($idCurso);
				
				if(!empty($curso))
				{
					$edicion = $curso->seleccionarEdicion($idEdicion);
				
					if(!empty($edicion))
					{
						if($edicion->dameEstado() == 'bloqueada')
						{
							$colParticipantes = $edicion->dameColParticipantes();
							
							$persona = $edicion->buscarParticipante($idPersona);
							
							if(!empty($persona))
							{
								$codigoCorrecto = 'CORRECTO';
							}
						}
					}
				}
			
				if($codigoCorrecto == 'CORRECTO')
				{								
					
					vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
					vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
					vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
					vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
					vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
								
					vistaGestor::agregarDiccionario('nombrePersona', $persona->dameNombre());
					vistaGestor::agregarDiccionario('apellidoPersona', $persona->dameApellido());
					vistaGestor::agregarDiccionario('documentoPersona', $persona->dameDocumento());

					vistaGestor::agregarArchivoCss('formularios');
					vistaGestor::agregarNotificacionPermanente('exito', 'El c&oacute;digo es correcto');
					
					vistaGestor::documentoNormal('Verificar c&oacute;digo de Participaci&oacute;n', 
							array('vistas/curso/datosCodigo.html', 'vistas/curso/formVerificar.html'));
					
				}
				else
				{
					vistaGestor::agregarNotificacion('alerta', 'El c&oacute;digo no existe o es incorrecto');
					self::_verificarCodigo();
				}
			}
			else
			{
				self::_verificarCodigo();
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
			vistaGestor::agregarDiccionario('link_form_curso', '?ctrl=curso&acc=guarRegiC');
			vistaGestor::documentoNormal('Registrar un Curso/Taller', array('vistas/curso/formCurso.html'));
		}
		
		private function _guardarRegistro()
		{
			$errores .= validarCampo::validarDato(&$_POST['nombreCurso'], 'nombreCurso', 'NINGUNO', 'no', '5-100');
			$errores .= validarCampo::validarDato(&$_POST['descripcionCurso'], 'descripcionCurso', 'NINGUNO', 'no', '5-200');
			
			if(empty($errores))
			{
				$curso = new curso(NULL, $_POST['nombreCurso'], $_POST['descripcionCurso']);
				
				$resultado = $curso->registrar();
				
				if($resultado == 'exito')
				{
					vistaGestor::agregarNotificacion('exito', 'Se ha registrado con éxito el Curso/Taller');
					self::_formularioBusqueda();
				}
				elseif($resultado == 'existeNombre')
				{
					vistaGestor::agregarErrorForm('nombreCurso', 'El nombre del Curso/Taller ya existe');
					self::_formularioRegistro();
				} 
			}
			else
			{
				self::_formularioRegistro();
			}
		}
		
		private function _formularioBusqueda()
		{
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::documentoNormal('Buscar Curso/Taller', array('vistas/curso/formBusqueda.html'));
		}
		
		private function _realizarBusqueda()
		{
			if(!empty($_POST['nombreCurso']))
			{
				$errores .= validarCampo::validarDato(&$_POST['nombreCurso'], 'busqueda', 'NINGUNO', 'no', '2-100');
				$_GET['dato'] = $_POST['nombreCurso'];
				
			}
			else
			{
				$errores .= validarCampo::validarDato(&$_GET['dato'], 'busqueda', 'NINGUNO', 'no', '2-100');
			}			
			
			if(empty($errores))
			{
				if(!empty($_POST))
				{
					$arrayCursos = curso::buscar($_GET['dato']);
				}
				else
				{
					$arrayCursos = curso::buscar(urldecode($_GET['dato']));
				}
				
				if(!empty($arrayCursos))
				{
					$titulos = array('Nombre', 'Descripción', 'Opciones');
					$linkBase = '?ctrl=curso&acc=buscCurso&dato=' . urlencode($_GET['dato']);
					
					$listadoGenerador = new listadoGenerador($arrayCursos, $titulos, $linkBase, $_GET['pag'], 5);
					
					foreach($arrayCursos as $curso)
					{	
						$nombre = $curso->dameNombre();
						$descripcion = $curso->dameDescripcion();
						
						if(strlen($descripcion) > 100)
						{
							$descripcion = substr($descripcion, 0, 100) . '...';
						}
						
						$listadoGenerador->agregarFila(
							array (
								$nombre,
								$descripcion,
									'{@cursos}' . listadoGenerador::crearOpcion(
										'Modificar Curso',
										'?ctrl=curso&acc=formModiC&id=' . $curso->dameId(),
										'modificar negro') . '{@cursos} ' .
										listadoGenerador::crearOpcion(
										'Ver Ediciones',
										'?ctrl=curso&acc=verEdic&id=' . $curso->dameId(),
										'ver negro') 
									)
							, '');
					}
					
					$htmlListado = $listadoGenerador->generarListado();
					
					vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
					vistaGestor::agregarArchivoCss('formularios');
					vistaGestor::agregarArchivoCss('listados');
					vistaGestor::documentoNormal('Buscar Curso/Taller', array('vistas/curso/formBusqueda.html', 'vistas/curso/listadoBusqueda.html'));
				}
				else
				{
					vistaGestor::agregarNotificacion('alerta', 'No hay resultados para la búsqueda');
					self::_formularioBusqueda();
				}
			}
			else
			{
				self::_formularioBusqueda();
			}
		}
		
		private function _formularioModificar()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idCurso'] = $_GET['id'];
			}
						
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			
			if(!empty($curso))
			{
				if(empty($_POST))
				{
					vistaGestor::agregarDiccionario('post_nombreCurso', $curso->dameNombre());
					vistaGestor::agregarDiccionario('post_descripcionCurso', $curso->dameDescripcion());
				}
				
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::agregarDiccionario('link_form_curso', '?ctrl=curso&acc=guarModiC');
				vistaGestor::documentoNormal('Modificar Curso/Taller', array('vistas/curso/formCurso.html'));
			}
			else
			{
				unset($_SESSION['formulario']['idCurso']);
				self::_formularioBusqueda();
			}
		}
		
		private function _guardarModificar()
		{
			if(!empty($_SESSION['formulario']['idCurso']))
			{
				$errores .= validarCampo::validarDato(&$_POST['nombreCurso'], 'nombreCurso', 'NINGUNO', 'no', '5-100');
				$errores .= validarCampo::validarDato(&$_POST['descripcionCurso'], 'descripcionCurso', 'NINGUNO', 'no', '5-200');

				if(empty($errores))
				{
					$curso = new curso($_SESSION['formulario']['idCurso'], $_POST['nombreCurso'], $_POST['descripcionCurso']);
					
					$resultado = $curso->modificar();
					
					if($resultado == 'exito')
					{
					
						vistaGestor::agregarNotificacion('exito', 'Se ha modificado con éxito el Curso/Taller');
						self::_formularioBusqueda();
					}
					elseif($resultado == 'existeNombre')
					{
					
						vistaGestor::agregarErrorForm('nombreCurso', 'El nombre del Curso/Taller ya existe');
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
		
		private function _verEdiciones()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idCurso'] = $_GET['id'];
			}

			if(!empty($_SESSION['formulario']['idCurso']))
			{
				$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			
				if(!empty($curso))
				{
					$curso->cargarColEdiciones();
					
					$arrayColEdiciones = $curso->dameColEdiciones();
					
					$titulos = array('Facilitador', 'Tipo', 'Duracion', 'Inicio', 'Final', 'Cupos', 'Opciones');
					$linkBase = '?ctrl=curso&acc=buscCurso&dato=' . urlencode($_GET['dato']);
					
					$listadoGenerador = new listadoGenerador($arrayColEdiciones, $titulos, $linkBase, $_GET['pag'], 5);
					
					if(!empty($arrayColEdiciones))
					{	
						foreach($arrayColEdiciones as $edicion)
						{							
							$facilitador = $edicion->dameFacilitador();
							
							if(!empty($facilitador))
							{
								$nombreFacilitador = $facilitador->dameNombre();
							}
							else
							{
								$nombreFacilitador = 'No asignado';
							}
							
							if($edicion->dameEstado() == 'bloqueada') {
								$estadoIcono = '<a title="Edición Bloqueada" href="#">
													<img class="bloquear negro">
												</a>';
							}
							else {
								$estadoIcono = '<a title="Edición Abierta" href="#">
													<img class="abierto negro">
												</a>';
							}
							
							$listadoGenerador->agregarFila(
								array (
										$nombreFacilitador,
										ucfirst($edicion->dameTipoLegible()),
										ucfirst($edicion->dameDuracion()),
										invertirFecha($edicion->dameFechaInicio()),
										invertirFecha($edicion->dameFechaFin()),
										$edicion->cuposEdicion() . '/' . $edicion->dameLimite() . ' ' . $estadoIcono,
									
										listadoGenerador::crearOpcion(
											'Seleccionar Edición',
											'?ctrl=edicion&acc=menuEdic&id=' . $edicion->dameId(),
											'selccionar negro')
										)
								, '');
						}
					}

					$htmlListado = $listadoGenerador->generarListado();
	
					vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
					vistaGestor::agregarDiccionario('datoNombre', $curso->dameNombre());
					vistaGestor::agregarDiccionario('datoDescripcion', $curso->dameDescripcion());
					
					vistaGestor::agregarDiccionario('link_nueva_edicion', '?ctrl=edicion&acc=formRegiE');
					
					vistaGestor::agregarArchivoCss('formularios');
					vistaGestor::agregarArchivoCss('listados');
					vistaGestor::documentoNormal('Ediciones del Curso/Taller', array('vistas/curso/CursoEdicionOpciones.html', 'vistas/curso/listadoEdicion.html'));
				}
				else
				{
					unset($_SESSION['formulario']['idCurso']);
					self::_formularioBusqueda();
				}
			}
			else
			{
				unset($_SESSION['formulario']['idCurso']);
				self::_formularioBusqueda();
			}
		}

	}
	
	
	
	
	
	