<?php
error_reporting(0);
header("Content-Type: text/html; charset=iso-8859-1");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

require_once 'nucleo/configuracion/baseDatos.php';
require_once 'nucleo/bdGestor.php';
require_once 'nucleo/vistaGestor.php';
require_once 'nucleo/validarCampo.php';
require_once 'nucleo/generarPDF.php';
require_once 'nucleo/utilidades/catalogoFunciones.php';
require_once 'nucleo/utilidades/listadoGenerador.php';


	session_name("sogerac");
	session_start();
	
	final class index
	{
		const USUARIO_CONECTADO = 'SI';
		const CTRL_DEFECTO_CONECTADO = 'inicio';
		const CTRL_DEFECTO_DESCONECTADO = 'logeo';

		static public function permitirAcceso($permisosIndicado)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			$query = "SELECT permisos FROM usuarios WHERE id_usuario = '" . $_SESSION['session']['id'] . "'";
			$permisosBD = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
			
			if($permisosBD[0]['permisos'] != 'admin')
			{
				$arrayPermisos = explode(',', $permisosBD[0]['permisos']);

				$_SESSION['session']['permisos'] = $arrayPermisos;

				if(array_search($permisosIndicado, $arrayPermisos) === FALSE)
				{
					header('Location:?ctrl=inicio&acc=sinPerm');
				}
				
				if(array_search($permisosIndicado, $_SESSION['session']['permisos']) === FALSE)
				{
					header('Location:?ctrl=inicio&acc=sinPerm');
				}
			}
		}

		static public function iniciar()
		{
			array_map('unlink' , glob('recursos/certificados/*.pdf'));
			array_map('unlink' , glob('recursos/identificadores/*.pdf'));
			
			if(self::_usuarioConectado())
			{
				$estadoUsuario = self::_usuarioEstadoActual();
			
				if($estadoUsuario == 'activo')
				{
					$controlador = self::_parametrosGetUsuarioConectado();
					
					if(self::_existeControlador($controlador) == FALSE)
					{
						$controlador = self::CTRL_DEFECTO_CONECTADO;
					}
				}
				else
				{
					if($estadoUsuario == 'restablecer')
					{
						$controlador = 'usuario';
					
						if($_GET['acc'] != 'cambClav' and $_GET['acc'] != 'guarClav' )
						{
							$_GET['acc'] = 'cambClav';
						}
					}
					elseif($estadoUsuario == 'bloqueado')
					{
						unset($_SESSION['session']);
						header('location: ./');
						exit();
					}
					else
					{
						exit("Problemas tipo estado del usuario");
					}
				}
			}
			else
			{
				$controlador = self::CTRL_DEFECTO_DESCONECTADO;
			}
			
			return $controlador;
		}

		static private function _usuarioConectado()
		{
			if( isset($_SESSION['session']['conectado']) &&
			$_SESSION['session']['conectado'] == self::USUARIO_CONECTADO)
			{
				$retorna = TRUE;
			}
			else
			{
				$retorna = FALSE;
			}

			return $retorna;
		}
		
		static private function _usuarioEstadoActual()
		{
			$GBD = new baseDatosGestor();
			$GBD->abrirConexion();

			$query = "SELECT estado FROM usuarios WHERE id_usuario = '" . $_SESSION['session']['id'] . "'";
			
			$datosQuery = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
			
			return $datosQuery[0]['estado'];
		}

		static private function _existeControlador($controlador)
		{
			$rutaControlador = 'controladores/'. $controlador . 'Controlador.php';

			if(is_file($rutaControlador))
			{
				$retorna = TRUE;
			}
			else
			{
				$retorna = FALSE;
			}

			return $retorna;
		}

		static private function _parametrosGetUsuarioConectado()
		{
			if($_GET['ctrl'] ==  self::CTRL_DEFECTO_DESCONECTADO OR $_GET['ctrl'] == '')
			{
				$_GET['ctrl'] = self::CTRL_DEFECTO_CONECTADO;
			}

			return $_GET['ctrl'];
		}
		
	}

	$controlador = index::iniciar();

	$rutaControlador = 'controladores/'. $controlador . 'Controlador.php';

	require_once $rutaControlador;

	$nombreControlador = $controlador . 'Controlador';
	
	$acc = isset($_GET['acc']) ? $_GET['acc'] : '';
	$nombreControlador::procesarAccion($acc);



