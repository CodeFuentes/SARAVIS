<?php

require_once 'persistencias/certificadoPersistencia.php';

	class certificado
	{
		private $_idCertificado = NULL;
		private $_firmaFacilitador;
		private $_firmasExras;
		private $_fondo;
		private $_logoExtra;
	
		public function __construct($idCertificado, $firmaFacilitador, $firmasExtras, $fondo, $logoExtra)
		{
			$this->_idCertificado = $idCertificado;
			$this->_firmaFacilitador = $firmaFacilitador;
			$this->_firmasExras = $firmasExtras;
			$this->_fondo = $fondo;
			$this->_logoExtra = $logoExtra;
		}
		
		//
		//++
		//+++++
		//		METODOS GETTERS
		//+++++
		//++
		//
		
		public function dameId()
		{
			return $this->_idCertificado;
		}
		
		public function dameFirmaFacilitador()
		{
			return $this->_firmaFacilitador;
		}
		
		public function dameFirmasExtras()
		{
			return $this->_firmasExras;
		}
		
		public function dameFondo()
		{
			return $this->_fondo;
		}
		
		public function dameLogoExtra()
		{
			return $this->_logoExtra;
		}

		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		static public function cargarCertificado($idCertificado)
		{
			$certificadoPersistencia = new certificadoPersistencia();
			$datosCertificado = $certificadoPersistencia->cargarCertificado($idCertificado);
	
			if(!empty($datosCertificado))
			{
				$retorna = new certificado(
									$datosCertificado[0]['id_certificado'], $datosCertificado[0]['firma_facilitador'],
									$datosCertificado[0]['firmas_extras'], $datosCertificado[0]['fondo'], 
									$datosCertificado[0]['logo_extra']
									);
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}

		public function actualizarCertificado($idEdicion)
		{
			if(empty($this->_idCertificado))
			{
				$certificadoPersistencia = new certificadoPersistencia();
				$datosCertificado = $certificadoPersistencia->registrarCertificado(
																			$idEdicion,
																			$this->_idCertificado,
																			$this->_firmaFacilitador,
																			$this->_firmasExras,
																			$this->_fondo,
																			$this->_logoExtra
																			);
			}
			else
			{
				$certificadoPersistencia = new certificadoPersistencia();
				$datosCertificado = $certificadoPersistencia->modificarCertificado(
																			$idEdicion,
																			$this->_idCertificado,
																			$this->_firmaFacilitador,
																			$this->_firmasExras,
																			$this->_fondo,
																			$this->_logoExtra
																			);
			}
		}

		public function generarHtmlCertificado($imprimir, $codigoGenerado, $tituloCurso, $duracionEdicion, $fechaEdicion, $nombreFacilitador)
		{		
			$miFondo = 'background: url("recursos/certificados/' . $this->_fondo . '") no-repeat';
		
			$valorLogoExtra = $this->dameLogoExtra();
			$qr = '<div id="qr"></div>';

			if($valorLogoExtra != 'ninguno'){
				$miLogoExtra = '<div class="logo"><img src="recursos/certificados/' . $this->_logoExtra . '"></img></div>';
			}
			else{
				$miLogoExtra = '';
			}

			$firmasExtras = $this->dameFirmasExtras();
			
			if(empty($firmasExtras)){
				$numeroDeFrimas = 1;
			}
			else{
				$numeroDeFrimas = count(explode('(#=P=#)', $firmasExtras)) + 1;
			}
			
			$tamanoTdFirma = (1000 / $numeroDeFrimas);
			$tamanoTdFirma = floor($tamanoTdFirma);

			$colFirmantes = explode('(#=P=#)', $firmasExtras);
			
			$tdFirmantes = '';
			$tdFirmantesCargos = '';
			
			$firmaFacilitador = $this->dameFirmaFacilitador();
			list($calificativoFacilitador, $cargoFacilitador) = explode('(#=D=#)', $firmaFacilitador);
			
			$tdFirmantes .= '<td class="firmante">' . $calificativoFacilitador . ' ' . $nombreFacilitador . '</td>';
			$tdFirmantesCargos .= '<td class="firmante">' . $cargoFacilitador . '</td>';
			
			foreach($colFirmantes as $firma)
			{
				list($calificativo, $nombre, $cargo) = explode('(#=D=#)', $firma);
				
				$tdFirmantes .= '<td class="firmante">' . $calificativo . ' ' . $nombre . '</td>';

				$tdFirmantesCargos .= '<td class="firmante">' . $cargo . '</td>';
			}
			
			foreach($imprimir as $persona)
			{
				$nombre = $persona['nombre'];
				$documento = $persona['documento'];
				$tipo = $persona['tipo'];
				$idPersona = $persona['id'];

				if($tipo == 'facilitador')
				{
					$datoTipo = 'COMO FACILITADOR';
				}
				else
				{
					if($tipo == 'participacion')
					{
						$datoTipo = 'POR SU PARTICIPACI&Oacute;N';
					}
					elseif($tipo > 59)
					{
						$datoTipo = 'POR APROBACI&Oacute;N';
					}
					elseif($tipo < 60 and $tipo > 0)
					{
						$datoTipo = 'POR PARTICIPACI&Oacute;N';
					}
					elseif($tipo == 0)
					{
						//NADA
					}
					else
					{
						exit("ERROR: NINGUN TIPO DE CERTIFICADO COINCIDE");
					}						
				}

				if($tipo != 0 or $tipo == 'facilitador' or $tipo == 'participacion')
				{

		$cuerpoRepetitivo .= '<div class="cuerpoCompleto">
					<table class="cabesera">
						<tr>
							<td class="lado" align="center">
								<div class="logo">
									<img src="recursos/logoUPTA.jpeg"></img>
								</div>
							</td>
							<td class="centro">
								<p style="font-size: 20px; margin: 0px;" >
								REP&Uacute;BLICA BOLIVARIANA DE VENEZUELA<br/>
								MINISTERIO DEL PODER POPULAR PARA LA EDUCACI&Oacute;N UNIVERSITARIA<br/>
								UNIVERSIDAD POLIT&Eacute;CNICA TERRITORIAL DEL ESTADO ARAGUA  
								"FEDERICO BRITO FIGUEROA" <br/> 
							</td>
							<td class="lado"  align="center">
								' . $miLogoExtra .
							'</td>
						</tr>
						<tr>
							<td class="lado">
							</td>
							
								<td class="centro" style="font-size: 22px;">
										<br/><br/>
										<div class="tituloCurso">
										OTORGA EL PRESENTE CERTIFICADO<br/>
										' . $datoTipo . ' A:
										<br/><br/>
										<p style="font-size: 36px; margin: 0px;" >' . $nombre .' </p>
										<p style="font-size: 32px; margin: 0px;" >' . $documento . '</p><br/>
										<p style="font-size: 32px; margin: 0px;">' . $tituloCurso .'</p>
										</div><br/>
										<p style="font-size: 20px; margin: 0px;">Venezuela - Estado Aragua<br/>
										DURACI&Oacute;N: ' . $duracionEdicion . '<br/>
										' . $fechaEdicion . '</p>
								</td>
							
							<td class="lado">
							</td>
						</tr>
					</table>
					<table class="firmas" style="font-size: 22px;">
						<tr>
							' . $tdFirmantes . '
						</tr>
						<tr>
							' . $tdFirmantesCargos . '
						</tr>
					</table>
					'.$qr.'
					<table class="codigoGenerado"><tr><td><p style="font-size: 20px; margin: 0px;">C&oacute;digo Verificaci&oacute;n: ' . $codigoGenerado . '-' . $idPersona . '</p></td></tr></table>
				</div>';
				}
			}
		
			$htmlPDF = '
		<html>

			<head>
				<script type="text/javascript" src="media/js/jquery/qrcode.js"></script>

				<style type="text/css">
					body * {
						overflow: hidden;
						font-family: kartika;
						font-weight: bold;
					}
					
					@page {
						margin: 0px;
					}
					
					body { 
						
						margin: 0px;
						' . $miFondo .'
					}
					
					div.cuerpoCompleto {
						margin: 0px;
						width: 1000px;
						height: 700px;
					}
					
					
					table { 
						width: 1000px;
						padding: 50px;
						
					}
					
					div.tituloCurso {
						font-size: 16;
					}
					
					table.cabesera {
						position:absolute;
						left:0px;
						top:0px;
					}
					
					table.firmas {
						position:absolute;
						left:0px;
						top:600px;
					}
					
					div.logo {
						width: 150px;
						height: 120px;
					}
					
					table td.lado { 
						padding-top:30px;
						width: 150px;
						height: 120px;
					}
					
					table td.centro { 
						width: 700px;
						height: 100px;
						text-align: center;
					}
					
					table td.firmante { 
						width: ' . $tamanoTdFirma .'px;
						text-align: center;
						vertical-align: text-top;
					}

					table.codigoGenerado {
						position: absolute;
						top: 700px;
						left: 0px;
						width: 1100px;
					}
					
					table.codigoGenerado td {
						text-align: center;
					}

				</style>
			</head>
			
			<body onload="update_qrcode()">
				' . $cuerpoRepetitivo . '
			</body>
		</html>';
		
			return $htmlPDF;
		
		}
	}
	
	
	
	