<?php

	final class listado
	{	
		private $_titulos;
		private $_filas = array();
		private $_rango;
		private $_linkBase;
		
		private $_paginaActual;
		private $_paginaMaxima;
		
		private $_tamanoArray;
		private $_htmlListado;
		
		
		const RANGO_PAGINADOR = 3;

		//*
		//***
		//*****
		// CONSTRUCTOR Y ACOMODA PARCIALMENTE LOS DATOS PARA LA PAGINA DE UN LISTADO
		//*****
		//***
		//, 
		
		public function __construct(array $array, array $titulos, $pagina = 1, $rango = 120)
		{

			$this->_titulos = $titulos;
			
			$this->_tamanoArray = count($array);
		
			if($this->_tamanoArray > 0)
			{
				$this->_rango = $rango;
		
				$this->_paginaMaxima = abs(floor(((count($array) - 1) / $this->_rango))) + 1;
			
				if(!is_numeric($pagina) or $pagina == 0 or $pagina < 1)
				{
					$pagina = 1;
				}
				
				if($pagina > $this->_paginaMaxima)
				{
					$pagina = $this->_paginaMaxima;
				}

				$this->_paginaActual = $pagina;
							
				$numeroInicio = ($this->_paginaActual * $this->_rango) - $this->_rango;

				$array = array_slice($array, $numeroInicio, $this->_rango);
			}
		}
		
		//*
		//***
		//*****
		// CREACION DE LOS ELEMENTOS DEL CUERPO
		//*****
		//***
		//*
		
		public function agregarFila(array $datos, $clase = '')
		{
			$this->_filas[] = array('datos' => $datos, 'clases' => $clase);
		}
		
		public function crearOpcion($titulo, $link, $clase)
		{			
			$opcion = '<a href="' . $link. '" title="' . $titulo . '"><img class="' . $clase. '"/></a>';

			return  $opcion;
		}

		
		//*
		//***
		//*****
		// GENERAR HTML LISTADO
		//*****
		//***
		//*
		


		public function generarListado()
		{
			header('Content-Type:text/html;charset=utf-8');
			$this->_htmlListado .= '<table class="striped"><thead><tr>';

			foreach($this->_titulos as $valor)
			{				
				$this->_htmlListado .= '<th >' . $valor . '</th>';
			}
			
			$this->_htmlListado .= 	'</tr></thead><tbody>';
			
			if($this->_tamanoArray > 0)
			{
				foreach($this->_filas as $filas)
				{
					if($filas['clases'] != '')
					{
						$this->_htmlListado .= '<tr class="' . $filas['clases'] . '">';
					}
					else
					{
						$this->_htmlListado .= '<tr>';
					}
					
					foreach($filas['datos'] as $dato)
					{
						if(empty($dato))$this->_htmlListado .= '<td>No hay Resultados.</td>';
						else $this->_htmlListado .= '<td>' . $dato . '</td>';
					}
					
					$this->_htmlListado .= '</tr>';
				}
				
				$this->_htmlListado .= '</tbody>';		
				
				$this->_htmlListado .= '<tfoot><tr><th colspan="10"><div class="paginador">';

				
				if($this->_paginaMaxima > 1)
				{
					if($this->_paginaActual == 1)
					{
						$anterior = "";
					}
					else
					{
						$anterior = '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual - 1) . '" class="anterior"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Anterior</a>';
					}
					
					if($this->_paginaActual == $this->_paginaMaxima)
					{
						$siguiente = "";
					}
					else
					{
						$siguiente = '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual + 1) . '" class="anterior"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Siguiente</a>';
					}
					
					$ciclo = 1;
					
					while($ciclo <= self::RANGO_PAGINADOR and ($this->_paginaActual + $ciclo) <= $this->_paginaMaxima)
					{
						
						$linkSiguiente .= '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual + $ciclo) . '" class="anterior">' . ($this->_paginaActual + $ciclo) . '</a>';

						$ciclo++;
					}
					
					$ciclo = 1;
					
					while($ciclo <= self::RANGO_PAGINADOR and ($this->_paginaActual - $ciclo) > 0)
					{			
						$linkAnterior = '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual - $ciclo) . '" class="anterior">' . ($this->_paginaActual - $ciclo) . '</a>' . $linkAnterior;

						$ciclo++;
					}

					$paginador = $anterior . $linkAnterior . "<span>" .$this->_paginaActual . "</span>" . $linkSiguiente . $siguiente;
				}
				else
				{
					$paginador = "";
				}
			}
			else
			{				
				$this->_htmlListado .= '<tr><td colspan="' . count($this->_titulos) .'">No hay resultados</td></tr>';
			
				$this->_htmlListado .= '</tbody>';		
				
				$this->_htmlListado .= '<tfoot><tr><th colspan="10"><div class="paginador">';
				
				$paginador = "";
			}
			
		
			$this->_htmlListado .= $paginador;

			$this->_htmlListado .= '</div></th></tr></tfoot></table>';
			
			return $this->_htmlListado;
		}


		public function listado()
		{
			header('Content-Type:text/html;charset=utf-8');
			$this->_htmlListado .= '<table class="striped"><thead><tr>';

			foreach($this->_titulos as $valor)
			{				
				$this->_htmlListado .= '<th >' . $valor . '</th>';
			}
			
			
			$this->_htmlListado .= 	'</tr></thead><tbody>';
			
			if($this->_tamanoArray > 0)
			{
				foreach($this->_filas as $filas)
				{
					if($filas['clases'] != '')
					{

						$this->_htmlListado .= '<tr class="' . $filas['clases'] . '">';
					}
					else
					{
						$this->_htmlListado .= '<tr>';
					}
					
					foreach($filas['datos'] as $dato)
					{
						if(empty($dato))$this->_htmlListado .= '<td>No hay Resultados.</td>';
						else $this->_htmlListado .= '<td>' . $dato . '</td>';
					}
					
					$this->_htmlListado .= '</tr>';
				}
				
				$this->_htmlListado .= '</tbody>';		
				
				$this->_htmlListado .= '<tfoot><tr><th colspan="10"><div class="paginador">';

				
				if($this->_paginaMaxima > 1)
				{
					if($this->_paginaActual == 1)
					{
						$anterior = "";
					}
					else
					{
						$anterior = '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual - 1) . '" class="anterior"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Anterior</a>';
					}
					
					if($this->_paginaActual == $this->_paginaMaxima)
					{
						$siguiente = "";
					}
					else
					{
						$siguiente = '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual + 1) . '" class="anterior"><i class="fa fa-angle-double-right" aria-hidden="true"></i> Siguiente</a>';
					}
					
					$ciclo = 1;
					
					while($ciclo <= self::RANGO_PAGINADOR and ($this->_paginaActual + $ciclo) <= $this->_paginaMaxima)
					{
						
						$linkSiguiente .= '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual + $ciclo) . '" class="anterior">' . ($this->_paginaActual + $ciclo) . '</a>';

						$ciclo++;
					}
					
					$ciclo = 1;
					
					while($ciclo <= self::RANGO_PAGINADOR and ($this->_paginaActual - $ciclo) > 0)
					{			
						$linkAnterior = '<a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual - $ciclo) . '" class="anterior">' . ($this->_paginaActual - $ciclo) . '</a>' . $linkAnterior;

						$ciclo++;
					}

					$paginador = $anterior . $linkAnterior . "<span>" .$this->_paginaActual . "</span>" . $linkSiguiente . $siguiente;
				}
				else
				{
					$paginador = "";
				}
			}
			else
			{				
				$this->_htmlListado .= '<tr><td colspan="' . count($this->_titulos) .'">No hay resultados</td></tr>';
			
				$this->_htmlListado .= '</tbody>';		
				
				$this->_htmlListado .= '<tfoot><tr><th colspan="10"><div class="paginador">';
				
				$paginador = "";
			}
			
		
			$this->_htmlListado .= $paginador;

			$this->_htmlListado .= '</div></th></tr></tfoot></table>';
			
			return $this->_htmlListado;
		}
	}