$(document).ready(function(){

	$('.campo_cidade').prop("disabled", true);
	var valor_estado;

	$.ajax({
    	url: "pesquisas/get_estados_select.php",
    	method: "post",
    	data: {select_estado: true},
    	success: function(data) {
      		$(".campo_estado").html(data);

			    $(".campo_estado").on('change', function(e){
				  valor_estado = ($(this).val());

				  if (valor_estado !== 'Selecione') {
				  	$('.campo_cidade').prop("disabled", false);
				  }else if (valor_estado == 'Selecione'){
				  	$('.campo_cidade').prop("disabled", true);
				  }

				 	$.ajax({
				    	url: "pesquisas/get_cidades_select.php",
				    	method: "post",
				    	data: {estado: valor_estado},
				    	success: function(data) {
	      					$(".campo_cidade").html(data);
				      	}
			  		});
				  return false;
				});
      	}
  	});

	

});