<?php

require_once 'nucleo/bdGestor.php';

	final class cursoPersistencia
	{
		
		public function registrarCurso($nombre, $descripcion)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "INSERT INTO cursos 
					(nombre, descripcion) 
					VALUES 
					('$nombre', '$descripcion')";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}	
		
		public function verificarNombre($nombre)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT id_curso FROM cursos WHERE nombre = '$nombre'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function buscarCodigo($idEdicion, $idPersona)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT 
						ediciones_personas.id_edicion, ediciones_personas.id_persona, ediciones.id_curso
						FROM 
						ediciones_personas, ediciones
						WHERE 
						ediciones_personas.id_edicion = '$idEdicion' and 
						ediciones_personas.id_persona = '$idPersona' and
						ediciones.id_edicion = '$idEdicion'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		
		public function buscarCurso($dato)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM cursos WHERE nombre LIKE '%$dato%'";

			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function cargarCurso($id)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM cursos WHERE id_curso = '$id'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		
		public function modificarCurso($id, $nombre, $descripcion)
		{		
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE cursos SET nombre = '$nombre', descripcion = '$descripcion'
					WHERE id_curso = '$id'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function cargarColEdiciones($idCurso)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			//$query = "SELECT * FROM ediciones WHERE id_curso = '$idCurso'";
			
			$query = "SELECT e.*, 

					p.id_persona AS p_id_persona, p.documento AS p_documento, p.nombre AS p_nombre, p.apellido AS p_apellido, p.sexo AS p_sexo, p.fecha_nacimiento AS p_fecha_nacimiento, p.telefono AS p_telefono, p.direccion AS p_direccion,

					c.id_certificado AS c_id_certificado, c.firmas_extras AS c_firmas_extras, c.firma_facilitador as c_firma_facilitador, c.fondo AS c_fondo, c.logo_extra AS c_logo_extra,

					i.id_identificador AS i_id_identificador, i.fondo AS i_fondo

					FROM ediciones AS e
					LEFT JOIN personas AS p ON e.id_facilitador = p.id_persona 
					LEFT JOIN certificados AS c ON e.id_edicion = c.id_edicion
					LEFT JOIN identificadores AS i ON e.id_edicion = i.id_edicion
					WHERE e.id_curso = '$idCurso'";
			
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function dameEdicion($idCurso, $idEdicion)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM ediciones WHERE id_curso = '$idCurso' and id_edicion='$idEdicion'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
	}
