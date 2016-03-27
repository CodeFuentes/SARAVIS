<?php

require_once 'nucleo/bdGestor.php';

	final class edicionPersistencia
	{
		
		public function registrarEdicion($idCurso, $tipo, $fechaInicio, $fechaFin, $duracion, $limite, $horario, $sinoptico)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$fechaFin = invertirFecha($fechaFin);
			$fechaInicio = invertirFecha($fechaInicio);
			
			$query = "INSERT INTO ediciones 
					(id_curso, tipo, fecha_inicio, fecha_fin, duracion, limite, horario, sinoptico) 
					VALUES 
					('$idCurso', '$tipo', '$fechaInicio', '$fechaFin', '$duracion', '$limite', '$horario', '$sinoptico')";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}	
		
		public function modificarEdicion($idEdicion, $tipo, $fechaInicio, $fechaFin, $duracion, $limite, $horario, $sinoptico)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$fechaFin = invertirFecha($fechaFin);
			$fechaInicio = invertirFecha($fechaInicio);
			
			$query = "UPDATE ediciones SET
			tipo = '$tipo',
			fecha_inicio = '$fechaInicio',
			fecha_fin = '$fechaFin',
			duracion = '$duracion',
			limite = '$limite',
			horario = '$horario', 
			sinoptico ='$sinoptico'
			WHERE id_edicion = '$idEdicion'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}	
		
		public function cargarEdicion($idEdicion)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "SELECT e.*, 

					p.id_persona AS p_id_persona, p.documento AS p_documento, p.nombre AS p_nombre, p.apellido AS p_apellido, p.sexo AS p_sexo, p.fecha_nacimiento AS p_fecha_nacimiento, p.telefono AS p_telefono, p.direccion AS p_direccion,

					c.id_certificado AS c_id_certificado, c.firmas_extras AS c_firmas_extras, c.firma_facilitador AS c_firma_facilitador, c.fondo AS c_fondo, c.logo_extra AS c_logo_extra,

					i.id_identificador AS i_id_identificador, i.fondo AS i_fondo

					FROM ediciones AS e
					LEFT JOIN personas AS p ON e.id_facilitador = p.id_persona 
					LEFT JOIN certificados AS c ON e.id_edicion = c.id_edicion
					LEFT JOIN identificadores AS i ON e.id_edicion = i.id_edicion
					WHERE e.id_edicion = '$idEdicion'";
			
			
			$retorna = $GBD->resultadoQuery($query);

			$GBD->cerrarConexion();
				
			return $retorna;
		}
		
		public function contarParticipantes($idEdicion)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "SELECT count(id_persona) AS cantidad_participantes FROM ediciones_personas WHERE id_edicion = '$idEdicion'";
	
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
				
			return $retorna;
		}
		
		public function existeParticipante($idEdicion, $idParticipante)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "SELECT id_persona FROM ediciones_personas WHERE id_edicion = '$idEdicion' and id_persona = '$idParticipante'";
	
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
				
			return $retorna;
		}
		
		public function dameRelacionParticipantes($idEdicion)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "SELECT * FROM ediciones_personas WHERE id_edicion = '$idEdicion'";
	
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
				
			return $retorna;
		}
		
		public function guardarEstado($idEdicion, $guardarEstado)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();

			$query = "UPDATE ediciones SET estado = 'bloqueada' WHERE id_edicion = '$idEdicion'";
				
			$GBD->insertarQuery($query);
			
			foreach($guardarEstado as $fila)
			{
				$idPersona = $fila['idPersona'];
				$miEstado = $fila['estado'];
			
				$query = "UPDATE ediciones_personas SET estado = '$miEstado' WHERE id_edicion = '$idEdicion' and id_persona = '$idPersona'";
				
				$GBD->insertarQuery($query);
			}


			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		
		public function asignarFacilitador($idEdicion, $idFacilitador)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "UPDATE ediciones SET id_facilitador = '$idFacilitador' WHERE id_edicion = '$idEdicion'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function incribirPersona($idEdicion, $idPersona)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "INSERT INTO  ediciones_personas (id_edicion, id_persona) VALUES ('$idEdicion', '$idPersona')";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function desincorporarPersona($idEdicion, $idPersona)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();

			$query = "DELETE FROM ediciones_personas WHERE id_edicion = '$idEdicion' AND id_persona = '$idPersona'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function traerColParticipantes($idEdicion)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
				
			$query = "SELECT p.* FROM personas as p, ediciones_personas as r 
						WHERE r.id_edicion = '$idEdicion' and r.id_persona = p.id_persona
						order by p.nombre asc";
	
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
				
			return $retorna;
		}

		public function bloquearEdicion($id_edicion){

			$GBD  = new baseDatosGestor();
			$GBD->abrirConexion();

			$query = "UPDATE ediciones SET estado = 'bloqueada' WHERE id_edicion = '$id_edicion'";
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}

		public function desbloquearEdicion($id_edicion){

			$GBD  = new baseDatosGestor();
			$GBD->abrirConexion();

			$query = "UPDATE ediciones SET estado = 'normal' WHERE id_edicion = '$id_edicion'";
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}

		public function listadoEdiciones(){
			$GBD = new baseDatosGestor();
			$GBD->abrirConexion();

			$query = "SELECT e.*, 
					p.id_persona AS p_id_persona, p.documento AS p_documento, p.nombre AS p_nombre, p.apellido AS p_apellido, p.sexo AS p_sexo, p.fecha_nacimiento AS p_fecha_nacimiento, p.telefono AS p_telefono, p.direccion AS p_direccion,
					c.id_curso AS e_id_curso, c.nombre AS e_nombre, c.descripcion AS e_descripcion
					FROM ediciones AS e
					LEFT JOIN personas AS p ON e.id_facilitador = p.id_persona 
					LEFT JOIN cursos AS c ON e.id_edicion = c.id_curso
					ORDER BY fecha_inicio DESC";

			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();

			return $retorna;
		}
	}
