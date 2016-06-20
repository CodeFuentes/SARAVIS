<?php

	final class vistaGestor
	{
		static private $_codigoImprimir = NULL;
		static private $_redireccionamiento = NULL;

		static private $_archivosCss = array();
		static private $_archivosJs = array();

		static private $_notificacion = NULL;
		static private $_notificacionPermanente = NULL;
		
		static private $_errorForm = array();
		static private $_diccionario = array();
		
		static private $_tituloPrincipal = NULL;
		

		static public function documentoNormal($titulo, array $archivoVista)
		{
			
			self::$_tituloPrincipal = $titulo;
			
			self::_iniciarDocumento();
			self::_cargarMenuTitulo();

			foreach($archivoVista as $ubicacionVista)
			{
				self::_cargarContenidoHtml($ubicacionVista);
			}

			self::_cerrarDocumento();

			self::_reemplazarDinamico();
	

			$misPermisos = $_SESSION['session']['permisos'];
			$todosLosPermisos = array("cursos", "personas", "documentos", "impresiones");

			if($_SESSION['session']['conectado'] == "SI" AND $misPermisos[0] != 'admin')
			{
				$permisosFaltantes = array_diff($todosLosPermisos, $misPermisos);
				
				$permisosFaltantes[] = 'admin';
				
				foreach($permisosFaltantes as $quitarPermiso)
				{
					self::$_codigoImprimir = preg_replace('/({@' . $quitarPermiso . '})(.+)({@' . $quitarPermiso . '})/U', '', self::$_codigoImprimir);
				}
			}
			
			self::$_codigoImprimir = preg_replace('/({@.+})/U', '', self::$_codigoImprimir);
			
			echo self::$_codigoImprimir;
		}


		private function _reemplazarDinamico()
		{
			foreach($_POST as $llave => $valor)
			{	
				if(!is_array($valor))
				{
					self::$_codigoImprimir = preg_replace('/{#post_' . $llave . '}/', $valor, self::$_codigoImprimir);
				}
			}

			if(count(self::$_errorForm) > 0)
			{
				foreach(self::$_errorForm as $llave => $valor)
				{
					self::$_codigoImprimir = preg_replace('/{#error_' . $llave . '}/', $valor, self::$_codigoImprimir);
				}
			}

			if(count(self::$_diccionario) > 0)
			{
				foreach(self::$_diccionario as $llave => $valor)
				{				
					self::$_codigoImprimir = preg_replace('/{#' . $llave . '}/', $valor, self::$_codigoImprimir);
				}
			}
			

			self::$_codigoImprimir = preg_replace('/{#notificacion}/', self::$_notificacion, self::$_codigoImprimir);
			self::$_codigoImprimir = preg_replace('/{#notificacionPermanente}/', self::$_notificacionPermanente, self::$_codigoImprimir);
			
			self::$_codigoImprimir = preg_replace('/{#.{1,}}/U', '', self::$_codigoImprimir);

		}
		
		static public function agregarNotificacion($tipo, $contenido)
		{
			self::$_notificacion = '<div class="mensaje_resultado ' . $tipo . ' normal">
											<img class="izquierda">
												' . $contenido . '
											<img class="derecha">
										</div>';
		}
		
		static public function agregarNotificacionPermanente($tipo, $contenido)
		{
			self::$_notificacion = '<div class="mensaje_resultado ' . $tipo . ' permanente">
											<img class="izquierda">
												' . $contenido . '
											<img class="derecha">
										</div>';
		}
		
		static public function agregarErrorForm($llave, $contenido)
		{
			self::$_errorForm[$llave] = '<div class="error">' . $contenido . '</div>';
		}
		
		static public function agregarDiccionario($llave, $contenido)
		{
			self::$_diccionario[$llave] = $contenido;
		}

		static public function agregarRediccionar($direccion, $segundos)
		{
			self::$_redireccionamiento = '<meta http-equiv="Refresh" content="'. $segundos . ';url=' . $direccion . '">';
		}

		static public function agregarArchivoJs($archivo)
		{
			self::$_archivosJs[] = $archivo;
		}

		static public function agregarArchivoCss($archivo)
		{
			self::$_archivosCss[] = $archivo;
		}

		private function _cargarContenidoHtml($archivoVista)
		{
			self::$_codigoImprimir .= file_get_contents($archivoVista);
		}


		private function _iniciarDocumento()
		{
			self::$_codigoImprimir .= self::_cargarContenidoHtml('media/html/cabeceraComun.html');

			self::$_codigoImprimir .= self::$_redireccionamiento;

			self::$_codigoImprimir .= '<link rel="stylesheet" type="text/css" href="media/css/estructura.css"/>';
			self::$_codigoImprimir .= '<link rel="stylesheet" type="text/css" href="media/css/menu.css"/>';
			self::$_codigoImprimir .= '<link rel="stylesheet" type="text/css" href="media/css/iconos.css"/>';
			self::$_codigoImprimir .= '<link type="text/css" rel="stylesheet" href="media/css/materialize.min.css"  media="screen,projection"/>';


			if(count(vistaGestor::$_archivosCss) > 0)
			{
				foreach(vistaGestor::$_archivosCss as $valoresCss)
				{
					self::$_codigoImprimir .= '<link rel="stylesheet" type="text/css" href="media/css/' . $valoresCss . '.css"/>';
				}
			}
			
			self::$_codigoImprimir .= '<link rel="stylesheet" type="text/css" href="media/js/jquery/css/jqueryui.css"/>';
			self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/jquery/jquery.js"></script>';
			self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/jquery/jqueryui.js"></script>';
			self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/calendario.js"></script>';
			self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/jquery/qrcode.js"></script>';
			self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/materialize.min.js"></script>';
			


			
			self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/general.js"></script>';
			
			if(count(vistaGestor::$_archivosJs) > 0)
			{
				foreach(vistaGestor::$_archivosJs as $valoresJs)
				{
					self::$_codigoImprimir .= '<script type="text/javascript" src="media/js/' . $valoresJs . '.js"></script>';
				}
			}
	
			
			$nombreMeses = array('', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Noviembre', 'Diciembre');
			
			self::$_codigoImprimir .= '</head>';
			self::$_codigoImprimir .= '<body>';
			self::$_codigoImprimir .= '<header>';
			self::$_codigoImprimir .= '<div class="row"><div class="col s12 center-align"><img src="media/imagenes/barra_n.png"></div></div>';
			self::$_codigoImprimir .= '</header>';
		}

		private function _cargarMenuTitulo()
		{
			// self::$_codigoImprimir .= '<nav>';
			// self::$_codigoImprimir .= '</nav>';
			self::$_codigoImprimir .= '<div id="cuerpo_completo">';
			
			if($_SESSION['session']['conectado'] == "SI")
			{		
				if($_SESSION['session']['permisos'][0] == 'admin')
				{
					$misPermisos = 'Administrador';
				}
				else
				{
					$misPermisos = 'Usuario';
				}
			
				self::$_codigoImprimir .= '<div class="cerrarSession">Usuario: <a>' . $_SESSION['session']['nombre_completo'] . '</a> | Nivel: <a>' . $misPermisos . '</a> | <a class="link" href="?ctrl=inicio&acc=cerrSess">Cerrar Sesi�n<img class="salir negro"></a></div>';
				self::$_codigoImprimir .= self::_cargarContenidoHtml('media/html/menu.html');
			}
			
			self::$_codigoImprimir .= '<div id="cuerpo_principal">';
			
			if(!empty(self::$_tituloPrincipal))
			{
				self::$_codigoImprimir .= '<div id="titulo_principal">' . self::$_tituloPrincipal . '</div>';
			}
			
			self::$_codigoImprimir .= '{#notificacion}';
			self::$_codigoImprimir .= '{#notificacionPermanente}';
		}

		

		private function _cerrarDocumento()
		{
			
			self::$_codigoImprimir .= '</div>';
			self::$_codigoImprimir .= '</div>';
			self::$_codigoImprimir .= self::_cargarContenidoHtml('media/html/footer.html');

			self::$_codigoImprimir .= '</body>';
			self::$_codigoImprimir .= '</html>';
		}
	}