$(document).ready( function(){

	$("#label_nome_item").hide();
	$("#label_quantidade_item").hide();
	$("#label_marca_item").hide();
	$("#label_genero_item").hide();
	$("#label_peso_item").hide();




	$('#tipo_item').on('change', function(){
	    var value = this.value;
      
        if (value == 'Serviço'){
        	$("#label_nome_item").show();
			$("#label_quantidade_item").hide();
			$("#label_marca_item").hide();
			$("#label_genero_item").hide();
			$("#label_peso_item").hide();
        }else if (value == 'Produto'){
        	$("#label_nome_item").show();
			$("#label_quantidade_item").show();
			$("#label_marca_item").show();
			$("#label_genero_item").show();
			$("#label_peso_item").show();
        }else{
    		$("#label_nome_item").hide();
			$("#label_quantidade_item").hide();
			$("#label_marca_item").hide();
			$("#label_genero_item").hide();
			$("#label_peso_item").hide();
        }

	});

//Alterar

	$("#label_altera_nome_item").hide();
	$("#label_altera_quantidade_item").hide();
	$("#label_altera_marca_item").hide();
	$("#label_altera_genero_item").hide();
	$("#label_altera_peso_item").hide();


});