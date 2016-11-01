<?php

	final class listadoGenerador
	{	
		private $_titulos;
		private $_filas = array();
		private $_rango;
		private $_linkBase;
		
		private $_paginaActual;
		private $_paginaMaxima;
		
		private $_tamanoArray;
		private $_htmlListado;
		private $_filasActuales;
		
		const RANGO_PAGINADOR = 3;

		//*
		//***
		//*****
		// CONSTRUCTOR Y ACOMODA PARCIALMENTE LOS DATOS PARA LA PAGINA DE UN LISTADO
		//*****
		//***
		//, 
		
		public function __construct(array $array, array $titulos, $linkBase, $pagina = 1, $rango = 10)
		{
			$this->_titulos = $titulos;
			
			$this->_tamanoArray = count($array);
		
			if($this->_tamanoArray > 0)
			{
				$this->_rango = $rango;
				$this->_linkBase = $linkBase;
		
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
			$opcion = '<a href="' . $link. '" title="' . $titulo . '"><img class="' . $clase. '"/>'.$titulo.'</a>';

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
			
			$this->_htmlListado .= '<div class="col s12"><table class="striped"><thead><tr>';

			foreach($this->_titulos as $valor)
			{				
				$this->_htmlListado .= '<th >' . $valor . '</th>';
			}
			
			$this->_htmlListado .= 	'</tr></thead><tbody>';
			
			if($this->_tamanoArray > 0)
			{
				$this->_filasActuales = array_slice($this->_filas, ($this->_paginaActual * $this->_rango) - $this->_rango, $this->_rango);
				foreach($this->_filasActuales as $filas)
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
						$this->_htmlListado .= '<td>' . $dato . '</td>';
					}
					
					$this->_htmlListado .= '</tr>';
				}
				
				$this->_htmlListado .= '</tbody>';		
				
				$this->_htmlListado .= '</table>
				</div>
				<div class="col s12 center-align">
				<ul class="pagination">';

				
				if($this->_paginaMaxima > 1)
				{
					if($this->_paginaActual == 1)
					{
						$anterior = '<li class="disabled">
										<a href="#!">
											<i class="fa fa-chevron-left" style="font-size: 22px;"></i>
										</a>
									</li>';
					}
					else
					{
						$anterior = '<li class="waves-effect"><a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual - 1) . '"><i class="fa fa-chevron-left" style="font-size: 22px;"></i></a></li>';
					}
					
					if($this->_paginaActual == $this->_paginaMaxima)
					{
						$siguiente = '<li class="disabled"><a href="#!"><i class="fa fa-chevron-right" style="font-size: 22px;"></i></a></li>';
					}
					else
					{
						$siguiente = '<li class="waves-effect"><a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual + 1) . '"><i class="fa fa-chevron-right" style="font-size: 22px;"></i></a></li>';
					}
					
					$ciclo = 1;
					
					while($ciclo <= self::RANGO_PAGINADOR and ($this->_paginaActual + $ciclo) <= $this->_paginaMaxima)
					{
						
						$linkSiguiente .= '<li class="waves-effect"><a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual + $ciclo) . '">' . ($this->_paginaActual + $ciclo) . '</a></li>';

						$ciclo++;
					}
					
					$ciclo = 1;
					
					while($ciclo <= self::RANGO_PAGINADOR and ($this->_paginaActual - $ciclo) > 0)
					{			
						$linkAnterior = '<li class="waves-effect"><a href="' . $this->_linkBase . '&pag=' . ($this->_paginaActual - $ciclo) . '">' . ($this->_paginaActual - $ciclo) . '</a>' . $linkAnterior . '</li>';

						$ciclo++;
					}

					$paginador = $anterior . $linkAnterior . '<li class="active"><a href="#!">' .$this->_paginaActual . '</a></li>' . $linkSiguiente . $siguiente;
				}
				else
				{
					$paginador = "";
				}
			}
			else
			{				
				$this->_htmlListado = 'No hay resultados';
							
				$this->_htmlListado .= '<ul class="pagination">';
				
				$paginador = "";
			}
			
			$this->_htmlListado .= $paginador;

			$this->_htmlListado .= '</ul></div>';

			
			return $this->_htmlListado;
		}
	}