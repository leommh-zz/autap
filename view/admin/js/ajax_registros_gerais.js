$(document).ready(function(){


function fecha_modal(){
    $('.modal').modal('hide');
    $('.modal-backdrop').hide();
    $("body").css({"overflow":"visible"});
}

$("#valor_unitario").maskMoney({
     thousands: ".",
     decimal: ","
});

$("#logout").click(function(){
	$('#modal_logout').modal();
	$('#btn_logout').click(function(){
		window.location.assign("../../logout_acesso.php");
	});
});


$("[name='status']").bootstrapSwitch();

//Variáveis Globais
	var validacao_estado = false;
	var id_estado;
	var id_cidade;
	var id_onibus;

//Funções
	//Ajax Simples
	function cadastro_ajax_simples(id_form, page){
		$.ajax({
	    	url: page,
	    	method: "post",
	    	data: $('#'+id_form).serialize(),
	    	success: function(data) {
	    		$('#modal_cadastro_concluido').modal();
	    		$('#btn_cadastro_ok').click(function(){
	    			location.reload();
	    		});
	      	}
		});
		return false;
	}

	function limpar_compra(){
		$.ajax({
	    	url: 'registros/registra_itens_compra.php',
	    	method: "post",
	    	data: {decisao: 3},
	    	success: function(data) {
	    		document.getElementById("form_cadastro_item_compra").reset();
	    		document.getElementById("form_cadastro_compra").reset();
	    		$("#tabela_itens_compra").html('');
	      	}
		});
		return false;
	}

	function carrinho_vazio(){
		if($("#tabela_itens_compra").is(':empty')){
			$("#main_tabela_itens_compra").hide();
			$(".row_carrinho").show();
		}else{
			$("#main_tabela_itens_compra").show();
			$(".row_carrinho").hide();
		}
	}

//Cadastros
	//Modals
	$(".btn_novo_item").click(function(){
   		$('.modal_item').modal({backdrop: 'static', keyboard: false});
	});

	$(".btn_nova_cidade").click(function(){
   		$('#modal_cadastro_cidade').modal({backdrop: 'static', keyboard: false});
	});

	$(".btn_novo_estado").click(function(){
   		$('#modal_cadastro_estado').modal({backdrop: 'static', keyboard: false});
	});

	$(".btn_nova_pessoa").click(function(){
   		$('.modal_pessoas').modal({backdrop: 'static', keyboard: false});
	});

	$(".btn_novo_onibus").click(function(){
   		$('#modal_cadastro_onibus').modal({backdrop: 'static', keyboard: false});
	});

	$(".btn_novo_plano_contas").click(function(){
   		$('.modal_plano_contas').modal({backdrop: 'static', keyboard: false});
	});


	$(".btn_nova_conta_a_pagar").click(function(){
   		$('.modal_contas_a_pagar').modal({backdrop: 'static', keyboard: false});
	});

	$(".btn_nova_compra").click(function(){
   		$('#modal_compra').modal({backdrop: 'static', keyboard: false});
   		$("#valor_total_compra").prop("disabled", true);
   		carrinho_vazio();
   		limpar_compra();
	});



	//Estado
	$("#form_cadastro_estado").validate({
        rules : {
             estado:{
                    required:true,
             },
             sigla:{
                    required:true,
                    maxlength: 2,
            }
       	},
       	messages:{
            estado:{
                    required:"Informe o Nome do Estado"
            },
            sigla:{
                    required:"Informe a Sigla",
                    maxlength:"Máximo de Caracteres: 2"
           	}
       	},
		invalidHandler: function() {
		    validacao_estado = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_estado = true;

       		if (validacao_estado == true){
				cadastro_ajax_simples('form_cadastro_estado', 'registros/registra_estado.php');
			}
	  	}
	});

	//Cidade
	$("#form_cadastro_cidade").validate({
        rules : {
             estado:{
                    required:true,
             },
             nome:{
                    required:true,
            }
       	},
       	messages:{
            estado:{
                    required:"Selecione o Estado"
            },
            nome:{
                    required:"Informe o Nome",
           	}
       	},
		invalidHandler: function() {
		    validacao_estado = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_estado = true;

       		if (validacao_estado == true){
				cadastro_ajax_simples('form_cadastro_cidade', 'registros/registra_cidade.php');
			}
	  	}
	});

	//Plano de Contas
	$("#form_cadastro_plano_contas").validate({
        rules : {
            plano_contas:{
                    required:true,
            },
            descricao:{
                    required:true,
            }
       	},
       	messages:{
            plano_contas:{
                    required:"Selecione o tipo"
            },
            descricao:{
                    required:"Informe uma breve Descrição do Plano"
            }
       	},
		invalidHandler: function() {
		    validacao_plano_contas = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_plano_contas = true;

       		if (validacao_plano_contas == true){
				cadastro_ajax_simples('form_cadastro_plano_contas', 'registros/registra_plano_contas.php');
			}
	  	}
	});

	//Item
	$("#form_cadastro_item").validate({
        rules : {
            nome:{
                    required:true,
            },
            tipo:{
                    required:true,
            },
            quantidade:{
                    required:true,
            },
            peso:{
                    required:true,
            },
            marca:{
                    required:true,
            }
       	},
       	messages:{
            nome:{
                    required:"Informe o Nome"
            },
            tipo:{
                    required:"Selecione o Tipo"
            },
            quantidade:{
                    required:"Informe a Quantidade"
            },
            peso:{
                    required:"Informe o Peso"
            },
            marca:{
                    required:"Informe a Marca"
            }
       	},
		invalidHandler: function() {
		    var validacao_item = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_item = true;

       		if (validacao_item == true){
				cadastro_ajax_simples('form_cadastro_item', 'registros/registra_item.php');
			}
	  	}
	});

	$("#form_cadastro_item_compra").validate({
        rules : {
            quantidade:{
                    required:true,
            },
            itens:{
                    required:true,
            },
            valor_unitario:{
                    required:true,
            }
       	},
       	messages:{
            quantidade:{
                    required:"Informe a Quantidade"
            },
            itens:{
                    required:"Selecione os Itens"
            },
            valor_unitario:{
                    required:"Informe o Valor Unitario"
            }
       	},
		invalidHandler: function() {
		    var validacao_item_compra = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_item_compra = true;

       		if (validacao_item_compra == true){

				$.ajax({
			    	url: 'registros/registra_itens_compra.php',
			    	method: "post",
			    	data: $('#form_cadastro_item_compra').serialize()+'&'+$.param({decisao: 1}),
			    	success: function(data) {
			    		var resultado = JSON.parse(data);
			    		$("#main_tabela_itens_compra").show();
						$(".row_carrinho").hide();
			    		$("#tabela_itens_compra").append(function() {
			    			var conteudo = '<tr id='+resultado['id_item']+'><td>'+resultado['quantidade']+
			    			'</td><td>'+resultado['descricao']+
			    			'</td><td class="vu_tabela">'+resultado['valor_unitario']+
			    			'</td><td class="vt_tabela">'+resultado['valor_total']+
			    			'</td></tr>';
						  return conteudo;
						});

			    		$.ajax({
					    	url: 'registros/registra_itens_compra.php',
					    	method: "post",
					    	data: {decisao: 2},
					    	success: function(data) {
					    		$("#valor_total_compra").prop("disabled", false);
					    		$("#valor_total_compra").val(data);
					   //  		$("#valor_total_compra").maskMoney({
								//      decimal: ",",
								//      thousands: "."
								// });
								$("#valor_total_compra").prop("disabled", true);

					      	}
						});
						return false;//AJAX2

			      	}
				});
				return false;//AJAX


			}
	  	}
	});

	//Onibus
	$("#form_cadastro_onibus").validate({
        rules : {
            modelo:{
                required:true,
            },
            ano:{
                required:true,
            },
            assentos:{
                required:true,
            },
            placa:{
                required:true,
            },
            empresa:{
                required:true,
            },
            motorista:{
                required:true,
            }
       	},
       	messages:{
            modelo:{
                    required:"Informe o Modelo"
            },
            ano:{
                    required:"Selecione o Ano"
            },
            assentos:{
                    required:"Informe os Assentos"
            },
            placa:{
                    required:"Informe a Placa"
            },
            empresa:{
                    required:"Selecione a Empresa"
            },
            motorista:{
                    required:"Selecione o Motorista"
            }
       	},
		invalidHandler: function() {
		    var validacao_onibus = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_onibus = true;

       		if (validacao_onibus == true){
				cadastro_ajax_simples('form_cadastro_onibus', 'registros/registra_onibus.php');
			}
	  	}
	});

	// Compra
	$("#form_cadastro_compra").validate({
        rules : {
            data_nascimento:{
                    required:true,
            },
            valor_total:{
                    required:true,
            },
            empresa:{
                    required:true,
            }
       	},
       	messages:{
            data_nascimento:{
                    required:"Informe a Data",
            },
            valor_total:{
                    required:"Informe o Valor",
            },
            empresa:{
                    required:"Informe o Fornecedor",
            }
       	},
		invalidHandler: function() {
		    var validacao_compra = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_compra = true;

       		if (validacao_compra == true){

       			if($("#tabela_itens_compra").is(':empty')){
			    	alert('Nenhum Item Cadastrado');
				}else{
					cadastro_ajax_simples('form_cadastro_compra', 'registros/registra_compra.php');
				}
			}
	  	}
	});


	// Contas a Pagar
	$("#form_cadastro_cp").validate({
        rules : {
            compra_cp:{
                    required:true,
            },
            fornecedor_cp:{
                    required:true,
            },
            data_nascimento:{
                    required:true,
            },
            valor_total:{
                    required:true,
            }
       	},
       	messages:{
            compra_cp:{
                    required: "Não pode ficar em branco",
            },
            fornecedor_cp:{
                    required: "Não pode ficar em branco",
            },
            data_nascimento:{
                    required: "Selecione uma Data",
            },
            valor_total:{
                    required: "Não pode ficar em branco",
            }
       	},
		invalidHandler: function() {
		    var validacao_contas = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_contas = true;

       		if (validacao_contas == true){

       			$("#fornecedor_cp").prop("disabled", false);
		      	$("#valor_total_cp").prop("disabled", false);
				$("#compra_cp").prop("disabled", false);


				$.ajax({
			    	url: 'registros/registra_contas_a_pagar.php',
			    	method: "post",
			    	data: $('#form_cadastro_cp').serialize(),
			    	success: function(data) {
			    		$('#modal_cadastro_concluido').modal();
			    		$('#btn_cadastro_ok').click(function(){
			    			location.reload();
			    		});
			      	}
				});

       			$("#fornecedor_cp").prop("disabled", true);
		      	$("#valor_total_cp").prop("disabled", true);
				$("#compra_cp").prop("disabled", true);

				return false;
			}
	  	}
	});

//Alterações

	//Estado - Alterar
	$(document).on('click', '.alterar_estado', function(){
   		id_estado = $(this).data('alt_estado');
   		$('#modal_alterar_estado').modal({backdrop: 'static', keyboard: false});

   		$.ajax({
	    	url: "registros/altera_estado.php",
	    	method: "post",
	    	data: {id_estado: id_estado, decisao: 1},
	    	success: function(data) {
				var resultado = JSON.parse(data);
				$('#altera_estado_nome').val(resultado[0]);
				$('#altera_estado_sigla').val(resultado[1]);

				if(resultado[2] == 0){
					$('#altera_status_estado').bootstrapSwitch('state', false);
				}
	      	}
		});
		return false;
	});

	//Cidade - Alterar
	$(document).on('click', '.alterar_cidade', function(){
   		id_cidade = $(this).data('alt_cidade');
   		$('#modal_alterar_cidade').modal({backdrop: 'static', keyboard: false});

   		$.ajax({
	    	url: "registros/altera_cidade.php",
	    	method: "post",
	    	data: {id_cidade: id_cidade, decisao: 1},
	    	success: function(data) {
				var resultado = JSON.parse(data);
				$("#altera_pf_estado option[value='"+resultado[0]+"']").prop('selected', true);
				$('#altera_cidade_nome').val(resultado[1]);

				if(resultado[2] == 0){
					$('#altera_status_cidade').bootstrapSwitch('state', false);
				}
	      	}
		});
		return false;
	});

	//Plano de Contas - Alterar
	$(document).on('click', '.alterar_plano_contas', function(){
   		id_plano_contas = $(this).data('alt_plano_contas');
   		$('#modal_alterar_plano_contas').modal({backdrop: 'static', keyboard: false});

   		$.ajax({
	    	url: "registros/altera_plano_contas.php",
	    	method: "post",
	    	data: {id_plano_contas: id_plano_contas, decisao: 1},
	    	success: function(data) {
				var resultado = JSON.parse(data);
				$('#altera_descricao').val(resultado[0]);

				if(resultado[1] == 'Credora'){
					$("#altera_natureza_conta option[value='Credora']").prop('selected', 'selected');
				}else if(resultado[1] == 'Devedora'){
					$("#altera_natureza_conta option[value='Devedora']").prop('selected', 'selected');
				}

				$("#altera_natureza_conta").attr('disabled', 'disabled');
	      	}
		});
		return false;
	});

	//Item - Alterar
	$(document).on('click', '#btn_info_produto', function(){
   		id_item = $(this).data('info_item');
   		$('#modal_alterar_item').modal({backdrop: 'static', keyboard: false});

   		$.ajax({
	    	url: "registros/altera_item.php",
	    	method: "post",
	    	data: {id_item: id_item, decisao: 1},
	    	success: function(data) {

				var resultado = JSON.parse(data);

				if(resultado[1] == 'Serviço'){
					$("#altera_tipo option[value='Serviço']").prop('selected', 'selected');
				}else if(resultado[1] == 'Produto'){
					$("#altera_tipo option[value='Produto']").prop('selected', 'selected');
				}

				var valor = $("#altera_tipo option:selected").val();

				if (valor == "Serviço") {
				    $("#label_altera_nome_item").show();
					$("#label_altera_quantidade_item").hide();
					$("#label_altera_marca_item").hide();
					$("#label_altera_genero_item").hide();
					$("#label_altera_peso_item").hide();
			  	}else if (valor == "Produto"){
				    $("#label_altera_nome_item").show();
					$("#label_altera_quantidade_item").show();
					$("#label_altera_marca_item").show();
					$("#label_altera_genero_item").show();
					$("#label_altera_peso_item").show();
			  	}else{
			    	$("#label_altera_nome_item").hide();
					$("#label_altera_quantidade_item").hide();
					$("#label_altera_marca_item").hide();
					$("#label_altera_genero_item").hide();
					$("#label_altera_peso_item").hide();
			  	}

			  	$("#altera_tipo").prop('disabled', true);


				$('#altera_nome_item').val(resultado[0]);
				$('#altera_quantidade_item').val(resultado[3]);
				$('#altera_marca_item').val(resultado[4]);
				$('#altera_genero_item').val(resultado[5]);
				$('#altera_peso_item').val(resultado[6]);





				$("#altera_status_item").bootstrapSwitch('disabled', false);
				if(resultado[2] == 0){
					$('#altera_status_item').bootstrapSwitch('state', false);
				}else{
					$('#altera_status_item').bootstrapSwitch('state', true);

				}
				$("#altera_status_item").bootstrapSwitch('disabled',true);

				$("#form_alterar_item :input").prop("disabled", true);
				$("#altera_status_item").bootstrapSwitch('disabled', true);

				$("#alterar_form_alterar_item").show();
				$("#alterar_form_alterar_item").prop("disabled", false);
				$("#fechar_form_alterar_item").show();
				$("#fechar_form_alterar_item").prop("disabled", false);
				$("#cancelar_form_alterar_item").hide();
				$("#btn_alterar_item").hide();

				$("#alterar_form_alterar_item").click(function(){
					$("#alterar_form_alterar_item").hide();
					$("#fechar_form_alterar_item").hide();
					$("#cancelar_form_alterar_item").show();
					$("#btn_alterar_item").show();

					$("#form_alterar_item :input").prop("disabled", false);

					$("#altera_tipo").prop('disabled', true);

					$("#altera_status_item").bootstrapSwitch('disabled', false);

				});


	      	}
		});
		return false;
	});

	//Ônibus - Alterar
	$(document).on('click', '.alterar_onibus', function(){
   		id_onibus = $(this).data('alt_onibus');
   		$('#modal_alterar_onibus').modal({backdrop: 'static', keyboard: false});

   		$.ajax({
	    	url: "registros/altera_onibus.php",
	    	method: "post",
	    	data: {id_onibus: id_onibus, decisao: 1},
	    	success: function(data) {

				var resultado = JSON.parse(data);
				var campos_onibus = ['#altera_modelo_onibus', '#altera_placa_onibus', '#altera_ano_onibus',
				'#altera_assento_onibus'];

				for (cont=0; cont < campos_onibus.length; cont++){
					$(campos_onibus[cont]).val(resultado[cont]);
				}


				$("#altera_empresa_onibus option[value='"+resultado[4]+"']").prop('selected', 'selected');
				$("#altera_motorista_onibus option[value='"+resultado[5]+"']").prop('selected', 'selected');


				if(resultado[6] == 0){
					$('#altera_status_onibus').bootstrapSwitch('state', false);
				}


	      	}
		});
		return false;
	});

	//Contas à Pagar - Visualizar
	$(document).on('click', '.info_contas_a_pagar', function(){
   		id_contas_a_pagar = $(this).data('info_contas_a_pagar');

   		$('#modal_view_contas_a_pagar').modal({backdrop: 'static', keyboard: false});
	    $('.btn_cadastro_contas_a_pagar').hide();


   		$.ajax({
	    	url: "registros/altera_contas_a_pagar.php",
	    	method: "post",
	    	data: {id_contas_a_pagar: id_contas_a_pagar, decisao: 1},
	    	success: function(data) {
				var resultado = JSON.parse(data);
				$('#view_data_cp').val(resultado[0]);
				$('#view_valor_total_cp').val(resultado[1]);
				$('#view_compra_cp').val(resultado[3]);
				$('#view_fornecedor_cp').val(resultado[4]);


				$.ajax({
			    	url: "registros/altera_contas_a_pagar.php",
			    	method: "post",
			    	data: {id_contas_a_pagar: id_contas_a_pagar,  decisao: 2},
			    	success: function(data) {


			    	$("#conteudo_extra_form_view_cp").show();
						$("#conteudo_extra_form_view_cp").html(
							"<div class='row'> <div class='col-md-12'>"
								+"</br><div id='input_parcelas'></div>"
								+"<div class='col-md-12'></br><div id='tabela_parcelas'></div></div>"
							+" </div> </div>"
						);


						$("#tabela_parcelas").html(data);
						$("[name='status']").bootstrapSwitch();

						$("#form_view_cp :input").prop("disabled", true);


	   					$('#fechar_form_view_cp').prop("disabled", false);



						$('.bootstrap-switch').prop("disabled", false);

						$('.bootstrap-switch').on('switchChange.bootstrapSwitch', function(event, state) {

							function apenasNumeros(string){
								var numsStr = string.replace(/[^0-9]/g, '');
								return parseInt(numsStr);
							}


							var class_switch = $(this).attr('class');
							var id_quitada = apenasNumeros(class_switch);
							var btn_estado = state;

   							$.ajax({
						    	url: "registros/altera_contas_a_pagar.php",
						    	method: "post",
						    	data: {id_btn_quitada: id_quitada, btn_estado: btn_estado, decisao: 5},
						    	success: function(data) {
		    			    		//$('#modal_alterado_concluido').modal();
		    			    		//alert(data);

		    			    		aviso('Alterado com Sucesso');

								}
							});

						});

			      	}
				});
				return false;


				// $("#altera_natureza_conta").attr('disabled', 'disabled');
	      	}
		});
		return false;
	});




	//Estado - Validar
	$("#form_alterar_estado").validate({
        rules : {
             estado:{
                    required:true,
             },
             sigla:{
                    required:true,
                    maxlength: 2,
            }
       	},
       	messages:{
            estado:{
                    required:"Informe o Nome do Estado"
            },
            sigla:{
                    required:"Informe a Sigla",
                    maxlength:"Máximo de Caracteres: 2"
           	}
       	},
		invalidHandler: function() {
		    validacao_estado = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_estado = true;

       		if (validacao_estado == true){
				$.ajax({
			    	url: "registros/altera_estado.php",
			    	method: "post",
			    	data: $('#form_alterar_estado').serialize()+'&'+$.param({id_estado: id_estado, decisao: 2}),
			    	success: function(data){
			    		$('#modal_alterado_concluido').modal();
			    		$('#btn_alterado_ok').click(function(){
			    			location.reload();
			    		});
			    	}
				});
				return false;
			}
	  	}
	});

	//Cidade - Validar
	$("#form_alterar_cidade").validate({
        rules : {
             estado:{
                    required:true,
             },
             nome:{
                    required:true,
            }
       	},
       	messages:{
            estado:{
                    required:"Selecione o Estado"
            },
            nome:{
                    required:"Informe o Nome",
           	}
       	},
		invalidHandler: function() {
		    validacao_cidade = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_cidade = true;

       		if (validacao_cidade == true){
				$.ajax({
			    	url: "registros/altera_cidade.php",
			    	method: "post",
			    	data: $('#form_alterar_cidade').serialize()+'&'+$.param({id_cidade: id_cidade, decisao: 2}),
			    	success: function (data) {
			    		$('#modal_alterado_concluido').modal();
			    		$('#btn_alterado_ok').click(function(){
			    			location.reload();
			    		});
			    	}
				});
				denovo();
				return false;
			}
	  	}
	});

	//Plano de Contas - Validar
	$("#form_alterar_plano_contas").validate({
        rules : {
            plano_contas:{
                    required:true,
            },
            descricao:{
                    required:true,
            }
       	},
       	messages:{
            plano_contas:{
                    required:"Selecione o tipo"
            },
            descricao:{
                    required:"Informe uma breve Descrição do Plano"
            }
       	},
		invalidHandler: function() {
		    validacao_plano_contas = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_plano_contas = true;

       		if (validacao_plano_contas == true){
				$.ajax({
			    	url: "registros/altera_plano_contas.php",
			    	method: "post",
			    	data: $('#form_alterar_plano_contas').serialize()+'&'+$.param({id_plano_contas: id_plano_contas, decisao: 2})
				});
				denovo();
				return false;
			}
	  	}
	});

	//item - Validar
	$("#form_alterar_item").validate({
        rules : {
            altera_nome:{
                    required:true,
            },
            altera_tipo:{
                    required:true,
            },
            altera_quantidade:{
                    required:true,
            },
            altera_peso:{
                    required:true,
            },
            altera_marca:{
                    required:true,
            }
       	},
       	messages:{
            altera_nome:{
                    required:"Informe o Nome"
            },
            altera_tipo:{
                    required:"Selecione o Tipo"
            },
            altera_quantidade:{
                    required:"Informe a Quantidade"
            },
            altera_peso:{
                    required:"Informe o Peso"
            },
            altera_marca:{
                    required:"Informe a Marca"
            }
       	},
		invalidHandler: function() {
		    var validacao_item = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_item = true;

       		if (validacao_item == true){
				$.ajax({
			    	url: "registros/altera_item.php",
			    	method: "post",
			    	data: $('#form_alterar_item').serialize()+'&'+$.param({id_item: id_item, decisao: 2}),
			    	success: function(data){

			    		$('#modal_alterado_concluido').modal();
	    				$('#btn_alterado_ok').click(function(){
	    					location.reload();
	    				});
			    	}
				});
				return false;
			}
	  	}
	});

	$("#form_alterar_onibus").validate({
        rules : {
            modelo:{
                required:true,
            },
            ano:{
                required:true,
            },
            assentos:{
                required:true,
            },
            placa:{
                required:true,
            },
            empresa:{
                required:true,
            },
            motorista:{
                required:true,
            }
       	},
       	messages:{
            modelo:{
                    required:"Informe o Modelo"
            },
            ano:{
                    required:"Selecione o Ano"
            },
            assentos:{
                    required:"Informe os Assentos"
            },
            placa:{
                    required:"Informe a Placa"
            },
            empresa:{
                    required:"Selecione a Empresa"
            },
            motorista:{
                    required:"Selecione o Motorista"
            }
       	},
		invalidHandler: function() {
		    var validacao_onibus = false;
		    return false;
	  	},
	    submitHandler: function(form) {
       		validacao_onibus = true;

       		if (validacao_onibus == true){
				$.ajax({
			    	url: "registros/altera_onibus.php",
			    	method: "post",
			    	data: $('#form_alterar_onibus').serialize()+'&'+$.param({id_onibus: id_onibus, decisao: 2}),
			    	success: function(data){
			    		$('#modal_alterado_concluido').modal();
	    				$('#btn_alterado_ok').click(function(){
	    					location.reload();
	    				});
			   		}
				});
				return false;
			}
	  	}
	});


//Exclusões

	//Estado
	$(document).on('click', '.deletar_estado', function(){
   		id_estado = $(this).data('del_estado');
   		$('#modal_excluir_estado').modal({backdrop: 'static', keyboard: false});

   		$("#btn_excluir_estado").click(function(){
	   		$.ajax({
		    	url: "registros/altera_estado.php",
		    	method: "post",
		    	data: ({id_estado: id_estado, decisao: 3}),
		    	success: function(data){
		    	}
			});
			location.reload();
			return false;
		});
   	});


	//Cidade
	$(document).on('click', '.deletar_cidade', function(){
   		id_cidade = $(this).data('del_cidade');
   		$('#modal_excluir_cidade').modal({backdrop: 'static', keyboard: false});

   		$("#btn_excluir_cidade").click(function(){
	   		$.ajax({
		    	url: "registros/altera_cidade.php",
		    	method: "post",
		    	data: ({id_cidade: id_cidade, decisao: 3}),
			});
			location.reload();
			return false;
   		});
	});

	//Plano de Contas - Deletar
	$(document).on('click', '.deletar_plano_contas', function(){
   		id_plano_contas = $(this).data('del_plano_contas');
   		$("#modal_excluir_plano_contas").modal();

   		$("#btn_excluir_plano_contas").click(function(){
	   		$.ajax({
		    	url: "registros/altera_plano_contas.php",
		    	method: "post",
		    	data: ({id_plano_contas: id_plano_contas, decisao: 3}),
		    	success: function(data){
		    	}
			});
			location.reload();
			return false;
		});
   	});

   	//Item - Deletar
	$(document).on('click', '.deletar_item', function(){
   		id_item = $(this).data('del_item');
   		$("#modal_excluir_item").modal();

   		$("#btn_excluir_item").click(function(){
	   		$.ajax({
		    	url: "registros/altera_item.php",
		    	method: "post",
		    	data: ({id_item: id_item, decisao: 3}),
		    	success: function(data){

		    	}
			});
			location.reload();
			return false;
		});
   	});

   	//Onibus - Deletar
	$(document).on('click', '.deletar_onibus', function(){
   		id_onibus = $(this).data('del_onibus');
   		$("#modal_excluir_onibus").modal();

   		$("#btn_excluir_onibus").click(function(){
	   		$.ajax({
		    	url: "registros/altera_onibus.php",
		    	method: "post",
		    	data: ({id_onibus: id_onibus, decisao: 3}),
		    	success: function(data){

		    	}
			});
			location.reload();
			return false;
		});
   	});


	$("#btn_cancel_compra").click(function(){
		limpar_compra();
		$('#modal_compra').modal('toggle');
	});

});
