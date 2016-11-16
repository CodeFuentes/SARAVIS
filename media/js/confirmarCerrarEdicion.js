	$(function() {
	
		$("#formCerrarEdicion").submit(function()
		{
			var respuesta = prompt("Escriba 'aceptar' para confirmar","cancelar");
			
			if(respuesta == 'aceptar') {
				return true;
			}
			else {
				return false;
			}
		});
	});