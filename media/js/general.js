
	window.onload = function()
	{		
		setTimeout(borrarNotificacion , 10000);

		document.onkeydown = function(e){
		 e=e||window.event;
		
			if (e.keyCode === 116 ) 
			{
			  e.keyCode = 0;
			  
			  if(e.preventDefault)e.preventDefault();
			  else e.returnValue = false;
			  return false;
			}	
		};
	
		 if (typeof history.pushState === "function") {
			history.pushState("jibberish", null, null);
			window.onpopstate = function () {
				history.pushState('newjibberish', null, null);
				// Handle the back (or forward) buttons here
				// Will NOT handle refresh, use onbeforeunload for this.
			};
		}
		else {
			var ignoreHashChange = true;
			window.onhashchange = function () {
				if (!ignoreHashChange) {
					ignoreHashChange = true;
					window.location.hash = Math.random();
					// Detect and redirect change here
					// Works in older FF and IE9
					// * it does mess with your hash symbol (anchor?) pound sign
					// delimiter on the end of the URL
				}
				else {
					ignoreHashChange = false;   
				}
			};
		}
	}
	
	function borrarNotificacion()
	{
		arrayNotificaciones = $('div.mensaje_resultado.normal');
		
		for(i = 0; i < arrayNotificaciones.length; i++)
		{
			arrayNotificaciones[i].style.display = "none";
		}
	}
	
	function contacto () {
		showLoading();
		$('#contactoModal').closeModal();
		setTimeout(function () {
			document.contacto.submit();
		    }, 1000);
	}

	function registrarse () {
		showLoading();
		$('#contactoModal').closeModal();
		setTimeout(function () {
			document.contacto.submit();
		    }, 1000);
	}

	function verificacion () {
		showLoading();
		$('#contactoModal').closeModal();
		setTimeout(function () {
			document.contacto.submit();
		    }, 1000);
	}

	function iniciarSesion () {
		showLoading();
		$('#loginModal').closeModal();
		setTimeout(function () {
			document.login.submit();
		    }, 1000);
	}

	function showLoading () {
		$('.loading')[0].style.visibility = 'visible';
	}

	function hideLoading () {
		$('.loading')[0].style.visibility = 'hidden';
	}