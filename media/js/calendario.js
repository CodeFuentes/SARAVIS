$(function() {
	     
	 //Array para dar formato en espa�ol
	  $.datepicker.regional['es'] =
	  {
	  closeText: 'Cerrar',
	  prevText: 'Previo',
	  nextText: 'Pr�ximo',
	   
	  monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
	  'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
	  monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
	  'Jul','Ago','Sep','Oct','Nov','Dic'],
	  monthStatus: 'Ver otro mes', yearStatus: 'Ver otro a�o',
	  dayNames: ['Domingo','Lunes','Martes','Mi�rcoles','Jueves','Viernes','S�bado'],
	  dayNamesShort: ['Dom','Lun','Mar','Mie','Jue','Vie','S�b'],
	  dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sa'],
	  dateFormat: 'dd/mm/yy', firstDay: 0,
	  initStatus: 'Selecciona la fecha', isRTL: false};
		$.datepicker.setDefaults($.datepicker.regional['es']);
	  
	 //miDate: fecha de comienzo D=d�as | M=mes | Y=a�o
	 //maxDate: fecha tope D=d�as | M=mes | Y=a�o
	 
	    $( "#fechaNacimientoPers" ).datepicker({ dateFormat: 'dd-mm-yy' });
	    $( "#fechaInicioEdic" ).datepicker({ dateFormat: 'dd-mm-yy' });
	    $( "#fechaFinEdic" ).datepicker({ dateFormat: 'dd-mm-yy' });
	    $( "#fechaFinEdic" ).datepicker({ dateFormat: 'dd-mm-yy' });
		
	  });