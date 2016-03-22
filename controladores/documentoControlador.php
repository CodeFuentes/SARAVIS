<?php
require_once 'modelos/curso.php';
require_once 'modelos/edicion.php';
require_once 'modelos/certificado.php';
require_once 'modelos/identificador.php';

	class documentoControlador
	{
		function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'creaCert': 
					index::permitirAcceso('documentos');
					self::_fromCrearCertificado();
				break;
				
				case 'guarCert': 
					index::permitirAcceso('documentos');
					self::_guardarCertificado();
				break;

				case 'creaIden':
					index::permitirAcceso('documentos');
					self::_crearIdentificador();
				break;
				
				case 'guarIden': 
					index::permitirAcceso('documentos');
					self::_guardarIdentificador();
				break;
				
				case 'imprIden': 
					index::permitirAcceso('impresiones');
					self::_imprimirIdentificadores();
				break;
				
				case 'geneIden':
					index::permitirAcceso('impresiones');
					self::_generarIdentificadores();
				break;

				case 'imprCert': 
					index::permitirAcceso('impresiones');
					self::_imprimirCertificados();
				break;
				
				case 'geneCert':
					index::permitirAcceso('impresiones');
					self::_generarCertificados();
				break;
				
				case 'imprPart': 
					index::permitirAcceso('impresiones');
					self::_imprimirListadoParticipantes();
				break;
				
				case 'imprAsis': 
					index::permitirAcceso('impresiones');
					self::_imprimirListadoAsistencia();
				break;
				
				case 'imprReve': 
					index::permitirAcceso('impresiones');
					self::_imprimirReverso();
				break;
				
				case 'imprCulm': 
					index::permitirAcceso('impresiones');
					self::_imprimirCulminacion();
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

		private function _fromCrearCertificado()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				$certificado = $edicion->dameCertificado();
				
				if(empty($_POST))
				{
					if(!empty($certificado))
					{
						list($calificativoFaci, $cargoFaci) = explode('(#=D=#)', $certificado->dameFirmaFacilitador());
						
						vistaGestor::agregarDiccionario('post_calificativoFacilitadorDoc', $calificativoFaci);
						vistaGestor::agregarDiccionario('post_cargoFacilitadorDoc', $cargoFaci);

						$fimasExtras = $certificado->dameFirmasExtras();
						
						if(!empty($fimasExtras))
						{
							$colFirmasExtras = explode('(#=P=#)', $certificado->dameFirmasExtras());
							
							$posicion = 0;
							
							foreach($colFirmasExtras as $firmaExtra)
							{
								$posicion++;
							
								list($calificativoFirm, $nombreFirm, $cargoFirm) = explode('(#=D=#)', $firmaExtra);
								
								vistaGestor::agregarDiccionario('post_calificativo' . $posicion . 'Doc', $calificativoFirm);
								vistaGestor::agregarDiccionario('post_cargo' . $posicion . 'Doc', $cargoFirm);
								vistaGestor::agregarDiccionario('post_nombre' . $posicion . 'Doc', $nombreFirm);	
								
								vistaGestor::agregarDiccionario('display' . $posicion, 'inline');
							}
							
							vistaGestor::agregarDiccionario('selected_numFirmas_' . $posicion, 'selected="selected"');
							
							for($i = ($posicion + 1); $i < 5; $i++)
							{
								vistaGestor::agregarDiccionario('display' . $i, 'none');
							}
						}
						else
						{
							for($i = 1; $i < 5; $i++)
							{
								vistaGestor::agregarDiccionario('display' . $i, 'none');
							}
							
							vistaGestor::agregarDiccionario('selected_numFirmas_0', 'selected="selected"');
						}

						if($certificado->dameLogoExtra() != 'ninguno')
						{
							vistaGestor::agregarDiccionario('selected_logo_mantener', 'selected="selected"');

							vistaGestor::agregarDiccionario(
													'link_imagen_logo',
													'recursos/certificados/' . $certificado->dameLogoExtra()
													);
						}
						else
						{
							vistaGestor::agregarDiccionario('selected_logo_ninguno', 'selected="selected"');
							vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');
						}
						
						vistaGestor::agregarDiccionario('selected_fondo_mantener', 'selected="selected"');
						vistaGestor::agregarDiccionario(
													'link_imagen_fondo',
													'recursos/certificados/' . $certificado->dameFondo());
					}
					else
					{
						for($i = 1; $i < 4; $i++)
						{
							vistaGestor::agregarDiccionario('display' . $i, 'none');
						}

						vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');				
						vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
					}
				}
				else
				{
					for($i = $_POST['numFirmasDoc']; $i < 5; $i++)
					{
						vistaGestor::agregarDiccionario('display' . ($i + 1), 'none');
					}
					
					if(!empty($certificado))
					{
						if($certificado->dameLogoExtra() != 'ninguno')
						{
							vistaGestor::agregarDiccionario(
													'link_imagen_logo',
													'recursos/certificados/' . $certificado->dameLogoExtra()
													);
						}
						else
						{
							vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');
						}
						
						vistaGestor::agregarDiccionario(
													'link_imagen_fondo',
													'recursos/certificados/' . $certificado->dameFondo()
													);
					}
					else
					{
						vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');
						vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
					}
				}

				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));

				$facilitador = $edicion->dameFacilitador();
				
				if(!empty($facilitador))
				{				
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
				
					vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				}
				else
				{
					vistaGestor::agregarDiccionario('nombreFacilitador', 'Sin asignar');
				}
	
				vistaGestor::agregarArchivoJs('formCertificado');
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::documentoNormal('Crear Certificado', array('vistas/certificado/informacionEdicion.html', 'vistas/certificado/formCertificado.html'));
			}
			else
			{
				self::_regresarPrincipal();
			}
		}

		private function _guardarCertificado()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			if(!empty($edicion)){
				$certificado = $edicion->dameCertificado();
			}
			
			
			if(!empty($curso) and !empty($edicion) and !empty($_POST) and $edicion->dameEstado() != 'bloqueada')
			{
				$errores .= validarCampo::validarSelect($_POST['numFirmasDoc'], 'numFirmasDoc', 'no');				
				
				if(empty($errores))
				{
					vistaGestor::agregarDiccionario('selected_numFirmas_' . $_POST['numFirmasDoc'], 'selected="selected"');

					for($i = 1; $i <= $_POST['numFirmasDoc']; $i++)
					{
						$errores .= validarCampo::validarDato($_POST['calificativo' . $i . 'Doc'], 'calificativo' . $i . 'Doc', 'NINGUNO', 'no', '2-50');
						$errores .= validarCampo::validarDato($_POST['cargo' . $i . 'Doc'], 'cargo' . $i . 'Doc', 'NINGUNO', 'no', '2-100');
						$errores .= validarCampo::validarDato($_POST['nombre' . $i . 'Doc'], 'nombre' . $i . 'Doc', 'NINGUNO', 'no', '2-60');
					}
				}

				$errores .= validarCampo::validarDato($_POST['calificativoFacilitadorDoc'], 'calificativoFacilitadorDoc', 'NINGUNO', 'no', '2-50');
				$errores .= validarCampo::validarDato($_POST['cargoFacilitadorDoc'], 'cargoFacilitadorDoc', 'NINGUNO', 'no', '3-140');

				$errorTemporalLogo = '';
				$errorTemporalLogo .= validarCampo::validarSelect($_POST['accionLogoDoc'], 'accionLogoDoc', 'no');

				if(empty($errorTemporalLogo) and $_POST['accionLogoDoc'] == 'cambiar')
				{
					if($_FILES["filaLogoDoc"]["type"] == "image/jpeg" or $_FILES["filaLogoDoc"]["type"] == "image/jpg" or $_FILES["filaLogoDoc"]["type"] == "image/png")
					{
						if($_FILES["filaLogoDoc"]["size"] > 1048576)
						{
							$errorTemporalLogo .= 'Error';
							vistaGestor::agregarErrorForm('filaLogoDoc', 'La imagen del logo extra debe no puede ser mayor a 1 MB');
							vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');		
						}
						else
						{
							if ($_FILES["filaLogoDoc"]["error"] > 0)
							{
								$errorTemporalLogo .= 'Error';
								vistaGestor::agregarErrorForm('filaLogoDoc', 'Surgió un error, intente nuevamente');
								vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');		
							}
						}
					}
					else
					{
						$errorTemporalLogo .= 'ERROR';
						vistaGestor::agregarErrorForm('filaLogoDoc', 'La imagen del logo extra debe ser formato JPG, JPEG o PNG');
						vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/noImagenLogo.jpg');			
					}
				}
				
				vistaGestor::agregarDiccionario('selected_logo_' . $_POST['accionLogoDoc'], 'selected="selected"');

				$errorTemporalFondo = '';
				$errorTemporalFondo .= validarCampo::validarSelect($_POST['accionFondoDoc'], 'accionLogoDoc', 'no');
				
				if($_POST['accionFondoDoc'] == 'cambiar')
				{
					if($_FILES["filaFondoDoc"]["type"] == "image/jpeg" or $_FILES["filaFondoDoc"]["type"] == "image/jpg" or $_FILES["filaFondoDoc"]["type"] == "image/png")
					{
						if($_FILES["filaFondoDoc"]["size"] > 1048576)
						{
							$errorTemporalFondo .= 'Error';
							vistaGestor::agregarErrorForm('filaFondoDoc', 'La imagen del fondo extra debe no puede ser mayor a 1 MB');
							vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
						}
						else
						{
							if ($_FILES["filaFondoDoc"]["error"] > 0)
							{
								$errorTemporalFondo .= 'Error';
								vistaGestor::agregarErrorForm('filaFondoDoc', 'Surgió un error, intente nuevamente');
								vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');					
							}
						}
					}
					else
					{
						$errorTemporalFondo .= 'ERROR';
						vistaGestor::agregarErrorForm('filaFondoDoc', 'La imagen del fondo debe ser formato JPG, JPEG o PNG');
						vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
					}
				}
				else
				{
					if(empty($certificado))
					{
						$errorTemporalFondo .= 'ERROR';
						vistaGestor::agregarErrorForm('filaFondoDoc', 'Debe cargar una imagen de fondo');
					}
				}

				vistaGestor::agregarDiccionario('selected_fondo_' . $_POST['accionFondoDoc'], 'selected="selected"');
				
				$errores .= $errorTemporalLogo;
				$errores .= $errorTemporalFondo;
				
				if(empty($errores))
				{
					$firmaFacilitador = $_POST['calificativoFacilitadorDoc'] . '(#=D=#)' . $_POST['cargoFacilitadorDoc'];

					$firmasExtras = '';
					
					if($_POST['numFirmasDoc'] != 0)
					{
						for($i = 1; $i <= $_POST['numFirmasDoc']; $i++)
						{
							$firmasExtras .= $_POST['calificativo' . $i . 'Doc'] . '(#=D=#)' . 
											$_POST['cargo' . $i . 'Doc'] . '(#=D=#)' . 
											$_POST['nombre' . $i . 'Doc'] . '(#=P=#)';
						}
					
						$firmasExtras = rtrim($firmasExtras, '(#=P=#)');
					}
					
					$codigoImagen = '_' . $curso->dameId() . '_' . $edicion->dameId();
					
					switch($_POST['accionLogoDoc']){
						case 'mantener':
							if(!empty($certificado)) {
								$nombreLogo = $certificado->dameLogoExtra();
							}
							else {
								$nombreLogo = 'ninguno';
							}
						break;
						
						case 'ninguno':
							array_map('unlink' , glob('recursos/certificados/logo' . $codigoImagen . '.*'));
							$nombreLogo = 'ninguno';
						break;
						
						case 'cambiar':
							array_map('unlink' , glob('recursos/certificados/logo' . $codigoImagen . '.*'));
							
							switch($_FILES["filaLogoDoc"]["type"]){						
							case 'image/jpg':
							case 'image/jpeg':						
								$logoExtraExtension = 'jpeg';
							break;
							case 'image/png':
								$logoExtraExtension = 'png';
							break;
							}
							
							$nombreLogo = 'logo' . $codigoImagen . '.' . $logoExtraExtension;
							
							move_uploaded_file(
										$_FILES["filaLogoDoc"]["tmp_name"], 
										'recursos/certificados/' . $nombreLogo);
						break;		
					}
					

					switch($_POST['accionFondoDoc']){
						case 'mantener':
							$nombreFondo = $certificado->dameFondo();
						break;
						
						case 'cambiar':
							array_map('unlink' , glob('recursos/certificados/fondo' . $codigoImagen . '.*'));
							
							switch($_FILES["filaFondoDoc"]["type"]){				
							case 'image/jpg':
							case 'image/jpeg':
								$fondoExtension = 'jpeg';
							break;
							case 'image/png':
								$fondoExtension = 'png';
							break;
							}

							$nombreFondo =  'fondo' . $codigoImagen . '.' . $fondoExtension;
							move_uploaded_file(
										$_FILES["filaFondoDoc"]["tmp_name"], 
										'recursos/certificados/' . $nombreFondo);
						break;		
					}
					
					if(!empty($certificado))
					{
						$certificadoActualizacion = new certificado(
										$certificado->dameId(),
										$firmaFacilitador ,
										$firmasExtras,
										$nombreFondo,
										$nombreLogo
										);
					}
					else
					{
						$certificadoActualizacion = new certificado(
										NULL,
										$firmaFacilitador ,
										$firmasExtras,
										$nombreFondo,
										$nombreLogo
										);
					}
					
					$certificadoActualizacion->actualizarCertificado($edicion->dameId());
					
					vistaGestor::agregarDiccionario('link_imagen_logo', 'recursos/certificados/' . $nombreLogo);
					vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/certificados/' . $nombreFondo);
					vistaGestor::agregarNotificacion('exito', 'Se ha modificado el certificado');
					
					self::_mostrarCertificadoPDF($curso, $edicion, $certificadoActualizacion);
				}
				else
				{
					self::_fromCrearCertificado();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _mostrarCertificadoPDF($curso, $edicion, $certificado)
		{
			$tituloCurso = $curso->dameNombre();
			$duracionEdicion = $edicion->dameDuracion();
			$fechaFinEdicion = invertirFecha($edicion->dameFechaFin());
			$fechaInicioEdicion = invertirFecha($edicion->dameFechaInicio());
		
			$fechaEdicion = $fechaInicioEdicion . ' ' . $fechaFinEdicion;
			
			$facilitador = $edicion->dameFacilitador();

			if(!empty($facilitador)){
				$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
			}
			else {
				$nombreFacilitador = 'Nombre del Facilitador';
			}
			
			$imprimir[] = array(
							'nombre' => 'Jose Maria Del Valle Perez',
							'documento' => '20123456',
							'tipo' => 'facilitador',
							'id' => '57');		
		
			//$certificado = $edicion->dameCertificado();
			$htmlPDF = $certificado->generarHtmlCertificado($imprimir, '10-23', $tituloCurso, $duracionEdicion, $fechaEdicion, $nombreFacilitador);

	
			vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
			vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
			vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
			vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
			vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
			

			if(!empty($facilitador))
			{				
				$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
			
				vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
			}
			else
			{
				vistaGestor::agregarDiccionario('nombreFacilitador', 'Sin asignar');
			}

			$nocachepdf = rand();
			generarPDF::cargarDocumento($htmlPDF, 'recursos/certificados/ejemplo' . $nocachepdf, 'guardar');
		
			vistaGestor::agregarDiccionario('link_continuar_pdf', '?ctrl=edicion&acc=menuEdic');
			vistaGestor::agregarDiccionario('link_modificar_pdf', '?ctrl=documento&acc=creaCert');
			vistaGestor::agregarDiccionario('link_documento_pdf', 'recursos/certificados/ejemplo' . $nocachepdf . '.pdf');
			
			vistaGestor::documentoNormal('Crear Certificado', array('vistas/certificado/informacionEdicion.html', 'vistas/certificado/mostrarDocumento.html'));
		}
		
		private function _crearIdentificador()
		{
		
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{
				$identificador = $edicion->dameIdentificador();

				if(!empty($identificador))
				{
					vistaGestor::agregarDiccionario(
											'link_imagen_fondo',
											'recursos/identificadores/' . $identificador->dameFondo()
											);
				}
				else
				{
					vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
				}
				
				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));

				$facilitador = $edicion->dameFacilitador();
				
				if(!empty($facilitador))
				{				
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
				
					vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				}
				else
				{
					vistaGestor::agregarDiccionario('nombreFacilitador', 'Sin asignar');
				}
	
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::documentoNormal('Crear Identificador', array('vistas/identificador/informacionEdicion.html', 'vistas/identificador/formIdentificador.html'));
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _guardarIdentificador()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
			if(!empty($edicion)){
				$identificador = $edicion->dameIdentificador();
			}
			
		
			if(!empty($curso) and !empty($edicion) and !empty($_POST) and $edicion->dameEstado() != 'bloqueada')
			{
				if($_FILES["filaFondoDoc"]["type"] == "image/jpeg" or $_FILES["filaFondoDoc"]["type"] == "image/jpg" or $_FILES["filaFondoDoc"]["type"] == "image/png")
				{
					if($_FILES["filaFondoDoc"]["size"] > 1048576)
					{
						$errorTemporalFondo .= 'Error';
						vistaGestor::agregarErrorForm('filaFondoDoc', 'La imagen del fondo extra debe no puede ser mayor a 1 MB');
						vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
					}
					else
					{
						if ($_FILES["filaFondoDoc"]["error"] > 0)
						{
							$errorTemporalFondo .= 'Error';
							vistaGestor::agregarErrorForm('filaFondoDoc', 'Surgió un error, intente nuevamente');
							vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');					
						}
					}
				}
				else
				{
					$errorTemporalFondo .= 'ERROR';
					vistaGestor::agregarErrorForm('filaFondoDoc', 'La imagen del fondo debe ser formato JPG, JPEG o PNG');
					vistaGestor::agregarDiccionario('link_imagen_fondo', 'recursos/noImagenFondo.jpg');
				}
				
				
				if(empty($errorTemporalFondo))
				{							
					switch($_FILES["filaFondoDoc"]["type"]){				
					case 'image/jpg':
					case 'image/jpeg':
						$fondoExtension = 'jpeg';
					break;
					case 'image/png':
						$fondoExtension = 'png';
					break;
					}
					
					$codigoImagen = '_' . $curso->dameId() . '_' . $edicion->dameId();
					
					$nombreFondo =  'fondo' . $codigoImagen . '.' . $fondoExtension;

					$nombreLogoSinExtension = 'fondo' . $codigoImagen;
					array_map('unlink' , glob('recursos/identificadores/fondo' . $codigoImagen . '.*'));
					
					move_uploaded_file(
								$_FILES["filaFondoDoc"]["tmp_name"], 
								'recursos/identificadores/' . $nombreFondo);
								
					if(!empty($identificador))
					{
						$identificadorActualizacion = new identificador(
										$identificador->dameId(),
										$nombreFondo
										);
					}
					else
					{
						$identificadorActualizacion = new identificador(
										NULL,
										$nombreFondo
										);
					}
					
					$identificadorActualizacion->actualizarIdentificador($edicion->dameId());
					self::_mostrarIdentificadorPDF($curso, $edicion, $identificadorActualizacion);
				}
				else
				{
					self::_crearIdentificador();
				}
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		
		private function _mostrarIdentificadorPDF($curso, $edicion, $identificador)
		{
			$nombreCurso = $curso->dameNombre();
			$duracionEdicion =  $edicion->dameDuracion();
			$fechaFinEdicion = invertirFecha($edicion->dameFechaFin());
			
			$imprimir[] = array('nombre' => 'Juan Pedro Perez Soto', 'documento' => '20123456', 'tipo' => 'Participante');
		
			$htmlPDF = $identificador->htmlIdentificadorImprimir($imprimir, $nombreCurso, $duracionEdicion, $fechaFinEdicion);
		
			vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
			vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
			vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
			vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
			vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
			
			$nocachepdf = rand();
			generarPDF::cargarDocumento($htmlPDF, 'recursos/identificadores/ejemplo' . $nocachepdf, 'guardar');
		
			vistaGestor::agregarDiccionario('link_continuar_pdf', '?ctrl=edicion&acc=menuEdic');
			vistaGestor::agregarDiccionario('link_modificar_pdf', '?ctrl=documento&acc=creaIden');
			vistaGestor::agregarDiccionario('link_documento_pdf', 'recursos/identificadores/ejemplo' . $nocachepdf . '.pdf');
			
			vistaGestor::documentoNormal('Crear Identificador', array('vistas/identificador/informacionEdicion.html', 'vistas/identificador/mostrarDocumento.html'));
		}
		
		private function _imprimirIdentificadores()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion) and $edicion->dameEstado() != 'bloqueada')
			{			
				$error = '';
			
				$facilitador = $edicion->dameFacilitador();
				$identificador = $edicion->dameIdentificador();
				$colParticipantes = $edicion->dameColParticipantes();
				
				if(!empty($identificador))
				{
					if(!empty($colParticipantes))
					{
						if(empty($facilitador))
						{
							$error = 'facilitador';
							vistaGestor::agregarNotificacionPermanente('alerta', 'Debe registrar el Facilitador del Curso/Taller');
						}
					}
					else
					{
						$error = 'participante';
						vistaGestor::agregarNotificacionPermanente('alerta', 'Debe registrar los participantes del Curso/Taller');
					}
				}
				else
				{
					$error = 'identificador';
					vistaGestor::agregarNotificacionPermanente('alerta', 'Debe crear el identificador para el Curso/Taller');
				}

				$titulos = array('Nombre', 'Apellido', 'Documento', 'Opcion');
				$linkBase = '?ctrl=curso&acc=buscCurso';
				
				$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag'], $edicion->dameLimite());
				
				if(empty($error))
				{
					vistaGestor::agregarDiccionario('boton_imprimir_documento', '<input type="submit" id="btn_imprimir" name="btn_imprimir" value="Imprimir">');
				}

				if(!empty($colParticipantes))
				{
					if(!empty($facilitador))
					{
						$listadoGenerador->agregarFila(
						array (
								'<b>Facilitador: </b> ' . $facilitador->dameNombre(),
								$facilitador->dameApellido(),
								$facilitador->dameDocumento(),
								'<select name="imprimir_facilitador" name="imprimir_participante">
									<option value="no_' . $facilitador->dameId() . '">No imprimir</option>
									<option value="si_' . $facilitador->dameId(). '">Imprimir</option>
								</select>'
								)
						, '');
					}
					
					foreach($colParticipantes as $participante)
					{
						$select = 'Hay errores';
						
						if(empty($error))
						{
							$select = 	'<select name="imprimir_participante[]" name="imprimir_participante[]">
										<option value="no_' . $participante->dameId() . '">No imprimir</option>
										<option value="si_' . $participante->dameId() . '">Imprimir</option>
									</select>';
						}
						
						$listadoGenerador->agregarFila(
							array (
									$participante->dameNombre(),
									$participante->dameApellido(),
									$participante->dameDocumento(),
									$select
									)
							, '');
					}
				}

				$htmlListado = $listadoGenerador->generarListado();
				
				if(!empty($facilitador)) {
					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();
				}
				else {
					$nombreFacilitador = "Sin asignar";
				}

				vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
				vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());
				
				vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
				vistaGestor::agregarDiccionario('link_imprimir_documento', '?ctrl=documento&acc=geneIden');
				
				vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
				vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
				vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
				vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
				vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
				vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
				
				vistaGestor::agregarArchivoCss('listados');
				vistaGestor::documentoNormal('Imprimir identificadores', array('vistas/edicion/datosEdicion.html', 'vistas/documento/imprimirIdentificador.html'));
			}
			else
			{
				self::_regresarPrincipal();
			}
		}
		
		private function _generarIdentificadores()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion) and !empty($_POST) and $edicion->dameEstado() != 'bloqueada')
			{
				$identificador = $edicion->dameIdentificador();
				$facilitador = $edicion->dameFacilitador();
				$colParticipantes = $edicion->dameColParticipantes();
				
				if(!empty($facilitador) AND !empty($identificador) AND !empty($colParticipantes))
				{
					$existeSi = 0;				
				
					list($preguntaF, $idF) = explode('_', $_POST['imprimir_facilitador']);
					
					if($preguntaF == 'si'){
						
						$nombre = $facilitador->dameNombre();
						$apellido = $facilitador->dameApellido();
						
						$nombreCompleto = $nombre . ' ' . $apellido;
						$documento = $facilitador->dameDocumento();

						$imprimir[] = array('nombre' => $nombreCompleto, 'documento' => $documento, 'tipo' => 'Facilitador');
						
						$existeSi++;
					}
				
					foreach($_POST['imprimir_participante'] as $valor)
					{				
						list($pregunta, $id) = explode('_', $valor);
						
						if($pregunta == 'si')
						{
							$participante = $edicion->buscarParticipante($id);
							
							if($participante != NULL)
							{
								$nombre = $participante->dameNombre();
								$apellido = $participante->dameApellido();
								
								$nombreCompleto = $nombre . ' ' . $apellido;
								$documento = $participante->dameDocumento();

								$imprimir[] = array('nombre' => $nombreCompleto, 'documento' => $documento, 'tipo' => 'Participante');
							}
							
							$existeSi++;
						}
					}
					
					if($existeSi != 0)
					{
						$nombreCurso = $curso->dameNombre();
						$duracionEdicion = $edicion->dameDuracion();
						$fechaEdicion = invertirFecha($edicion->dameFechaInicio()) . ' al '. invertirFecha($edicion->dameFechaFin());
		
						$HTML = $identificador->htmlIdentificadorImprimir($imprimir, $nombreCurso, $duracionEdicion, $fechaEdicion);
						
						generarPDF::cargarDocumento($HTML, 'Identificadores', 'descargar');
					}
					else
					{
						vistaGestor::agregarNotificacion('alerta', 'Debe seleccionar al menos una impresion');
						self::_imprimirIdentificadores();
					}
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
		
		private function _imprimirCertificados()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion))
			{
				$error = '';
			
				$facilitador = $edicion->dameFacilitador();
				$certificado = $edicion->dameIdentificador();
				$colParticipantes = $edicion->dameColParticipantes();
				$identificador = $edicion->dameIdentificador();
				
				if(
					!empty($facilitador) and !empty($certificado) and !empty($identificador) 
					and $edicion->cuposEdicion() < $edicion->dameLimite() and
					$edicion->dameEstado() == 'bloqueada'
					)
				{
					$titulos = array('Nombre', 'Apellido', 'Documento', 'Opcion');
					$linkBase = '#';
					
					$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag'], $edicion->dameLimite());
					
					vistaGestor::agregarDiccionario('boton_imprimir_documento', '<input type="submit" id="btn_imprimir" name="btn_imprimir" value="Imprimir">');
					
					$listadoGenerador->agregarFila(
					array (
							'<b>Facilitador: </b> ' . $facilitador->dameNombre(),
							$facilitador->dameApellido(),
							$facilitador->dameDocumento(),
							'<select name="imprimir_facilitador" name="imprimir_participante">
								<option value="no_' . $facilitador->dameId() . '">No imprimir</option>
								<option value="si_' . $facilitador->dameId(). '">Imprimir</option>
							</select>'
							)
					, '');
					
					$datosRelacionados = $edicion->dameRelacionParticipantes();
					
					foreach($datosRelacionados as $valores)
					{
						$idTemporar = $valores['id_persona'];
						$tipoImpresion[$idTemporar] = $valores['estado'];
					}
					
					foreach($colParticipantes as $participante)
					{
						$tipoImpresionPersona = $tipoImpresion[$participante->dameId()];
					
						if($tipoImpresionPersona != 0 or $tipoImpresionPersona == 'facilitador' or $tipoImpresionPersona == 'participacion')
						{
							$select = '<select name="imprimir_participante[]" name="imprimir_participante[]">
								<option value="no_' . $participante->dameId() . '">No imprimir</option>
								<option value="si_' . $participante->dameId() . '">Imprimir</option>
							</select>';
						}
						else
						{
							$select = 'No curso';
						}
					
						$listadoGenerador->agregarFila(
							array (
									$participante->dameNombre(),
									$participante->dameApellido(),
									$participante->dameDocumento(),
									$select
									)
							, '');
					}

					$htmlListado = $listadoGenerador->generarListado();

					$nombreFacilitador = $facilitador->dameNombre() . ' ' . $facilitador->dameApellido();

					vistaGestor::agregarDiccionario('nombreFacilitador', $nombreFacilitador);
					vistaGestor::agregarDiccionario('horarioEdicion', $edicion->dameHorario());
					
					vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
					vistaGestor::agregarDiccionario('link_imprimir_documento', '?ctrl=documento&acc=geneCert');
					
					vistaGestor::agregarDiccionario('nombreCurso', $curso->dameNombre());
					vistaGestor::agregarDiccionario('tipoEdicion', $edicion->dameTipoLegible());
					vistaGestor::agregarDiccionario('duracionEdicion', $edicion->dameDuracion());
					vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($edicion->dameFechaInicio()));
					vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($edicion->dameFechaFin()));
					vistaGestor::agregarDiccionario('cuposEdicion', $edicion->cuposEdicion() . ' / ' . $edicion->dameLimite());
					
					vistaGestor::agregarArchivoCss('listados');
					vistaGestor::documentoNormal('Imprimir certificados', array('vistas/edicion/datosEdicion.html', 'vistas/documento/imprimirIdentificador.html'));
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
		
		private function _generarCertificados()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion) and !empty($_POST))
			{
				$certificado = $edicion->dameCertificado();
				$facilitador = $edicion->dameFacilitador();
				$colParticipantes = $edicion->dameColParticipantes();
				
				if(!empty($facilitador) AND !empty($certificado) AND !empty($colParticipantes) 
					AND $edicion->dameEstado() == 'bloqueada')
				{
					$existeSi = 0;
				
					list($preguntaF, $idF) = explode('_', $_POST['imprimir_facilitador']);
					
					$nombre = $facilitador->dameNombre();
					$apellido = $facilitador->dameApellido();
						
					$nombreCompletoFacilitador = $nombre . ' ' . $apellido;
					
					if($preguntaF == 'si') {
						
						$nombre = $facilitador->dameNombre();
						$apellido = $facilitador->dameApellido();
						
						$nombreCompleto = $nombre . ' ' . $apellido;
						$documento = $facilitador->dameDocumento();

						$idPersona = $facilitador->dameId();

						$imprimir[] = array('nombre' => $nombreCompleto, 'documento' => $documento, 'tipo' => 'facilitador', 'id' => $idPersona);

						$existeSi++;
					}
					
					$datosRelacionados = $edicion->dameRelacionParticipantes();
					
					foreach($datosRelacionados as $valores)
					{
						$idTemporar = $valores['id_persona'];
						$tipoImpresion[$idTemporar] = $valores['estado'];
					}

					foreach($_POST['imprimir_participante'] as $valor)
					{
						list($pregunta, $idPersona) = explode('_', $valor);
						
						if($pregunta == 'si')
						{
							$participante = $edicion->buscarParticipante($idPersona);
							
							if($participante != NULL)
							{
								$nombre = $participante->dameNombre();
								$apellido = $participante->dameApellido();
								
								$nombreCompleto = $nombre . ' ' . $apellido;
								$documento = $participante->dameDocumento();

								$imprimir[] = array('nombre' => $nombreCompleto, 'documento' => $documento, 
								'tipo' => $tipoImpresion[$idPersona], 'id' => $idPersona);
								
								$existeSi++;
							}
							
						}
					}
					
					if($existeSi != 0)
					{
						$codigoGenerado = $curso->dameId() . '-' . $edicion->dameId();


						$nombreCurso = $curso->dameNombre();
						$duracionEdicion = $edicion->dameDuracion();
						$fechaEdicion = invertirFecha($edicion->dameFechaInicio()) . ' al '. invertirFecha($edicion->dameFechaFin());
						
						$HTML = $certificado->generarHtmlCertificado
											(
											$imprimir, $codigoGenerado, $nombreCurso,
											$duracionEdicion, $fechaEdicion, $nombreCompletoFacilitador
											);
	
						generarPDF::cargarDocumento($HTML, 'Certificados', 'descargar');
					}
					else
					{
						vistaGestor::agregarNotificacion('alerta', 'Debe seleccionar al menos una impresi&oacute;n');
						self::_imprimirCertificados();
					}					
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

		
		private function _imprimirListadoParticipantes()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion))
			{
				$facilitador = $edicion->dameFacilitador();
				$colParticipantes = $edicion->dameColParticipantes();
				
				if(!empty($facilitador) AND !empty($colParticipantes))
				{
					$titulos = array('Nombre', 'Apellido', 'Documento');
					$linkBase = '';
					$_GET['pag'] = '';
					
					$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag']);
					
					if(!empty($colParticipantes))
					{
						foreach($colParticipantes as $participante)
						{
								$listadoGenerador->agregarFila(
								array (
										$participante->dameNombre(),
										$participante->dameApellido(),
										$participante->dameDocumento()
										)
								, '');
						}
					}
	
					$htmlListado = $listadoGenerador->generarListado();
					
					$cabecera = '
					<img width="710px" height="60px" src="media/imagenes/barra_n.png"/>
					<div class="sub_titulo">Informaci&oacute;n de la edici&oacute;n</div>
						<table>
							<tr>								
								<td><label>Curso/Taller</label></td>	
								<td><label>Tipo</label></td>	
								<td><label>Duraci&oacute;n</label></td>	
								<td><label>Inicio</label></td>	
								<td><label>Final</label></td>	
							</tr>
							
							<tr>
								<td><p>' . $curso->dameNombre() . '</p></td>
								<td><p>' . $edicion->dameTipoLegible() . '</p></td>
								<td><p>' . $edicion->dameDuracion() . '</p></td>
								<td><p>' . invertirFecha($edicion->dameFechaInicio()) . '</p></td>
								<td><p>' . invertirFecha($edicion->dameFechaFin()) . '</p></td>
							</tr>
					</table>
					<table>
							<tr>
								<td><label>Facilitador</label></td>	
								<td><label>Horario</label></td>	
							</tr>
							<tr>	
								<td><p>' . $facilitador->dameNombre() . ' ' . $facilitador->dameApellido() . '</p></td>
								<td><p>' . $edicion->dameHorario() . '</p></td>
							</tr>
						</table>';
					
					
					
					$htmlPDF = '<html><head><style type="text/css">
					* {
						font-family: impact;
					}
					
					.sub_titulo {
						font-weight: bold;
						color: #9EC630;
						font-size: 18px;
					}
					
					p {
					margin: 0px;
					padding: 0px;
					font-weight: bold;
					}
					
					label {
					color: #4682B4;
					margin: 0px;
					padding: 0px;
					font-weight: bold;
					}
					
					table {
					width: 100%;
					}
					
					table td {
						height: 16px;
					}
					
					table.tabla_listado {
						border: 2px solid #999999;
						/* border-collapse: collapse; */
					}
					
					table.tabla_listado * {
						text-align: center;
					}
					
					table.tabla_listado th,
					table.tabla_listado td {
						padding: 4px;
						border: 1px solid #c0c0c0;
					}
					table.tabla_listado thead * {
						color: #FFF;
						font-weight: bold;
					}
					table.tabla_listado caption {
						font-size: 20px;
						font-weight: bold;
						margin: 5px;
						color: #2872b9;
					}
					table.tabla_listado thead th {
						background: #D3D3D3;
						color: #404040;
						Sbackground: linear-gradient(to bottom, #5b8bb7 40%,#2872b9 100%);
					}
					table.tabla_listado tbody tr {
						background: #FFF; 
					}
					table.tabla_listado tbody tr.listo {
						background: #d3dfef; 
					}
					table.tabla_listado tbody td a img {
						float: left;
					}
					table.tabla_listado tbody td {
						font-size: 12px;
						color: #000;
						text-align: center;
					}
					</style></head>
					<body>
					' . $cabecera . '
					<br/><br/>
					<div class="sub_titulo">Participantes</div>
					' . $htmlListado . '
					</body>
					</html>';

					
					generarPDF::cargarDocumento($htmlPDF, 'Listado', 'descargar', 'vertical');
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
		
		private function _imprimirListadoAsistencia()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion))
			{
				$facilitador = $edicion->dameFacilitador();
				$colParticipantes = $edicion->dameColParticipantes();
				
				if(!empty($facilitador) AND !empty($colParticipantes))
				{
					$titulos = array('Nombre', 'Apellido', 'Documento', 'Firma');
					$linkBase = '';
					$_GET['pag'] = '';
					
					$listadoGenerador = new listadoGenerador($colParticipantes, $titulos, $linkBase, $_GET['pag']);
					
					if(!empty($colParticipantes))
					{
						foreach($colParticipantes as $participante)
						{
								$listadoGenerador->agregarFila(
								array (
										$participante->dameNombre(),
										$participante->dameApellido(),
										$participante->dameDocumento(),
										''
										)
								, '');
						}
					}
	
					$htmlListado = $listadoGenerador->generarListado();
					
					$cabecera = '
					<img width="710px" height="60px" src="media/imagenes/barra_n.png"/>
					<div class="sub_titulo">Informaci&oacute;n de la edici&oacute;n</div>
						<table>
							<tr>								
								<td><label>Curso/Taller</label></td>	
								<td><label>Tipo</label></td>	
								<td><label>Inicio</label></td>	
								<td><label>Final</label></td>	
							</tr>
							
							<tr>
								<td><p>' . $curso->dameNombre() . '</p></td>
								<td><p>' . $edicion->dameTipoLegible() . '</p></td>
								<td><p>' . invertirFecha($edicion->dameFechaInicio()) . '</p></td>
								<td><p>' . invertirFecha($edicion->dameFechaFin()) . '</p></td>
							</tr>
							<tr>
								<td><label>Facilitador</label></td>	
								<td><label>Fecha actual</label></td>	
							</tr>
							<tr>	
								<td><p>' . $facilitador->dameNombre() . ' ' . $facilitador->dameApellido() . '</p></td>
								<td>___/___/_____</td>
							</tr>
						</table>';
					
					
					
					$htmlPDF = '<html><head><style type="text/css">
					* {
						font-family: impact;
					}
					
					.sub_titulo {
						font-weight: bold;
						color: #9EC630;
						font-size: 18px;
					}
					
					p {
					margin: 0px;
					padding: 0px;
					font-weight: bold;
					}
					
					label {
					color: #4682B4;
					margin: 0px;
					padding: 0px;
					font-weight: bold;
					}
					
					table {
					width: 100%;
					}
					
					table td {
						height: 16px;
					}
					
					table.tabla_listado {
						border: 2px solid #999999;
						/* border-collapse: collapse; */
					}
					
					table.tabla_listado * {
						text-align: center;
					}
					
					table.tabla_listado th,
					table.tabla_listado td {
						padding: 4px;
						border: 1px solid #c0c0c0;
					}
					table.tabla_listado thead * {
						color: #FFF;
						font-weight: bold;
					}
					table.tabla_listado caption {
						font-size: 20px;
						font-weight: bold;
						margin: 5px;
						color: #2872b9;
					}
					table.tabla_listado thead th {
						background: #D3D3D3;
						color: #404040;
						Sbackground: linear-gradient(to bottom, #5b8bb7 40%,#2872b9 100%);
					}
					table.tabla_listado tbody tr {
						background: #FFF; 
					}
					table.tabla_listado tbody tr.listo {
						background: #d3dfef; 
					}
					table.tabla_listado tbody td a img {
						float: left;
					}
					table.tabla_listado tbody td {
						font-size: 12px;
						color: #000;
						text-align: center;
					}
					</style></head>
					<body>
					' . $cabecera . '
					<br/><br/>
					<div class="sub_titulo">Asistencias</div>
					' . $htmlListado . '
					</body>
					</html>';

					
					generarPDF::cargarDocumento($htmlPDF, 'Listado', 'descargar', 'vertical');
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
		
		private function _imprimirCulminacion()
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
					
					$facilitador = $edicion->dameFacilitador();
					$colParticipantes = $edicion->dameColParticipantes();
					$_GET['pag'] = '';
					
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
							$datoTipo = 'No curso';
						}
						elseif($miTipoCulminacion > 0)
						{
							$datoTipo = $miTipoCulminacion;
						}
						elseif($miTipoCulminacion == 0)
						{
							$datoTipo = 'No curso';
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
					
					
					
					$cabecera = '
					<img width="710px" height="60px" src="media/imagenes/barra_n.png"/>
					<div class="sub_titulo">Informaci&oacute;n de la edici&oacute;n</div>
						<table>
							<tr>								
								<td><label>Curso/Taller</label></td>	
								<td><label>Tipo</label></td>	
								<td><label>Inicio</label></td>	
								<td><label>Final</label></td>	
							</tr>
							
							<tr>
								<td><p>' . $curso->dameNombre() . '</p></td>
								<td><p>' . $edicion->dameTipoLegible() . '</p></td>
								<td><p>' . invertirFecha($edicion->dameFechaInicio()) . '</p></td>
								<td><p>' . invertirFecha($edicion->dameFechaFin()) . '</p></td>
							</tr>
							<tr>
								<td><label>Facilitador</label></td>	
								<td><label>Fecha actual</label></td>	
							</tr>
							<tr>	
								<td><p>' . $facilitador->dameNombre() . ' ' . $facilitador->dameApellido() . '</p></td>
								<td>___/___/_____</td>
							</tr>
						</table>';
					
					
					
					$htmlPDF = '<html><head><style type="text/css">
					
					* {
						font-family: impact;
					}
					
					.sub_titulo {
						font-weight: bold;
						color: #9EC630;
						font-size: 18px;
					}
					
					p {
					margin: 0px;
					padding: 0px;
					font-weight: bold;
					}
					
					label {
					color: #4682B4;
					margin: 0px;
					padding: 0px;
					font-weight: bold;
					}
					
					table {
					width: 100%;
					}
					
					table td {
						height: 16px;
					}
					
					table.tabla_listado {
						border: 2px solid #999999;
						/* border-collapse: collapse; */
					}
					
					table.tabla_listado * {
						text-align: center;
					}
					
					table.tabla_listado th,
					table.tabla_listado td {
						padding: 4px;
						border: 1px solid #c0c0c0;
					}
					table.tabla_listado thead * {
						color: #FFF;
						font-weight: bold;
					}
					table.tabla_listado caption {
						font-size: 20px;
						font-weight: bold;
						margin: 5px;
						color: #2872b9;
					}
					table.tabla_listado thead th {
						background: #D3D3D3;
						color: #404040;
						Sbackground: linear-gradient(to bottom, #5b8bb7 40%,#2872b9 100%);
					}
					table.tabla_listado tbody tr {
						background: #FFF; 
					}
					table.tabla_listado tbody tr.listo {
						background: #d3dfef; 
					}
					table.tabla_listado tbody td a img {
						float: left;
					}
					table.tabla_listado tbody td {
						font-size: 12px;
						color: #000;
						text-align: center;
					}
					</style></head>
					<body>
					' . $cabecera . '
					<br/><br/>
					<div class="sub_titulo">Asistencias</div>
					' . $htmlListado . '
					</body>
					</html>';

					
					generarPDF::cargarDocumento($htmlPDF, 'Listado', 'descargar', 'vertical');
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
		
		
		private function _imprimirReverso()
		{
			$curso = curso::cargarCurso($_SESSION['formulario']['idCurso']);
			if(!empty($curso)){
				$edicion = $curso->seleccionarEdicion($_SESSION['formulario']['idEdicion']);
			}
	
			if(!empty($curso) and !empty($edicion))
			{
				if($edicion->dameEstado() == 'bloqueada')
				{
					$miSinoptico = $edicion->dameSinoptico();
					
					$miSinoptico = preg_replace('/(á)/', '&aacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(é)/', '&eacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(í)/', '&iacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(ó)/', '&oacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(ú)/', '&uacute;', $miSinoptico);
					
					$miSinoptico = preg_replace('/(Á)/', '&Aacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(É)/', '&Eacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(Í)/', '&Iacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(Ó)/', '&Oacute;', $miSinoptico);
					$miSinoptico = preg_replace('/(Ú)/', '&Uacute;', $miSinoptico);
					
					$miSinoptico = nl2br($miSinoptico);
				
					$todoMiSinoptico = '<html>
						<head>
							<style type="text/css">
							body div * {
								font-family: kartika;
								font-weight: bold;
								color: #9EC630;
								font-size: 32px;
								text-align: center;
							}
							</style>
						</head>
						<body>
							<div>
							<font size="36"><b>CONTENIDO: </font></b><br/>
								' . $miSinoptico . '
							</div>
						</body>
					</html>';
	
					generarPDF::cargarDocumento($todoMiSinoptico, 'Reverso', 'descargar');
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
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	