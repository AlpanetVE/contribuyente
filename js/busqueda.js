/**
 * @author darwin
 */
$(document).ready(function() {
	
	$("#filtrobuscar").click(function(e){
		e.preventDefault();
		var form = $( "#filtro" );
		var method = "&method=searchfilter";
		
$.ajax({
			url: form.attr('action'), // la URL para la petición
           data: form.serialize(), // la información a enviar
            type: 'POST', // especifica si será una petición POST o GET
            dataType: 'html', // el tipo de información que se espera de respuesta            
            success: function (data) {            	
            	// código a ejecutar si la petición es satisfactoria;
            	// código a ejecutar si la petición es satisfactoria;
            	// console.log(data);
            $("#ajaxCont").html(data);	
	         /*   if (data.result === 'vacio'){
	            	 $('#ajaxContainer').html("VACIO");
	            	
	            } if(data.result==='OK'){
	            	jQuery.each(data.campos, function(key, value){
	      $('#ajaxContainer').html('<tr> <td>'+ value +'</td> <td>'+ value +'</td> <td>'+ value +'</td> <td> '+ value +'</td> <td>'+ value +'</td> </tr>');
		console.log("INDEX: " + key + " VALUE: " + value); 
	});
	            	
	            	
                } */
          	},// código a ejecutar si la petición falla;
            error: function (xhr, status) {
            	alert(status);
            }
        });
	
	});
	
});