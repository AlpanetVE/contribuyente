$(document ).ready(function() {
	
/* Validador de Formulario de recuperar contrase馻 */	
$('#recover-password').formValidation({
		locale: 'es_ES',
		excluded: ':disabled',
		framework : 'bootstrap',
		icon : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		addOns: { i18n: {} },
		err: { container: 'tooltip' },
		fields : {			
			rec_usuario : {validators : {
				notEmpty : {},
				blank: {}}}
		}
	}).on('success.field.fv', function(e, data) {
        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            data.fv.disableSubmitButtons(true);
        }
    }).on('err.form.fv', function(e,data) {
    	//$(".dropdown-toggle").dropdown('toggle');
    }).on('success.form.fv', function(e) {
		e.preventDefault();
		//var url=$(this).data("url");
		//var sendurl="&url="+url;
		var form = $(e.target);
		var fv = form.data('formValidation');
		var method = "&method=recover";
		$.ajax({
			url: form.attr('action'), // la URL para la petici贸n
           data: form.serialize() + method, // la informaci贸n a enviar
            type: 'POST', // especifica si ser谩 una petici贸n POST o GET
            dataType: 'json', // el tipo de informaci贸n que se espera de respuesta            
            success: function (data) {            	
            	// c贸digo a ejecutar si la petici贸n es satisfactoria;
            	// c贸digo a ejecutar si la petici贸n es satisfactoria;
            	// console.log(data);
	            if (data.result === 'error'){
	            	for (var field in data.fields) {
	        			fv
	                    // Show the custom message
	                    .updateMessage(field, 'blank', data.fields[field])
	                    // Set the field as invalid
	                    .updateStatus(field, 'INVALID', 'blank');
	        			setTimeout(function(){
	        				$("#"+field).focus();	       			
	        			}, 10);
	            	}
	            	$(".dropdown-toggle").dropdown('toggle');
	            	
	            } else if(data.result==="Actualice") {
					elId=data.id;
	            	$("#actualizar").modal('show');
	            } else{
	            	swal({
						title: "Excelente", 
						text: "&iexcl;Revisa tu correo!",
						imageUrl: "galeria/img/logos/bill-ok.png",
						timer: 2000, 
						showConfirmButton: true
						}, function(){
							//location.reload();
										
						});
                } 
          	},// c贸digo a ejecutar si la petici贸n falla;
            error: function (xhr, status) {
            	SweetError(status);
            }
        });
	});	
	
		
	$('#restablecer-password').formValidation({
		locale: 'es_ES',
		excluded: ':disabled',
		framework : 'bootstrap',
		icon : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		addOns: { i18n: {} },
		err: { container: 'tooltip' },
		fields : {			
			password : {validators : {
				notEmpty : {},
				stringLength : {min:6,max : 64}}},
			password_val : {validators : {
				identical: {field: 'password'}}}
		}
	}).on('success.field.fv', function(e, data) {
        if (data.fv.getInvalidFields().length > 0) {    // There is invalid field
            data.fv.disableSubmitButtons(true);
        }
    }).on('err.form.fv', function(e,data) {
    	//$(".dropdown-toggle").dropdown('toggle');
    }).on('success.form.fv', function(e) {
		e.preventDefault();
		var user=$(this).data("user");
		var senduser="&usuario="+user;
		var form = $(e.target);
		var fv = form.data('formValidation');
		var method = "&method=restablecer";
		$.ajax({
			url: form.attr('action'), // la URL para la petici贸n
           data: form.serialize() + method + senduser, // la informaci贸n a enviar
            type: 'POST', // especifica si ser谩 una petici贸n POST o GET
            dataType: 'json', // el tipo de informaci贸n que se espera de respuesta            
            success: function (data) {            	
            	// c贸digo a ejecutar si la petici贸n es satisfactoria;
            	// c贸digo a ejecutar si la petici贸n es satisfactoria;
            	// console.log(data);
	            if (data.result === 'error'){
	            	for (var field in data.fields) {
	        			fv
	                    // Show the custom message
	                    .updateMessage(field, 'blank', data.fields[field])
	                    // Set the field as invalid
	                    .updateStatus(field, 'INVALID', 'blank');
	        			setTimeout(function(){
	        				$("#"+field).focus();	       			
	        			}, 10);
	            	}
	            	
	            }  else{
	            	swal({
						title: "Exito", 
						text: "Se actualizo correctamente.",
						imageUrl: "galeria/img/logos/bill-ok.png",
						timer: 2000, 
						showConfirmButton: true
						}, function(){
							window.location.href = "index.php";
										
						});
                } 
          	},// c贸digo a ejecutar si la petici贸n falla;
            error: function (xhr, status) {
            	SweetError(status);
            }
        });
	});	
});
