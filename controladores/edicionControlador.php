<?php
require_once 'modelos/curso.php';
require_once 'modelos/edicion.php';

	class edicionControlador
	{
		function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'formRegiE':
					index::permitirAcceso('cursos');
					self::_formularioRegistrarEdicion();					
				break;
				
				case 'guarRegiE': 
					index::permitirAcceso('cursos');
					self::_guardarRegistrarEdicion();					
				break;
				
				case 'formFijaFaci': 
					index::permitirAcceso('cursos');
					self::_formularioFijarFacilitador();					
				break;

				case 'guarFijaFaci': 
					index::permitirAcceso('cursos');
					self::_guardarFijarFacilitador();					
				break;
				
				case 'menuEdic': 
					self::_menuEdicion();					
				break;
				
				case 'formModiE': 
					index::permitirAcceso('cursos');
					self::_formularioModificarEdicion();					
				break;
				
				case 'guarModiE': 
					index::permitirAcceso('cursos');
					self::_guardarModificarEdicion();					
				break;
				
				case 'formPart': 
					index::permitirAcceso('personas');
					self::_formularioParticipante();					
				break;

				case 'guarPart': 
					index::permitirAcceso('personas');
					self::_guardarParticipante();					
				break;

				case 'verPart': 
					self::_verParticipantes();					
				break;				
				
				case 'cerrar': 
					index::permitirAcceso('cursos');
					self::_cerrarEdicion();					
				break;				
				
				case 'guarCerrar': 
					index::permitirAcceso('cursos');
					self::_guardarCerrarEdicion();					
				break;				
				
				case 'verCerrar': 
					self::_verCerrar();					
				break;				

				default:
					unset($_SESSION['formulario']);
					self::_regresarPrincipal();
				break;
			}
		}
		
		private function _regresarPrincipal()
		{
			unset($_SESSION['formulario']['idCurso']);
			header('location: ?ctrl=curso');
		}

		private function _formularioRegistrarEdicion()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			
			if(!empty($curso))
			{
				vistaGestor::agregarDiccionario('link_form_edicion', '?ctrl=edicion&acc=guarRegiE');
				vistaGestor::agregarDiccionario('datoNombre', $curso->dameNombre());
				vistaGestor::agregarDiccionario('datoDescripcion', $curso->dameDescripcion());
				
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::documentoNormal('Ediciones del Curso/Taller', array('vistas/curso/datosCurso.html', 'vistas/edicion/formEdicion.html'));
			}
			else
			{
				self::_regresarPrincipal();
			}

		}
	
		private function _guardarRegistrarEdicion()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			
			if(!empty($curso))
			{
				$errores .= validarCampo::validarFecha($_POST['fechaInicioEdic'], 'fechaInicioEdic', 'no');
				$errores .= validarCampo::validarFecha($_POST['fechaFinEdic'], 'fechaFinEdic', 'no');
				
				if(empty($errores) )
				{
					if(segundosFecha($_POST['fechaInicioEdic']) > segundosFecha($_POST['fechaFinEdic']))
					{
						$errores .= 'ERROR';
						vistaGestor::agregarErrorForm('fechaInicioEdic', 'La fecha de inicio es mayor a la de culminaci&oacute;n');
					}
				}
				
				$errores .= validarCampo::validarDato($_POST['limiteEdic'], 'limiteEdic', 'NUMERICO', 'no', '1-3');
				$errores .= validarCampo::validarSelect($_POST['tipoEdic'], 'tipoEdic', 'no');
				$errores .= validarCampo::validarDato($_POST['duracionEdic'], 'duracionEdic', 'NINGUNO', 'no', '3-15', 'palabras');
				$errores .= validarCampo::validarDato($_POST['horarioEdic'], 'horarioEdic', 'NINGUNO', 'no', '3-200');
				$errores .= validarCampo::validarDato($_POST['sinopticoEdic'], 'sinopticoEdic', 'NINGUNO', 'si', '3-500');

			
				if(empty($errores))
				{
					$edicionIncompleta = new edicion(
								NULL, $_POST['tipoEdic'], $_POST['fechaInicioEdic'], $_POST['fechaFinEdic'],
								$_POST['duracionEdic'], $_POST['limiteEdic'], $_POST['horarioEdic'], $_POST['sinopticoEdic']
								);

					$edicionIncompleta->registrar($curso->dameId());
					
					$_SESSION['formulario']['idEdicion'] = $edicionIncompleta->dameId();
					
					$edicionCompleta = $curso->seleccionarEdicion($edicionIncompleta->dameId());
				
					vistaGestor::agregarNotificacion('exito', 'Se ha registrado con &eacute;xito la edici&oacute;n');

					self::_formularioFijarFacilitador($curso, $edicionCompleta);
				}
				else
				{
					vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoEdic'], 'selected="selected"');
					self::_formularioRegistrarEdicion();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _formularioFijarFacilitador(curso $curso = NULL, edicion $edicion = NULL)
		{
			if(empty($curso) and empty($edicion))
			{
				$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
				if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
				}
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				$_SESSION['formulario']['idCurso'] = $curso->dameId();
				$_SESSION['formulario']['idEdicion'] = $edicion->dameId();
			
				vistaGestor::agregarArchivoCss('formularios');

				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
				
				$facilitador = $edicion->dameFacilitador();

				if(!empty($facilitador))
				{				
					vistaGestor::agregarDiccionario('nombreFacilitador', $facilitador->dameNombre());
					vistaGestor::agregarDiccionario('apellidoFacilitador', $facilitador->dameApellido());
					vistaGestor::agregarDiccionario('documentoFacilitador', $facilitador->dameDocumento());

					$arrayVistas = array('vistas/edicion/informacionEdicion.html', 'vistas/edicion/datosFacilitador.html');
				}
				else
				{
					$arrayVistas = array('vistas/edicion/informacionEdicion.html');
				}
	
				$arrayVistas[] = 'vistas/edicion/formBusquedaPersona.html';
				
				vistaGestor::agregarDiccionario('link_form_busq_persona', 'formFijaFaci');
	
				if(!empty($_POST) and isset($_POST['documentoPers']))
				{
					$errores .= validarCampo::validarDato($_POST['documentoPers'], 'busqueda', 'NUMERICO', 'no', '4-8');
					$errores .= validarCampo::validarSelect($_POST['tipoDocumentoPers'], 'busqueda', 'no');
					
					vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoDocumentoPers'], 'selected="selected"');

					if(empty($errores))
					{
						$personaEncontrada = persona::buscar( $_POST['tipoDocumentoPers'] . '-' . $_POST['documentoPers']);
						
						if(!empty($personaEncontrada))
						{
							vistaGestor::agregarDiccionario('nombreCoincidencia', $personaEncontrada->dameNombre());
							vistaGestor::agregarDiccionario('apellidoCoincidencia', $personaEncontrada->dameApellido());
							vistaGestor::agregarDiccionario('documentoCoincidencia', $personaEncontrada->dameDocumento());
					
							$_SESSION['formulario']['idFacilitador'] = $personaEncontrada->dameId();

							if(!empty($facilitador))
							{
								if($personaEncontrada->dameId() != $facilitador->dameId())
								{
									vistaGestor::agregarDiccionario('mensaje_seleccion_facilitador', '<br>&iquest;Desea asignarlo como Facilitador de este Curso/Taller?<br>');
									
									$linkSeleccionFacilitador = '<br><a href="?ctrl=edicion&acc=guarFijaFaci">
											<button type="button" class="btn waves-effect waves-light blue">
												Asignar
											</button>
										</a><br>';
										
									vistaGestor::agregarDiccionario('link_seleccion_facilitador', $linkSeleccionFacilitador);
								}
								else
								{
									vistaGestor::agregarDiccionario('mensaje_seleccion_facilitador', 'Esta persona se encuentra ya asignada como facilitador.');
								}
							}
							else
							{
								vistaGestor::agregarDiccionario('mensaje_seleccion_facilitador', '<br>&iquest;Desea asignarlo como Facilitador de este Curso/Taller?<br>');
								
								$linkSeleccionFacilitador = '<br><a href="?ctrl=edicion&acc=guarFijaFaci">
											<button type="button" class="btn waves-effect waves-light blue">
												Asignar
											</button>
										</a><br>';
										
									vistaGestor::agregarDiccionario('link_seleccion_facilitador', $linkSeleccionFacilitador);
							}
							
							$arrayVistas[] = 'vistas/edicion/seleccionFacilitador.html';
						}
						else
						{
							vistaGestor::agregarNotificacion('alerta', 'No se ha encontrado ninguna coincidencia');
						}
					}
				}
				
				$arrayVistas[] = 'vistas/edicion/botonSalir.html';
				vistaGestor::documentoNormal('Indicar Facilitador', $arrayVistas);				
			
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _guardarFijarFacilitador()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				$resultado = $edicion->asignarFacilitador($_SESSION['formulario']['idFacilitador']);
				
				if(!empty($resultado))
				{					
					unset($_SESSION['formulario']['idFacilitador']);
				
					self::_menuEdicion();
				}
				else
				{
					self::_regresarPrincipal();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _cerrarEdicion()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion))
			{
				$facilitador = $edicion->dameFacilitador();
				$certificado = $edicion->dameCertificado();
				$identificador = $edicion->dameIdentificador();

				if(
					!empty($facilitador) and !empty($certificado) and !empty($identificador) 
					and $edicion->cuposEdicion() < $edicion->dameLimite() and 
					segundosFecha(invertirFecha($edicion->dameFechaInicio())) <= segundosFecha(date('d-m-Y'))
					and $edicion->dameEstado() != 'bloqueada'
					)
				{
					
				
					if($edicion->dameTipo() == 'curso_apro' or $edicion->dameTipo() == 'taller_apro')
					{
						$lasOpciones = 'Calificaci&oacute;n';
					}
					else
					{
						$lasOpciones = 'Certificaci&oacute;n';
					}

					$titulos = array('Nombre', 'Apellido', 'Documento', $lasOpciones);
					$linkBase = '#';
					
					$colParticipantes = $edicion->dameColParticipantes();
					
					$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag'], $edicion->dameLimite());

					foreach($colParticipantes as $participante)
					{
						if($edicion->dameTipo() == 'curso_apro' or $edicion->dameTipo() == 'taller_apro')
						{
							$opcionesParticipante = '<input name="participante_' . $participante->dameId() . '" type="text" placeholder="0 equivale a No Curso" value="{#post_participante_' . $participante->dameId() .'}">';
						}
						else
						{
							$opcionesParticipante = '<select name="participante_' . $participante->dameId() . '">
								<option value="participacion">Por participaci&oacute;n</option>
								<option value="noCurso">No curs&oacute; (Sin certificado)</option>
							</select>';
						}
					
						$listadoGenerador->agregarFila(
							array (
									$participante->dameNombre(),
									$participante->dameApellido(),
									$participante->dameDocumento(),
									$opcionesParticipante
									)
							, '');
					}
					
					$htmlListado = $listadoGenerador->generarListado();
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
	
					vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
					vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());
					
					vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
					
					vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
					vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
					vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
					vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
					vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
					vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
					
					vistaGestor::agregarArchivoCss('listados');
					vistaGestor::agregarArchivoJs('confirmarCerrarEdicion');
					vistaGestor::documentoNormal('Cerrar Edici&oacute;n', array('vistas/edicion/datosEdicion.html', 'vistas/edicion/cerrarEdicion.html'));
				}
				else
				{
					self::_menuEdicion();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _guardarCerrarEdicion()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion))
			{
				$facilitador = $edicion->dameFacilitador();
				$certificado = $edicion->dameCertificado();
				$identificador = $edicion->dameIdentificador();
				
				if(
					!empty($facilitador) and !empty($certificado) and !empty($identificador) 
					and $edicion->cuposEdicion() < $edicion->dameLimite() and 
					segundosFecha(invertirFecha($edicion->dameFechaInicio())) <= segundosFecha(date('d-m-Y'))
					and $edicion->dameEstado() != 'bloqueada'
					)
				{				
					$datosRelacionados = $edicion->dameRelacionParticipantes();
					
					$errores = 0;
					$posicion = 0;
					
					foreach($datosRelacionados as $valor)
					{
						$idPersona = $valor['id_persona'];

						if(isset($_POST['participante_' . $idPersona]))
						{
							$guardarEstado[$posicion]['idPersona'] = $idPersona;
							
							if($edicion->dameTipo() == 'curso_apro' or $edicion->dameTipo() == 'taller_apro')
							{
								
								$errorDato = validarCampo::validarDato(
										$_POST['participante_' . $idPersona], '', 'NUMERICO', 'no', '1-3');
							
								if(
									$_POST['participante_' . $idPersona] >= 0 and 
									$_POST['participante_' . $idPersona] <= 100 and
									empty($errorDato)
									)
								{									
									$guardarEstado[$posicion]['estado'] = $_POST['participante_' . $idPersona];
								}
								else
								{
									$errorTipo = 'ESTADO_NOTA';
									$errores++;
								}
							}
							else
							{
								if(
									$_POST['participante_' . $idPersona] ==  'participacion' or 
									$_POST['participante_' . $idPersona] == 'noCurso'
									)
								{
									$guardarEstado[$posicion]['estado'] = $_POST['participante_' . $idPersona];
								}
								else
								{
									$errorTipo = 'ESTADO_PARTICIPACION';
									$errores++;
								}
							}
						}
						else
						{
							$errores++;
							$errorTipo = 'ID';
						}
						
						$posicion++;
					}
					
					if($errores == 0)
					{
						$edicion->guardarEstado($guardarEstado);
						vistaGestor::agregarNotificacion('exito', 'Se ha cerrado el curso exitosamente');
						self::_menuEdicion();
					}
					else
					{
						switch($errorTipo)
						{
							case 'ID':
								$mensajeNotificacion = 'ID modificado';
							break;
							
							case 'ESTADO_PARTICIPACION':
								$mensajeNotificacion = 'Indique todos los tipos de Certificaci&oacute;n';
							break;
							
							case 'ESTADO_NOTA':
								$mensajeNotificacion = 'La Calificaci&oacute;n debe ser entre 0 y 100';
							break;
						}
						
						
						vistaGestor::agregarNotificacion('alerta', $mensajeNotificacion);
						self::_cerrarEdicion();
					}
				}
				else
				{
					self::_menuEdicion();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		
		}
		
		private function _menuEdicion()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idEdicion']= $_GET['id'];
			}
			
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion))
			{
				$_SESSION['formulario']['idCurso'] = $curso->dameId();
				$_SESSION['formulario']['idEdicion'] = $edicion->dameId();
				
				vistaGestor::agregarArchivoCss('formularios');

				$miSinoptico = $edicion->dameSinoptico();
				
				if(empty($miSinoptico)) {
					$miSinoptico = 'Sin sinoptico';
				}
				
				
				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
				vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());			
				vistaGestor::agregarDiccionario('sinopticoEdicion', $miSinoptico);			
				vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . '/' . $edicion->dameLimite());

				$facilitador = $edicion->dameFacilitador();
				$certificado = $edicion->dameCertificado();
				$identificador = $edicion->dameIdentificador();
				
				if(
					!empty($facilitador) and !empty($certificado) and !empty($identificador) 
					and $edicion->cuposEdicion() < $edicion->dameLimite() and 
					segundosFecha(invertirFecha($edicion->dameFechaInicio())) <= segundosFecha(date('d-m-Y')) and
					$edicion->dameEstado() != 'bloqueada'
					)
				{
					$linkCerrarEdicion = '<a href="?ctrl=edicion&acc=cerrar">
						<span class="option light-green">Cerrar Curso/Taller</span>
					</a>';
					
					vistaGestor::agregarDiccionario('link_cerrar_edicion', $linkCerrarEdicion);
				}
				
				if($edicion->dameEstado() != 'bloqueada')
				{
					$linkModificarEdicion = '<a href="?ctrl=edicion&acc=formModiE">
						<span class="option light-green">Modificar Edici&oacute;n</span>
											</a>';
					
					vistaGestor::agregarDiccionario('link_modificar_ediccion', $linkModificarEdicion);
					
					$linkAsignarFacilitador = '<a href="?ctrl=edicion&acc=formFijaFaci">
						<span class="option light-green">Asignar Facilitador</span>
												</a>';
												
					$linkInscripcionParticipante = '<a href="?ctrl=edicion&acc=formPart">
						<span class="option light-green">Inscribir/Desincorporar participante</span>
													</a>';
													
					if(!empty($certificado))
					{
						
						$linkCreacionCertificado = '<a href="?ctrl=documento&acc=creaCert">
							<span class="option light-green">Modificar Certificado</span>
													</a>';
					}
					else
					{
						$linkCreacionCertificado = '<a href="?ctrl=documento&acc=creaCert">
							<span class="option light-green">Crear Certificado</span>
													</a>';
					}

					if(!empty($identificador))
					{
						
						$linkCreacionIdentificador = '<a href="?ctrl=documento&acc=creaIden">
							<span class="option light-green">Modificar Identificador</span>
													</a>';
													
						$linkImprimirIdentificador = '<a href="?ctrl=documento&acc=imprIden">
							<span class="option light-green">Imprimir identificadores</span>
												</a>';
					}
					else
					{
						$linkCreacionIdentificador = '<a href="?ctrl=documento&acc=creaIden">
							<span class="option light-green">Crear Identificador</span>
													</a>';
													
						$linkImprimirIdentificador = '';
					}
					

					if($edicion->cuposEdicion() < $edicion->dameLimite())
					{
						$linkImprimirAsistencias = '<a href="?ctrl=documento&acc=imprAsis">
							<span class="option light-green">Imprimir Asistencias</span>
												</a>';
					}
				}
				else
				{
					$linkAsignarFacilitador = '<a href="#misOpciones">
						<span class="option light-green">Asignar Facilitador (Bloqueado)</span>
												</a>';
												
					$linkInscripcionParticipante = '<a href="#misOpciones">
						<span class="option light-green">Inscribir/Desincorporar participante (Bloqueado)</span>
												</a>';
												
					$linkCreacionCertificado = '<a href="#misOpciones">
						<span class="option light-green">Modificar Certificado (Bloqueado)</span>
													</a>';
													
					$linkCreacionIdentificador = '<a href="#misOpciones">
						<span class="option light-green">Modificar Identificador (Bloqueado)</span>
													</a>';
													
					$linkImprimirCertificado = '<a href="?ctrl=documento&acc=imprCert">
						<span class="option light-green">Imprimir certificados</span>
												</a>';
												
					$linkVerCerrar = '<a href="?ctrl=edicion&acc=verCerrar">
						<span class="option light-green">Ver culminaci&oacute;n</span>
									</a>';
									
					$linkImprimirCerrar = '<a href="?ctrl=documento&acc=imprCulm">
						<span class="option light-green">Imprimir Culminaci&oacute;n</span>
												</a>';
					$linkEnviarCertificado = '<a href="?ctrl=documento&acc=envCert">
						<span class="option light-green">Enviar certificados</span>
												</a>';
					
					$elSinopticoComparacion = $edicion->dameSinoptico();
					
					if(!empty($elSinopticoComparacion))
					{
						$linkImprimirReverso = '<a href="?ctrl=documento&acc=imprReve">
							<span class="option light-green">Imprimir reverso de los certificados</span>
												</a>';
					}					
					
				}

				vistaGestor::agregarDiccionario('link_asignar_facilitador', $linkAsignarFacilitador);
				
				vistaGestor::agregarDiccionario('link_inscripcion_participante', $linkInscripcionParticipante);
				
				vistaGestor::agregarDiccionario('link_creacion_certificado', $linkCreacionCertificado);
				
				vistaGestor::agregarDiccionario('link_creacion_identificador', $linkCreacionIdentificador);
				
				vistaGestor::agregarDiccionario('link_imprimir_certificado', $linkImprimirCertificado);
				
				vistaGestor::agregarDiccionario('link_imprimir_identificador', $linkImprimirIdentificador);
				
				vistaGestor::agregarDiccionario('link_imprimir_asistencias', $linkImprimirAsistencias);
				
				vistaGestor::agregarDiccionario('link_ver_cerrar', $linkVerCerrar);
				
				vistaGestor::agregarDiccionario('link_imprimir_culminacion', $linkImprimirCerrar);
				
				vistaGestor::agregarDiccionario('link_imprimir_reverso', $linkImprimirReverso);
				
				vistaGestor::agregarDiccionario('link_enviar_certificado', $linkEnviarCertificado);

				
				
				if(!empty($facilitador) and count($edicion->dameColParticipantes()) > 0)
				{
					$linkImprimirParticipantes = '<a href="?ctrl=documento&acc=imprPart">
						<span class="option light-green">Imprimir participantes</span>
					</a>';
					
					vistaGestor::agregarDiccionario('link_imprimir_participantes', $linkImprimirParticipantes);
				}				
				
				if(!empty($facilitador))
				{
					list($primerNombre) = explode(' ', $facilitador->dameNombre());
					list($primerApellido) = explode(' ', $facilitador->dameApellido());
					$nombreFacilitador = $primerNombre . ' ' . $primerApellido;

					vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				}
				else
				{
					vistaGestor::agregarDiccionario('nombreFacilitador', 'Sin asignar');
				}

				$arrayVistas = array('vistas/edicion/datosCompletoEdicion.html', 'vistas/edicion/opcionesMenu.html');
				
				vistaGestor::documentoNormal('Men&uacute; de la Edici&oacute;n', $arrayVistas);
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _formularioModificarEdicion()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				vistaGestor::agregarDiccionario('link_form_edicion', '?ctrl=edicion&acc=guarModiE');
								
				$facilitador = $edicion->dameFacilitador();
				
				if(!empty($facilitador)) {
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
				}
				else {
					$nombreFacilitador = "Sin asignar";
				}

				vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());
					
				
				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
				vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
				
				if(empty($_POST))
				{
					vistaGestor::agregarDiccionario('post_limiteEdic', $edicion->dameLimite());
					vistaGestor::agregarDiccionario('post_duracionEdic', $edicion->dameDuracion());
					vistaGestor::agregarDiccionario('post_tipoEdic', $edicion->dameTipoLegible());
					vistaGestor::agregarDiccionario('selected_tipo_' . $edicion->dameTipo(), 'selected="selected"');
					
					vistaGestor::agregarDiccionario('post_fechaInicioEdic', invertirFecha($edicion->dameFechaInicio()));
					vistaGestor::agregarDiccionario('post_fechaFinEdic', invertirFecha($edicion->dameFechaFin()));
					vistaGestor::agregarDiccionario('post_horarioEdic', $edicion->dameHorario());
					vistaGestor::agregarDiccionario('post_sinopticoEdic', $edicion->dameSinoptico());				
				}
				
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::documentoNormal('Modificar Edici&oacute;n', array('vistas/edicion/datosEdicion.html', 'vistas/edicion/formEdicion.html'));
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
	
		
		private function _guardarModificarEdicion()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				$errores .= validarCampo::validarFecha($_POST['fechaInicioEdic'], 'fechaInicioEdic', 'no');
				$errores .= validarCampo::validarFecha($_POST['fechaFinEdic'], 'fechaFinEdic', 'no');
				
				if(empty($errores) )
				{
					if(segundosFecha($_POST['fechaInicioEdic']) > segundosFecha($_POST['fechaFinEdic']))
					{
						$errores .= 'ERROR';
						vistaGestor::agregarErrorForm('fechaInicioEdic', 'La fecha de inicio es mayor a la de culminaci&oacute;n');
					}
				}
				
				$errores .= validarCampo::validarDato($_POST['limiteEdic'], 'limiteEdic', 'NUMERICO', 'no', '1-3');
				$errores .= validarCampo::validarSelect($_POST['tipoEdic'], 'tipoEdic', 'no');
				$errores .= validarCampo::validarDato($_POST['duracionEdic'], 'duracionEdic', 'NINGUNO', 'no', '3-15', 'palabras');
				$errores .= validarCampo::validarDato($_POST['horarioEdic'], 'horarioEdic', 'NINGUNO', 'no', '3-200');
				$errores .= validarCampo::validarDato($_POST['sinopticoEdic'], 'sinopticoEdic', 'NINGUNO', 'si', '3-500');
			
				if(empty($errores))
				{
					$cantidadInscritos = $edicion->dameLimite() - $edicion->cuposEdicion();
					
					if($_POST['limiteEdic'] >= $cantidadInscritos)
					{
						$edicionModificar = new edicion(
										$edicion->dameId(), $_POST['tipoEdic'], $_POST['fechaInicioEdic'],
										$_POST['fechaFinEdic'], $_POST['duracionEdic'], $_POST['limiteEdic'], 
										$_POST['horarioEdic'], $_POST['sinopticoEdic']
										);
					
						$edicionModificar->modificar();

						vistaGestor::agregarNotificacion('exito', 'Se ha modificado con &eacute;xito la edici&oacute;n');

						self::_menuEdicion();
					}
					else
					{
						vistaGestor::agregarErrorForm('limiteEdic', 'El limite es menor a la cantidad de inscritos actualmente');
						self::_formularioModificarEdicion();
					}
				}
				else
				{
					vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoEdic'], 'selected="selected"');
					self::_formularioModificarEdicion();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _formularioParticipante()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				$_SESSION['formulario']['idCurso'] = $curso->dameId();
				$_SESSION['formulario']['idEdicion'] = $edicion->dameId();
			
				vistaGestor::agregarArchivoCss('formularios');
	
				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
				vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
				
				$facilitador = $edicion->dameFacilitador();
				
				if(!empty($facilitador)) {
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
				}
				else {
					$nombreFacilitador = "Sin asignar";
				}

				vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());

				$arrayVistas = array('vistas/edicion/datosEdicion.html', 'vistas/edicion/formBusquedaPersona.html');
			
				vistaGestor::agregarDiccionario('link_form_busq_persona', 'formPart');
	
				if(!empty($_POST) and isset($_POST['documentoPers']))
				{
					$errores .= validarCampo::validarDato($_POST['documentoPers'], 'busqueda', 'NUMERICO', 'no', '4-8');
					$errores .= validarCampo::validarSelect($_POST['tipoDocumentoPers'], 'busqueda', 'no');
					
					vistaGestor::agregarDiccionario('selected_tipo_' . $_POST['tipoDocumentoPers'], 'selected="selected"');

					if(empty($errores))
					{
						$personaEncontrada = persona::buscar( $_POST['tipoDocumentoPers'] . '-' . $_POST['documentoPers']);
						
						if(!empty($personaEncontrada))
						{
							vistaGestor::agregarDiccionario('nombreCoincidencia', $personaEncontrada->dameNombre());
							vistaGestor::agregarDiccionario('apellidoCoincidencia', $personaEncontrada->dameApellido());
							vistaGestor::agregarDiccionario('documentoCoincidencia', $personaEncontrada->dameDocumento());
					
							$_SESSION['formulario']['idParticipante'] = $personaEncontrada->dameId();
							
							$resultado = $edicion->existeParticipante($personaEncontrada->dameId());
							
							if(!empty($resultado))
							{
								$mensaje = 'Esta persona esta registrada en esta Edici&oacute;n &iquest;Desea desincorporarla?';
								$icono = 'borrar';
								$palabra = 'Desincorporar';
								$link = '?ctrl=edicion&acc=guarPart';
							}
							else
							{								
								if($edicion->cuposEdicion() < 1)
								{
									$mensaje = 'No hay cupos disponibles para este Curso/Taller';
									$icono = 'bloquear';
									$palabra = 'Inscribir';
									$link = '#documentoPers';
								}
								else
								{
									if(!empty($facilitador)) {
										$idFacilitador = $facilitador->dameId();
									}
									else {
										$idFacilitador = "0";
									}
									
									if($idFacilitador != $personaEncontrada->dameId())
									{
										$mensaje = 'Esta persona no esta registrada en esta Edici&oacute;n &iquest;Desea inscribirla?';
										$icono = 'asignar';
										$palabra = 'Inscribir';
										$link = '?ctrl=edicion&acc=guarPart';
									}
									else
									{
										$mensaje = 'Esta persona se encuentra registrada como el facilitador de este Curso/Taller';
										$icono = 'bloquear';
										$palabra = 'Inscribir';
										$link = '#documentoPers';
									}
								}
							}

							vistaGestor::agregarDiccionario('mensaje_participante', $mensaje);
							vistaGestor::agregarDiccionario('icono_accion', $icono);
							vistaGestor::agregarDiccionario('palabra_accion', $palabra);
							vistaGestor::agregarDiccionario('link_accion_participante', $link);
					
							$arrayVistas[] = 'vistas/edicion/seleccionParticipante.html';
						}
						else
						{
							vistaGestor::agregarNotificacion('alerta', 'No se ha encontrado ninguna coincidencia');
						}
					}
				}
				
				$arrayVistas[] = 'vistas/edicion/botonSalir.html';
				vistaGestor::documentoNormal('Inscribir/Desincorporar participante', $arrayVistas);				
			}
			else
			{
				self::_regresarPrincipal();
			}
		
		}
		
		private function _guardarParticipante()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and !empty($_SESSION['formulario']['idParticipante'])  and $edicion->dameEstado() != 'bloqueada')
			{
				$resultado = $edicion->existeParticipante($_SESSION['formulario']['idParticipante']);
						
				$error = '';
				
				if(!empty($resultado))
				{
					$edicion->desincorporarPersona($_SESSION['formulario']['idParticipante']);
					
					$mensajeResultado = 'desincorporaci&oacute;n';
				}
				else
				{
					if(!empty($facilitador)) {
						$idFacilitador = $facilitador->dameId();
					}
					else {
						$idFacilitador = "0";
					}

					if($edicion->cuposEdicion() > 0 and $idFacilitador != $_SESSION['formulario']['idParticipante'])
					{
						$edicion->incribirPersona($_SESSION['formulario']['idParticipante']);
					
						$mensajeResultado = 'inscripci&oacute;n';
					}
					else
					{
						$error = "ERROR";
					}
				}
				
				if(empty($error))
				{
					unset($_SESSION['formulario']['idParticipante']);
					
					vistaGestor::agregarNotificacion('exito', "Se ha realizado la $mensajeResultado con &eacute;xito");
					self::_menuEdicion();
				}
				else
				{
					self::_regresarPrincipal();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _verParticipantes()
		{
			
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion))
			{
				$colParticipantes = $edicion->dameColParticipantes();
				
				$titulos = array('Nombre', 'Apellido', 'Documento', 'Tel&eacute;fono');
				$linkBase = '?ctrl=curso&acc=buscCurso';
				
				$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag'], 15);
				
				if(!empty($colParticipantes))
				{
					foreach($colParticipantes as $participante)
					{
						$listadoGenerador->agregarFila(
							array (
									$participante->dameNombre(),
									$participante->dameApellido(),
									$participante->dameDocumento(),
									$participante->dameTelefono()
									)
							, '');
					}
				}

				$htmlListado = $listadoGenerador->generarListado();
				
				$facilitador = $edicion->dameFacilitador();
				
				if(!empty($facilitador)) {
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
				}
				else {
					$nombreFacilitador = "Sin asignar";
				}

				vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());
				
				vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
				
				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
				vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
				
				vistaGestor::agregarArchivoCss('listados');
				vistaGestor::documentoNormal('Listado de participantes', array('vistas/edicion/datosEdicion.html', 'vistas/edicion/listadoParticipantes.html'));
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _verCerrar()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion))
			{
				if($edicion->dameEstado() == 'bloqueada')
				{
					if($edicion->dameTipo() == 'curso_apro' or $edicion->dameTipo() == 'taller_apro')
					{
						$lasOpciones = 'Calificaci&oacute;n';
					}
					else
					{
						$lasOpciones = 'Certificaci&oacute;n';
					}
					
					$titulos = array('Nombre', 'Apellido', 'Documento', $lasOpciones);
					$linkBase = '#';
					
					$colParticipantes = $edicion->dameColParticipantes();
					
					$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag'], $edicion->dameLimite());
					
					$datosRelacionados = $edicion->dameRelacionParticipantes();
					
					foreach($datosRelacionados as $valores)
					{
						$idTemporal = $valores['id_persona'];
						$tipoCulminacion[$idTemporal] = $valores['estado'];
					}

					foreach($colParticipantes as $participante)
					{
						$miIdParticipante = $participante->dameId();
						$miTipoCulminacion = $tipoCulminacion[$miIdParticipante];
							
						if($miTipoCulminacion == 'participacion')
						{
							$datoTipo = 'Participaci&oacute;n';
						}
						elseif($miTipoCulminacion == 'noCurso')
						{
							$datoTipo = 'No curs&oacute;';
						}
						elseif($miTipoCulminacion > 0)
						{
							$datoTipo = $miTipoCulminacion;
						}
						elseif($miTipoCulminacion == 0)
						{
							$datoTipo = 'No curs&oacute;';
						}
						else
						{
							exit("ERROR: NINGUN TIPO DE CERTIFICADO COINCIDE");
						}
					
						$listadoGenerador->agregarFila(
							array (
									$participante->dameNombre(),
									$participante->dameApellido(),
									$participante->dameDocumento(),
									$datoTipo
									)
							, '');
					}
					
					
					
					$htmlListado = $listadoGenerador->generarListado();
					$facilitador = $edicion->dameFacilitador();
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
					
					vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
					vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());
					
					vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
					
					vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
					vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
					vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
					vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
					vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
					vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
					
					vistaGestor::agregarArchivoCss('listados');
					vistaGestor::agregarArchivoJs('confirmarCerrarEdicion');
					vistaGestor::documentoNormal('Ver culminaci&oacute;n', array('vistas/edicion/datosEdicion.html', 'vistas/edicion/cerrarEdicion.html'));
				}
				else
				{
					self::_menuEdicion();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
	}