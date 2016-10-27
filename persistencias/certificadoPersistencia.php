<?php

require_once 'nucleo/bdGestor.php';

	final class certificadoPersistencia
	{
		public function cargarCertificado($idCertificado)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM certificados WHERE id_certificado = '$idCertificado'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function registrarCertificado($idEdicion, $idCertificado, $firmaFacilitador, $firmasExras, $fondo, $logoExtra)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();

			$query = "INSERT INTO certificados 
					(id_edicion, firma_facilitador, firmas_extras, fondo, logo_extra) 
					VALUES 
					('$idEdicion', '$firmaFacilitador', '$firmasExras', '$fondo', '$logoExtra')";
			
			$retorna = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
		
		public function modificarCertificado($idEdicion, $idCertificado, $firmaFacilitador, $firmasExras, $fondo, $logoExtra)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE certificados SET
					firma_facilitador = '$firmaFacilitador',
					firmas_extras = '$firmasExras',
					fondo = '$fondo',
					logo_extra = '$logoExtra'
					WHERE id_edicion = '$idEdicion' and id_certificado = '$idCertificado'";
			
			$retorna = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}
	}
