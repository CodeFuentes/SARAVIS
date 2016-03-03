<?php

	class inicioControlador
	{
		function procesarAccion($accion)
		{
			switch($accion)
			{
				case 'mostrar': 
				
					self::mostrarInicio();
					
				break;

				case 'cerrSess':

					self::cerrarSession();

				break;
				
				case 'sinPerm':

					self::sinPermisos();

				break;

				default:

					self::mostrarInicio();

				break;
			}
		}
		
		function mostrarInicio()
		{
			vistaGestor::documentoNormal('Bienvenido', array('vistas/inicio/bienvenida.html'));
		}
		
		function sinPermisos()
		{
			vistaGestor::agregarNotificacion('alerta', 'No tiene permisos para esta área');
			vistaGestor::documentoNormal('Bienvenido', array('vistas/inicio/bienvenida.html'));
		}
		
		function cerrarSession()
		{
			unset($_SESSION['session']);
			header('location: ./');
		}
	}