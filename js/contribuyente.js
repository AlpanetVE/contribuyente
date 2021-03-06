$(document ).ready(function() {

	paginar(1,$('#filtro'));
	
	

	$(document).on("click",".imprimirContribuyente",function(e){
		e.preventDefault();

		var rif					= $('#rif').val();
		var id_estado			= $('#estado').val();
		var id_municipio		= $('#municipio').val();
		var id_parroquia		= $('#parroquia').val();
		var estatus_id			= $('#estatus_id').val();
		var rifComienza			= $('#rifComienza').val();
		var rifTermina			= $('#rifTermina').val();

		
		window.open('imprimir_contribuyente.php?rif='+rif+'&id_estado='+id_estado+'&id_municipio='+id_municipio+'&id_parroquia='+id_parroquia+'&estatus_id='+estatus_id+'&rifComienza='+rifComienza+'&rifTermina='+rifTermina, '_blank');

	});

	$(document).on("click",".botonPaginador, .navegador",function(e){
		e.preventDefault();
		var form 	= $('#filtro');
		var funcion = $(this).data("funcion");

		if(funcion == 'anterior2'){
			pagina = 1;
		}
		else if(funcion == 'anterior1'){
			pagina = parseInt(form.find('#pagina').val())-1;
		}
		else if(funcion == 'siguiente1'){
			pagina = parseInt(form.find('#pagina').val())+1;
		}
		else if(funcion == 'siguiente2'){
			pagina = parseInt(form.find('#cant').val())+1;
		}else{
			pagina 	= $(this).data("pagina");
		}
		
		form.find('#pagina').val(pagina);
		paginar(pagina,form);
	});

	function paginar(pagina, form){
		var total	= $("#paginacion").data("total");
		var url		= $("#paginacion").data("url");

		loadingAjax(true);
		$.ajax({
			url:url,
			data:form.serialize(),
			type:"POST",
			dataType:"html",
			success:function(data){
				$("#ajaxCont").html(data);
				paginador(pagina,total);
				loadingAjax(false);
			}
		});
	}
	function paginador(pagina,total){

		$("#paginacion li").removeClass("active");
		$('#paginacion').find('[data-pagina=' + pagina + ']').parent().addClass("active");
		
		$("#inicio").text(((pagina-1)*25)+1);
		if(total<pagina*25){
			$("#final").text(total + " de ");
		}else{
			$("#final").text(pagina*25 + " de ");
		}
		$('html,body').animate({
			scrollTop: 0
		}, 200);
		if(pagina % 10 == 1){
			$("#paginacion #anterior1").addClass("hidden");
		}else{
			$("#paginacion #anterior1").removeClass("hidden");
		}
		$("#principal #paginacion").data("paginaactual",pagina);
		if(pagina*25>=total || pagina % 10==0){
			$("#paginacion #siguiente1").addClass("hidden");
		}else{
			$("#paginacion #siguiente1").removeClass("hidden");
		}
	}
});