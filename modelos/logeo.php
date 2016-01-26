<?php

	class logeo
	{
		const INTENTOS_MAXIMOS = 3;
		const TIEMPO_BLOQUEADO = 5;
		const USUARIO_BLOQUEDO = 'bloqueado';		
		
		function existeUsuario(&$usuario, &$clave)
		{
			$errorValidar = '';
			$errorValidar .= validarCampo::validarDato(&$usuario, 'usuario', 'ALFANUMERICO', 'no', '5-10', 'minusculas');
			$errorValidar .= validarCampo::validarDato(&$clave, 'clave', 'ALFANUMERICO', 'no', '6-16', 'minusculas');
				
			if(empty($errorValidar))
			{				
				$usuarioArray = self::_verificarExisteUsuario(&$usuario, &$clave);
				
				if(!empty($usuarioArray[0]['id_usuario']) and (int)$usuarioArray[0]['id_usuario'] > 0)
				{
					$retorna = $usuarioArray[0]['id_usuario'];
				}
				else
				{
					$retorna = 'errorUsuario';
				}
			}
			else
			{
				$retorna = "errorCampos";
			}
			
			return $retorna;
		}
		
		function cargarSession($usuario)
		{
			unset($_SESSION['logeoCtrl']);
			
			$_SESSION['session']['conectado'] = "SI";
			
			$_SESSION['session']['id'] = $usuario[0]['id_usuario'];
			
			$arrayPermisos = explode(',', $usuario[0]['permisos']);
			$_SESSION['session']['permisos'] = $arrayPermisos;


			$_SESSION['session']['estado'] = $usuario[0]['estado'];
			
			list($nombre) = explode(' ', $usuario[0]['nombre_completo']);
			$_SESSION['session']['nombre_completo'] = $nombre;

		}
		
		function usuarioBloquado($usuario)
		{
			if($usuario[0]['estado'] == self::USUARIO_BLOQUEDO)
			{
				$retorna = TRUE;
			}
			else
			{
				$retorna = FALSE;
			}
			
			return $retorna;
		}
		
		function usuarioErroneo()
		{
			$_SESSION['logeoCtrl']['intentos']++;
			
			if($_SESSION['logeoCtrl']['intentos'] >= self::INTENTOS_MAXIMOS)
			{
				$_SESSION['logeoCtrl']['tiempo'] = time() + self::TIEMPO_BLOQUEADO + 1;
			}
		}
		
		function sistemaBloquedoIntentos()
		{
			$retorna = FALSE;
			
			if($_SESSION['logeoCtrl']['tiempo'] > 0)
			{
				if($_SESSION['logeoCtrl']['tiempo'] <= time())
				{
					$_SESSION['logeoCtrl']['tiempo'] = 0;
					$_SESSION['logeoCtrl']['intentos'] = 0;
					
					$retorna = FALSE;
				}
				else
				{
					$retorna = TRUE;
				}
			}
			
			return $retorna;
		}
		
		private function _verificarExisteUsuario($usuario, $clave)
		{
			$GBD = new baseDatosGestor();
			$GBD->abrirConexion();

			$query = "SELECT * FROM usuarios WHERE usuario = '" . $usuario . "' AND clave = '" . $clave . "'";
			
			$datosQuery = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();

			return $datosQuery;
		}
		
		function cargarUsuario($id)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM usuarios WHERE id_usuario = '" . $id . "'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
			
			return $retorna;
		}
	}