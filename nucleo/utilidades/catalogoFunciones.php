<?php 

	function invertirFecha($fecha)
	{
		return implode('-', array_reverse(explode('-', $fecha)));
	}
	
	function segundosFecha($fecha)
	{
		list($dia, $mes, $anio) = explode('-', $fecha);
	
		return mktime(0, 0, 0, $mes, $dia, $anio);
	}