<?php

require_once 'modelos/usuario.php';

	class usuarioControlador
	{
		function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'listUsua': 
					index::permitirAcceso('admin');
					self::_listadoUsuarios();	
				break;

				case 'regiUsua':
					index::permitirAcceso('admin');
					self::_formularioRegistro();	
				break;

				case 'guarUsua':
					index::permitirAcceso('admin');
					self::_guardarRegistro();	
				break;

				case 'modiUsua': 
					index::permitirAcceso('admin');
					self::_formularioModificar();	
				break;
				
				case 'guarModi': 
					index::permitirAcceso('admin');
					self::_guardarModificar();	
				break;

				case 'cambEsta': 
					index::permitirAcceso('admin');
					self::_cambiarEstado();	
				break;

				case 'guarEsta': 
					index::permitirAcceso('admin');
					self::_guardarEstado();	
				break;

				case 'cambClav':
					self::_cambiarClave();	
				break;

				case 'guarClav': 
					self::_guardarClave();	
				break;

				case 'restClav': 
					index::permitirAcceso('admin');
					self::_restablecerClave();	
				break;

				case 'guarRest': 
					index::permitirAcceso('admin');
					self::_guardarRestablecer();	
				break;

				default:				
					self::_inicioCopia();
				break;
			}
		}
		
		private function _inicioCopia()
		{
			vistaGestor::documentoNormal('Bienvenido', array('vistas/inicio/bienvenida.html'));
		}
		
		private function _cambiarClave()
		{
			$usuario = usuario::cargarUsuario($_SESSION['session']['id']);
		
			if(!empty($usuario))
			{				
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::documentoNormal('Cambiar contraseña', array('vistas/usuario/formClave.html'));
			}
			else
			{
				self::_inicioCopia();
			}
		}
		
		private function _guardarClave()
		{
			$usuario = usuario::cargarUsuario($_SESSION['session']['id']);
		
			if(!empty($usuario))
			{
				$errores .= validarCampo::validarDato($_POST['claveAnterior'], 'claveAnterior', 'ALFANUMERICO', 'no', '6-16');
				$errores .= validarCampo::validarDato($_POST['claveUno'], 'claveUno', 'ALFANUMERICO', 'no', '6-16');
				$errores .= validarCampo::validarDato($_POST['claveDos'], 'claveDos', 'ALFANUMERICO', 'no', '6-16');

				if(empty($errores)) {
					if($_POST['claveUno'] != $_POST['claveDos']) {
						vistaGestor::agregarErrorForm('claveUno', 'Las claves no coinciden');
						$errores = 'ERROR';
					}
					
					if($usuario->dameClave() != $_POST['claveAnterior']) {
						vistaGestor::agregarErrorForm('claveAnterior', 'Las clave anterior es incorrecta');
						$errores = 'ERROR';
					}
				}
				
				if(empty($errores))
				{
					$usuario->cambiarClave($_POST['claveUno']);
					vistaGestor::agregarNotificacion('exito', 'Se ha cambiado la clave con éxito');
					self::_inicioCopia();
				}
				else
				{
					self::_cambiarClave();
				}
			}
			else
			{
				self::_inicioCopia();
			}
		}
		
		private function _cambiarEstado()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idUsuaario'] = $_GET['id'];
			}

			$usuario = usuario::cargarUsuario($_SESSION['formulario']['idUsuaario']);
		
			if(!empty($usuario))
			{
				if($usuario->dameEstado() != 'restablecer')
				{
					$miEstadoUsuario = $usuario->dameEstado();
					$miEstadoUsuario = ucfirst($miEstadoUsuario);
				}
				else
				{
					$miEstadoUsuario = 'Clave restablecida';
				}
			
				vistaGestor::agregarDiccionario('datoNombre', $usuario->dameNombre());
				vistaGestor::agregarDiccionario('datoUsuario', $usuario->dameUsuario());
				vistaGestor::agregarDiccionario('datoEstado', $miEstadoUsuario);
				
				
				if($usuario->dameEstado() == 'activo' OR $usuario->dameEstado() == 'restablecer')
				{		
					$mesanjeEstado = 'El usuario se encuentra activo ¿Desea bloquearlo?';
					$palabraAccion = 'Bloquear Usuario';
					$iconoAccion = 'bloquear';
				}
				else
				{
					$mesanjeEstado = 'El usuario se encuentra bloqueado ¿Desea activarlo?';
					$palabraAccion = 'Activar Usuario';
					$iconoAccion = 'abierto';
				}
				
				vistaGestor::agregarDiccionario('mensaje_estado', $mesanjeEstado);
				vistaGestor::agregarDiccionario('palabra_accion', $palabraAccion);
				vistaGestor::agregarDiccionario('icono_accion', $iconoAccion);

				vistaGestor::documentoNormal('Cambiar estado del usuario', array('vistas/usuario/estadoUsuario.html'));
			}
			else
			{
				self::_listadoUsuarios();
			}
		}
		
		private function _guardarEstado()
		{
			$usuario = usuario::cargarUsuario($_SESSION['formulario']['idUsuaario']);
		
			if(!empty($usuario))
			{
				$usuario->guardarEstado();
				
				vistaGestor::agregarNotificacion('exito', 'Se ha modificado el estado del usuario con éxito');
				self::_listadoUsuarios();
			}
			else
			{
				self::_listadoUsuarios();
			}
		}
		
		private function _restablecerClave()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idUsuaario'] = $_GET['id'];
			}

			$usuario = usuario::cargarUsuario($_SESSION['formulario']['idUsuaario']);
		
			if(!empty($usuario))
			{	
				if($usuario->dameEstado() == 'activo')
				{
					vistaGestor::agregarDiccionario('datoNombre', $usuario->dameNombre());
					vistaGestor::agregarDiccionario('datoUsuario', $usuario->dameUsuario());
					vistaGestor::agregarDiccionario('datoEstado', $usuario->dameEstado());

					vistaGestor::documentoNormal('Restablecer clave del usuario', array('vistas/usuario/restablecerUsuario.html'));
				}
				else
				{
					self::_listadoUsuarios();
				}
			}
			else
			{
				self::_listadoUsuarios();
			}
		}
		
		private function _guardarRestablecer()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idUsuaario'] = $_GET['id'];
			}

			$usuario = usuario::cargarUsuario($_SESSION['formulario']['idUsuaario']);
		
			if(!empty($usuario))
			{
				if($usuario->dameEstado() == 'activo')
				{
					$usuario->guardarRestablecer();
					
					vistaGestor::agregarNotificacion('exito', 'Se ha restablecido la clave del usuario con éxito');
					self::_listadoUsuarios();
				}
				else
				{
					self::_listadoUsuarios();
				}
			}
			else
			{
				self::_listadoUsuarios();
			}
		}
		
		private function _formularioRegistro()
		{
			vistaGestor::agregarArchivoCss('formularios');
			vistaGestor::documentoNormal('Registrar un usuario', array('vistas/usuario/formRegistrar.html'));
		}
		
		private function _formularioModificar()
		{
			if(!empty($_GET['id']))
			{
				$_SESSION['formulario']['idUsuaario'] = $_GET['id'];
			}

			$usuario = usuario::cargarUsuario($_SESSION['formulario']['idUsuaario']);
		
			if(!empty($usuario))
			{
				if($usuario->dameEstado() != 'restablecer')
				{
					$miEstadoUsuario = $usuario->dameEstado();
					$miEstadoUsuario = ucfirst($miEstadoUsuario);
				}
				else
				{
					$miEstadoUsuario = 'Clave restablecida';
				}
			
				vistaGestor::agregarDiccionario('datoNombre', $usuario->dameNombre());
				vistaGestor::agregarDiccionario('datoUsuario', $usuario->dameUsuario());
				vistaGestor::agregarDiccionario('datoEstado', $miEstadoUsuario);
				

				if(empty($_POST))
				{
					$_POST['nombreUsua'] = $usuario->dameNombre();
				
					$misPermisos = $usuario->damePermisos();
					$permisosIndividuales = explode(',', $misPermisos);
					
					foreach($permisosIndividuales as $elPermiso)
					{
						vistaGestor::agregarDiccionario('checked_permisos_' . $elPermiso, 'checked');
					}
				}
				vistaGestor::agregarArchivoCss('formularios');
				vistaGestor::documentoNormal('Modificar Usuario', array('vistas/usuario/seleccionUsuario.html', 'vistas/usuario/formModificar.html'));
			}
			else
			{
				self::_listadoUsuarios();
			}
		}
		
		private function _guardarRegistro()
		{
			$errores .= validarCampo::validarDato($_POST['nombreUsua'], 'nombreUsua', 'NOMBRE', 'no', '3-50');
			$errores .= validarCampo::validarDato($_POST['loginUsua'], 'loginUsua', 'ALFANUMERICO', 'no', '3-10');
			$errores .= validarCampo::validarDato($_POST['claveUno'], 'claveUno', 'ALFANUMERICO', 'no', '6-16');
			$errores .= validarCampo::validarDato($_POST['claveDos'], 'claveDos', 'ALFANUMERICO', 'no', '6-16');
			
			$errores .= validarCampo::multiMarcado(
							'permisos', 'Debe al menos seleccionar alg&uacute;n permiso', 1, 
							array(
								$_POST['cursosPerm'], 
								$_POST['personasPerm'], 
								$_POST['documentosPerm'], 
								$_POST['impresionesPerm']						
								)
							);
			

			if($_POST['claveUno'] != $_POST['claveDos'])
			{
				vistaGestor::agregarErrorForm('claveUno', 'Las claves no coinciden');
				$errores = 'ERROR';
			}
							
			if(empty($errores))
			{
				$permisos = array($_POST['cursosPerm'], $_POST['personasPerm'], $_POST['documentosPerm'], $_POST['impresionesPerm']);
				
				foreach($permisos as $permisoIndividual)
				{
					if($permisoIndividual != '')
					{
						$misPermisos .= $permisoIndividual . ',';
					}
				}

				$misPermisos = substr($misPermisos, 0, (strlen($misPermisos) - 1));
				
				$usuario = new usuario(
										NULL,
										$_POST['nombreUsua'],
										$_POST['loginUsua'],
										$_POST['claveUno'],
										$misPermisos,
										'activo'
									);

				$resultado = $usuario->registrar();

				if($resultado == 'exito')
				{
					vistaGestor::agregarNotificacion('exito', 'Se ha registrado con éxito al usuario');
					self::_listadoUsuarios();
				}
				elseif($resultado == 'existeUsuario')
				{
					vistaGestor::agregarErrorForm('loginUsua', 'El nombre de usuario ya existe');
					self::_formularioRegistro();
				}
			}
			else
			{
				self::_formularioRegistro();
			}
		}
		
	
		private function _guardarModificar()
		{
			if(!empty($_GET['id'])) {
				$_SESSION['formulario']['idUsuaario'] = $_GET['id'];
			}

			$usuario = usuario::cargarUsuario($_SESSION['formulario']['idUsuaario']);
		
			if(!empty($usuario))
			{
				$errores .= validarCampo::validarDato($_POST['nombreUsua'], 'nombreUsua', 'NOMBRE', 'no', '3-50');
				
				$errores .= validarCampo::multiMarcado(
								'permisos', 'Debe al menos seleccionar alg&uacute;n permiso', 1, 
								array(
										$_POST['cursosPerm'], 
										$_POST['personasPerm'], 
										$_POST['documentosPerm'], 
										$_POST['impresionesPerm']								
									)
								);

				if(empty($errores))
				{
					$permisos = array($_POST['cursosPerm'], $_POST['personasPerm'], $_POST['documentosPerm'], $_POST['impresionesPerm']);
				
					foreach($permisos as $permisoIndividual)
					{
						if($permisoIndividual != '')
						{
							$misPermisos .= $permisoIndividual . ',';
						}
					}

					$misPermisos = substr($misPermisos, 0, (strlen($misPermisos) - 1));
					
					$usuarioModificar = new usuario(
											$usuario->dameId(),
											$_POST['nombreUsua'],
											'',
											'',
											$misPermisos,
											''
										);

					$usuarioModificar->modificar();
					
					vistaGestor::agregarNotificacion('exito', 'Se ha modificado con éxito al usuario');
					self::_listadoUsuarios();
				}
				else
				{
					self::_formularioModificar();
				}
			}
			else
			{
				self::_listadoUsuarios();
			}
		}
		
		
		private function _listadoUsuarios()
		{
			$colUsuarios = usuario::dameColUsuarios();
				
				$titulos = array('Nombre', 'Usuario', 'Permisos', 'Estado', 'Opciones');
				$linkBase = '?ctrl=usuario&acc=listUsua';
				
				$listadoGenerador = new listadoGenerador($colUsuarios, $titulos, $linkBase, $_GET['pag'], 15);
				
				if(!empty($colUsuarios))
				{
					foreach($colUsuarios as $usuario)
					{
						$opciones = listadoGenerador::crearOpcion(
											'Modificar Usuario',
											'?ctrl=usuario&acc=modiUsua&id=' . $usuario->dameId(),
											'modificar negro');
						
						if($usuario->dameEstado() == 'activo' OR $usuario->dameEstado() == 'restablecer') {
							$iconoAccion = 'bloquear';
						}
						else {
							$iconoAccion = 'abierto';
						}

						$opciones .= listadoGenerador::crearOpcion(
											'Cambiar Estado',
											'?ctrl=usuario&acc=cambEsta&id=' . $usuario->dameId(),
											$iconoAccion . ' negro');
					
						if($usuario->dameEstado() == 'activo') {
							$opciones .= listadoGenerador::crearOpcion(
											'Restablecer Clave',
											'?ctrl=usuario&acc=restClav&id=' . $usuario->dameId(),
											'actualizar negro');
						}
						
						if($usuario->dameEstado() != 'restablecer')
						{
							$miEstadoUsuario = $usuario->dameEstado();
							$miEstadoUsuario = ucfirst($miEstadoUsuario);
						}
						else
						{
							$miEstadoUsuario = 'Clave restablecida';
						}
						
						$listadoGenerador->agregarFila(
							array (
									$usuario->dameNombre(),
									$usuario->dameUsuario(),
									$usuario->damePermisosMostrar(),
									$miEstadoUsuario,
									$opciones
									)
							, '');
					}
				}

				$htmlListado = $listadoGenerador->generarListado();
				
				vistaGestor::agregarArchivoCss('listados');
				
				vistaGestor::agregarDiccionario('htmlListado', $htmlListado);
				vistaGestor::documentoNormal('Listado de usuarios', array('vistas/usuario/listadoUsuarios.html'));
		}
	}