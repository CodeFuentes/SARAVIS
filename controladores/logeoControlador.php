<?php

require_once 'modelos/curso.php';
require_once 'modelos/edicion.php';
require_once 'modelos/logeo.php';
require_once 'modelos/contacto.php';

	class logeoControlador
	{
		static public function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'guarRegi':
					self::_guardarRegistro();
				break;

				case 'solicitar':
					self::_solicitarAcceso();
				break;

				case 'mostrar': 
				
					self::_mostrarLogeo();
					
				break;

				case 'iniciar':

					self::_iniciarSession();

				break;

				case 'pasados':
					self::_pasados();
					break;

				case 'proximos':
					self::_proximos();
					break;


				default:

					self::_mostrarLogeo();

				break;
			}
		}

		public function _guardarRegistro(){
			$asunto = $_POST['asunto'];
			$mensaje = $_POST['mensaje'];
			$correo = $_POST['correo'];
			$contacto = new contacto($asunto, $mensaje, $correo,'','','');
			$resultado = $contacto->enviarCorreo();
			echo $resultado;
		}

		public function _solicitarAcceso(){
			$asunto = $_POST['asunto'];
			$mensaje = $_POST['mensaje'];
			$correo = $_POST['correo'];
			$contacto = new contacto($asunto, $mensaje, $correo,'','','');
			$resultado = $contacto->solicitarAcceso();
			echo $resultado;
		}

		private function _mostrarLogeo()
		{
			if(logeo::sistemaBloquedoIntentos())
			{
				self::_mostrarIntentosMaximos();
			}
			else
			{
				self::_mostrarFormInicioSession();
			}
		}

		public function _pasados(){
			$array = edicion::eventosPasados();
			return $array;
		}

		public function _proximos(){
			$arrayCursos = edicion::eventosProximos();
			$titulos = array('Curso','Descripci&oacute;n','Tipo', 'Duracion', 'Inicio', 'Final');
				$linkBase = '?ctrl=curso&acc=proximos';
					
				$listadoGenerador = new listado($arrayCursos, $titulos, $linkBase);
					

			$htmlListado = $listadoGenerador->eventosPasados();
	
			vistaGestor::agregarDiccionario('htmlListado1', $htmlListado);		
			vistaGestor::agregarArchivoCss('formularios');
		}
		
		private function _mostrarFormInicioSession()
		{
			// vistaGestor::agregarArchivoCss('formularios');
			// vistaGestor::agregarArchivoCss('indexModificador');
				$arrayCursos = edicion::eventosPasados();

				$titulos = array('Curso/Taller', 'Fecha');
				$linkBase = '?ctrl=curso&acc=historial';
					
				$listadoGenerador = new listado($arrayCursos, $titulos, $linkBase, 0, 1);
					
					if(!empty($arrayCursos))
					{	
						$i = 0;

						foreach($arrayCursos as $edicion)
						{	
							if ($i == 5) break;			
							$facilitador = $edicion->dameFacilitador();
							
							if(!empty($facilitador))
							{
								$nombreFacilitador = $facilitador->dameNombre();
							}
							else
							{
								$nombreFacilitador = 'No asignado';
							}
							
							$listadoGenerador->agregarFila(
								array (
										$edicion->dameNombreCurso(),
										invertirFecha($edicion->dameFechaInicio()),
										
										
										)
								, '');

							$i++;
						}
					}

			$htmlListado = $listadoGenerador->listado();
			
			vistaGestor::agregarDiccionario('htmlListado', $htmlListado);	

			
			$arrayCursos = edicion::eventosProximos();

				$titulos = array('Curso/Taller', 'Fecha');
				$linkBase = '?ctrl=curso&acc=historial';
					
				$listadoGenerador = new listado($arrayCursos, $titulos, $linkBase, 0, 1);
					
					if(!empty($arrayCursos))
					{	
						$i = 0;

						foreach($arrayCursos as $edicion)
						{	
							if ($i == 5) break;			
							$facilitador = $edicion->dameFacilitador();
							
							if(!empty($facilitador))
							{
								$nombreFacilitador = $facilitador->dameNombre();
							}
							else
							{
								$nombreFacilitador = 'No asignado';
							}
							
							$listadoGenerador->agregarFila(
								array (
										$edicion->dameNombreCurso(),
										invertirFecha($edicion->dameFechaFin()),
										
										)
								, '');

							$i++;
						}
					}

			$htmlListado = $listadoGenerador->listado();
			
			vistaGestor::agregarDiccionario('htmlListado1', $htmlListado);	

			vistaGestor::documentoNormal('', array('vistas/logeo/formInicioSession.html', 'vistas/logeo/portada.html'));
		}
		
		private function _mostrarIntentosMaximos()
		{
		
			// vistaGestor::agregarArchivoCss('indexModificador');
			
			vistaGestor::agregarDiccionario('segundosBloqueados', ($_SESSION['logeoCtrl']['tiempo'] - time()));
			
			vistaGestor::agregarErrorForm('usuarioClave', 'El logeo se ha bloqueado por ' . ($_SESSION['logeoCtrl']['tiempo'] - time()) . ' segundos');
			echo ($_SESSION['logeoCtrl']['tiempo'] - time());
			
			vistaGestor::agregarRedicionar('./', ($_SESSION['logeoCtrl']['tiempo'] - time()));
					// echo "hola";
			
			self::_mostrarFormInicioSession();
		}
		
		private function _mostrarUsuarioBloquedo()
		{
			vistaGestor::agregarErrorForm('usuarioClave', 'Su cuenta de usuario ha sido bloqueada, por favor comuníquese con el administrador.');

			self::_mostrarFormInicioSession();
		}
		
		private function _iniciarSession()
		{
			$id = logeo::existeUsuario($_POST['usuario'], $_POST['clave']);

			switch($id)
			{
				case 'errorUsuario':
				echo 0;	
					// vistaGestor::agregarErrorForm('usuarioClave', 'El usuario no existe o los datos son incorrectos');
					
					// logeo::usuarioErroneo();					
					// self::_mostrarLogeo();					
				break;
				
				case 'errorCampos':
				echo 0;
				//	self::_mostrarLogeo();
					
					
				break;
			
				case ($id > 0):

					$usuarioObjeto = logeo::cargarUsuario($id);
					
					if(!logeo::usuarioBloquado($usuarioObjeto))
					{
						logeo::cargarSession($usuarioObjeto);
						
						
						echo 1;
						die();
					}
					else
					{
						self::_mostrarUsuarioBloquedo();
					}

				break;
				default: 
					break;
			}

		}

	}