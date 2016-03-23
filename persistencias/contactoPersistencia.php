<?php

require_once 'nucleo/bdGestor.php';

	final class contactoPersistencia
	{
		
		public function registrarMensaje($idusuario, $asunto, $mensaje)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "INSERT INTO contacto 
					(id_usuario, asunto, mensaje) 
					VALUES 
					('$idusuario', '$asunto', '$mensaje')";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
	}
