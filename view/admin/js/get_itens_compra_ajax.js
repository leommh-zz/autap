$(document).ready(function(){

	var valor_itens;

	$.ajax({
    	url: "pesquisas/get_itens_compras_select.php",
    	method: "post",
    	data: {select_itens: true},
    	success: function(data) {
      		$("#campo_itens").html(data);
      	}
  	});

	

});