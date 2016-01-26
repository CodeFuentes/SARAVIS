	$(function() {
	
		$("#numFirmasDoc").change(function()
		{
			valor = $("#numFirmasDoc").val();

			i= 0;
			
			for(i = 1; i <= valor; i++)
			{
				$("li.display" + i).css('display', 'inline');
				console.log("inline: " + i);
			}
			
			k = 0;
			
			for(j = valor; j <= 5; j++)
			{
				k = parseInt(j) + 1;
				$("li.display" + k).css('display', 'none');
				console.log("none: " + k);
			}
			
		});
	});