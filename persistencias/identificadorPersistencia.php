<?php

require_once 'nucleo/bdGestor.php';

	final class identificadorPersistencia
	{
		public function cargarIdentificador($idIdentificador)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM identificadores WHERE id_identificador = '$idIdentificador'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();

			return $retorna;
		}
		
		public function registrarIdentificador($idEdicion, $idIdentificador, $fondo)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();

			$query = "INSERT INTO identificadores 
					(id_edicion, fondo) 
					VALUES 
					('$idEdicion',  '$fondo')";
			
			$retorna = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function modificarIdentificador($idEdicion, $idIdentificador, $fondo)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE identificadores SET
					fondo = '$fondo'
					WHERE id_edicion = '$idEdicion' and id_identificador = '$idIdentificador'";
			
			$retorna = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
	}