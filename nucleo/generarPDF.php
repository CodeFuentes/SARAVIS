<?php 
# Cargamos la librería dompdf.
require_once 'dompdf/dompdf_config.inc.php';
require_once 'modelos/contacto.php';
 
# Contenido HTML del documento que queremos generar en PDF.

	final class generarPDF
	{
		static public function cargarDocumento($html, $nombre, $salida, $correo, $curso, $edicion, $orientacion = 'horizontal')
		{
			//$html = file_get_contents('http://localhost/mercal/index.php?ctrl=almacen&acc=mostAlma');
			//$html = file_get_contents('http://localhost/mercal/index.php?ctrl=entrada&acc=listado');
			 
			# Instanciamos un objeto de la clase DOMPDF.
			$mipdf = new DOMPDF();
			 
			# Definimos el tamaño y orientación del papel que queremos. 
			# O por defecto tomará el que está en el fichero de configuración. // portrait
			if($orientacion == 'horizontal')
			{
				$mipdf ->set_paper("A4", "landscape");
			}
			elseif($orientacion == 'vertical')
			{
				$mipdf ->set_paper("A4", "portrait");
			}
			
			$html = preg_replace('/á/', '&aacute;', $html);
			$html = preg_replace('/(Á)/', '&Aacute;', $html);
			$html = preg_replace('/é/', '&eacute;', $html);
			$html = preg_replace('/(É)/', '&Eacute;', $html);
			$html = preg_replace('/í/', '&iacute;', $html);
			$html = preg_replace('/(Í)/', '&Iacute;', $html);
			$html = preg_replace('/ó/', '&oacute;', $html);
			$html = preg_replace('/(Ó)/', '&Oacute;', $html);
			$html = preg_replace('/ú/', '&uacute;', $html);
			$html = preg_replace('/(Ú)/', '&Uacute;', $html);
			$html = preg_replace('/(ñ)/', '&ntilde;', $html);
			$html = preg_replace('/(Ñ)/', '&Ntilde;', $html);
			
			# Cargamos el contenido HTML.
			$mipdf ->load_html(utf8_decode($html));
					
			# Renderizamos el documento PDF.
			$mipdf ->render();
			 
			# Enviamos el fichero PDF al navegador.
			//$mipdf ->stream($nombre . '.pdf');
		
			if($salida == 'guardar')
			{

				$output = $mipdf->output();
			//	file_put_contents('recursos/'.$nombre . '.pdf', $output);
				$archivo = 'recursos/'.$nombre.'.pdf';
		//		$archivo = ''.$nombre.'.pdf';
			//	$contacto = new contacto("Certificado de Participación", "Certificado de Participación:", $correo, $archivo, $curso, $edicion);
			//	$resultado = $contacto->enviarCertificado();

			}
			elseif($salida == 'descargar')
			{
			
				$mipdf ->stream('recursos/'.$nombre . '.pdf');
				
			}
			elseif($salida == 'enviar')
			{
				$output = $mipdf->output();
				file_put_contents('recursos/Certificado.pdf', $output);
				$archivo = 'recursos/'.$nombre.'.pdf';
				$archivo = ''.$nombre.'.pdf';
				$contacto = new contacto("Certificado de Participación", "Certificado de Participación:", $correo, $archivo, $curso, $edicion);
				$resultado = $contacto->enviarCertificado();
			}
			elseif($salida == 'cargarDocumento')
			{
				$output = $mipdf->output();
				file_put_contents($nombre.'.pdf', $output);
			}
		}
	}