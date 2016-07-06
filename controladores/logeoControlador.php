<?php

require_once 'modelos/logeo.php';

	class logeoControlador
	{
		static public function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'mostrar': 
				
					self::_mostrarLogeo();
					
				break;

				case 'iniciar':

					self::_iniciarSession();

				break;

				default:

					self::_mostrarLogeo();

				break;
			}
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
		
		private function _mostrarFormInicioSession()
		{
			// vistaGestor::agregarArchivoCss('formularios');
			// vistaGestor::agregarArchivoCss('indexModificador');
	
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
					
					vistaGestor::agregarErrorForm('usuarioClave', 'El usuario no existe o los datos son incorrectos');
					
					logeo::usuarioErroneo();					
					self::_mostrarLogeo();
					
				break;
				
				case 'errorCampos':
				
					self::_mostrarLogeo();
					
				break;
			
				case ($id > 0):
					
					$usuarioObjeto = logeo::cargarUsuario($id);
				
					if(!logeo::usuarioBloquado($usuarioObjeto))
					{
						logeo::cargarSession($usuarioObjeto);
						
						header('location:./');
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