<?php

require_once 'nucleo/bdGestor.php';

	final class contactoPersistencia
	{
		
		public function registrarContacto($documento, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $direccion, $correo)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "INSERT INTO personas 
					(documento, nombre, apellido, sexo, fecha_nacimiento, telefono, direccion, correo) 
					VALUES 
					('$documento', '$nombre', '$apellido', '$sexo', '$fechaNacimiento', '$telefono', '$direccion', '$correo')";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
	}
