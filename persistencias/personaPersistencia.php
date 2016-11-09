<?php

require_once 'nucleo/bdGestor.php';

	final class personaPersistencia
	{
		
		public function registrarPersona($documento, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $direccion, $correo)
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
		
		public function verificarDocumento($documento)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT id_persona FROM personas WHERE documento = '$documento'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function buscarPersona($documento)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM personas WHERE documento = '$documento'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function cargarPersona($id)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM personas WHERE id_persona = '$id'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		
		public function modificarPersona($id, $documento, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $direccion, $correo)
		{		
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE personas SET documento = '$documento', nombre = '$nombre', apellido = '$apellido', sexo = '$sexo',
					fecha_nacimiento = '$fechaNacimiento', telefono = '$telefono', direccion = '$direccion', correo = '$correo'
					WHERE id_persona = '$id'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
	}
