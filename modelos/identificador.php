<?php

require_once 'persistencias/identificadorPersistencia.php';

	class identificador
	{
		private $_idIdentificador = NULL;
		private $_fondo;
	
		public function __construct($idIdentificador, $fondo)
		{
			$this->_idIdentificador = $idIdentificador;
			$this->_fondo = $fondo;
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
			return $this->_idIdentificador;
		}
		
		public function dameFondo()
		{
			return $this->_fondo;
		}
		
		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		static public function cargarIdentificador($idIdentificador)
		{
			$identificadorPersistencia = new identificadorPersistencia();
			$datosIdentificador = $identificadorPersistencia->cargarIdentificador($idIdentificador);
	
			if(!empty($datosIdentificador))
			{
				$retorna = new identificador(
									$datosIdentificador[0]['id_identificador'], $datosIdentificador[0]['fondo']
									);
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
		public function actualizarIdentificador($idEdicion)
		{
			if(empty($this->_idIdentificador))
			{
				$identificadorPersistencia = new identificadorPersistencia();
				$datosIdentificador = $identificadorPersistencia->registrarIdentificador(
																			$idEdicion,
																			$this->_idIdentificador,
																			$this->_fondo
																			);
			}
			else
			{
				$identificadorPersistencia = new identificadorPersistencia();
				$datosIdentificador = $identificadorPersistencia->modificarIdentificador(
																			$idEdicion,
																			$this->_idIdentificador,
																			$this->_fondo
																			);
			}
		}

		public function htmlIdentificador($nombreCurso, $duracionEdicion, $fechaFinEdicion)
		{
				$miFondo = 'background: url("recursos/identificadores/' . $this->dameFondo() . '") no-repeat';
				
				$cuerpo = '			
			<table>
			<tr>
			<td>
				<div class="cuerpoCompleto">
				<table class="cabesera">
					<tr>
						<td class="lado" align="center">
							<div class="logo">
								<img src="recursos/logoUPTA.jpeg"></img>
							</div>
						</td>
							
						<td class="centro">
							UNIVERSIDAD POLIT&Eacute;CNICA TERRITORIAL DEL ESTADO ARAGUA  <br/>
							"FEDERICO BRITO FIGUEROA"  <br/>LA VICTORIA ESTADO ARAGUA<br/>
						</td>
					</tr>					
				</table>
					<div class="cuerpoDatos">
					
						<div class="unaLinea">
							PARTICIPANTE
						</div>
						<div class="unaLinea">
							C.I: V-15.123.123
						</div>
						<div class="dosLinea">
							Jose Pablo Alenxader Garcia Perez Marquez
						</div>
						<div class="dosLinea">
							' . $nombreCurso .'
						</div>
						
						<div class="unaLinea">
							Duracion: ' . $duracionEdicion . '
						</div>
						
						<div class="unaLinea">
							V&aacute;lido hasta:
						</div>
						<div class="unaLinea">
							' . $fechaFinEdicion . '
						</div>
					
					</div>
				</div>
			</table>';
				
				$htmlPDF = '
		<html>
			
			<head>
				<style type="text/css">
				
						body *
						{
							overflow: hidden;
							font-family: impact;
							font-weight: bold;
						}
						
						@page
						{
							margin: 0px;
						}
						
						body 
						{			
							margin: 0px;
						}
						
						div.cuerpoCompleto
						{
							float: left;
							margin: 40px 0px 30px 30px;
							width: 208px;
							height: 321px;
							' . $miFondo .'
						}
						

						
						div.cuerpoDatos
						{
							width: 190px;
							font-size: 11;
							padding: 7px 7px 0px 7px;
							text-align: center;
							
						
						table.cabesera
						{
							width: 208px;
							padding: 7px 7px 0px 7px;
							left:0px;
							top:0px;
						}
						
						table.firmas
						{
							position:absolute;
							left:0px;
							top:600px;
						}
						
						div.logo
						{
							width: 70px;
							height: 90px;
						}
						
						table td.lado 
						{
							width: 70px;
							height: 90px;
						}
						
						table td.centro 
						{ 
							width: 130px;
							height: 100px;
							text-align: center;
							font-size: 7;
						}
						
						div.unaLinea
						{
							height: 18px;
						}
						div.dosLinea
						{
							height: 43px;
						}
				
				</style>
			</head>
			<body>
				' . $cuerpo . '
			</body>
			</html>';
		
			return $htmlPDF;
		}
		
		
		public function htmlIdentificadorImprimir($participantes , $nombreCurso, $duracionEdicion, $fechaEdicion)
		{

			$cuerpoRepetitivo = '';
			$elFondo = $this->_fondo;
			
			$miFondo = 'background: url("recursos/identificadores/' . $elFondo .'") no-repeat';

			for($j = 1; $j <= count($participantes); $j++)
			{			
				if($j == 1 or (($j % 8) == 1))
				{
					$cuerpoRepetitivo .= '<table> <tr> <td>';
				}
				
				if(($j % 2) == 1 and !(($j % 8) == 1))
				{
					$cuerpoRepetitivo .= '<td>';
				}

					$cuerpoRepetitivo .='
					<div class="cuerpoCompleto">
						
						<table class="cabesera">
							
							<tr>
								<td align="center">
									<div class="logo">
										<img src="recursos/logoUPTA.jpeg"></img>
									</div>
								</td>
							</tr>
							
								
						</table>
						
										<div class="cuerpoDatos">
										
											<div class="unaLinea">
												' . $participantes[($j-1)]['tipo'] .'
											</div>
											<div class="unaLinea">
												' . $participantes[($j-1)]['nombre'] .'
											</div>
											<div class="dosLinea">
												' . $participantes[($j-1)]['documento'] .'
											</div>
											
											<div class="dosLinea">
												' . $nombreCurso .'
											</div>
											
											<div class="unaLinea">
												Duracion: ' . $duracionEdicion . '
											</div>

											<div class="unaLinea">
												V&aacute;lido desde:
											</div>
											<div class="unaLinea">
												' . $fechaEdicion .'
											</div>
										
										</div>
						</div>';
						
				if(($j % 2) == 0 or count($participantes) == $j)
				{
					// </td>
				//	echo " /td-$j ";
					$cuerpoRepetitivo .= '</td>';
				}

				
				if((($j % 8) == 0) and !(count($participantes) == $j))
				{
				//	echo " /tr /table-$j ";
					$cuerpoRepetitivo .= '</tr> </table>';
				}
				
				if(count($participantes) == $j)
				{
					// </tr> </table>
				//	echo " /tr /table-$j ";
					$cuerpoRepetitivo .= '</tr> </table>';
				}	
			}
				
				$HTML = '
				
				<html>
					
					<head>
						<style type="text/css">
						
						body *
						{
							overflow: hidden;
							font-family: Arial;
							font-weight: bold;
						}
						
						@page
						{
							margin: 0px;
						}
						
						body 
						{			
							margin: 0px;
						}
						
						div.cuerpoCompleto
						{
							float: left;
							margin: 40px 0px 30px 30px;
							width: 208px;
							height: 321px;
							' . $miFondo .'
						}
						

						
						div.cuerpoDatos
						{
							width: 190px;
							font-size: 11;
							padding: 7px 7px 0px 7px;
							text-align: center;
							
						
						table.cabesera
						{
							width: 208px;
							padding: 7px 7px 0px 7px;
							left:0px;
							top:0px;
						}
						
						table.firmas
						{
							position:absolute;
							left:0px;
							top:600px;
						}
						
						div.logo
						{
							width: 70px;
							height: 90px;
							margin-left: 70px;
						}
						
						table td.lado 
						{
							width: 70px;
							height: 90px;
						}
						
						table td.centro 
						{ 
							width: 130px;
							height: 100px;
							text-align: center;
							font-size: 7;
						}
						
						div.unaLinea
						{
							height: 18px;
						}
						div.dosLinea
						{
							height: 43px;
						}
						
						
						</style>
					</head>
					
					<body>
						
						
						' . $cuerpoRepetitivo . '
						
					</body>
					
					</html>';
					
			return $HTML;
		}
		
	}
	
	
	
	