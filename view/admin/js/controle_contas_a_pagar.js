$(document).ready( function(){

	var valor = 0;
	var data_pagamento = 0;
	var valor_total = 0;

	$(".btn_nova_conta_a_pagar").click(function(){
		$("#compra_cp").prop("disabled", false);
  		$("#label_fornecedor_cp").hide();
  		$("#label_valor_total_cp").hide();
  		$("#label_data_compra_cp").hide();


   		$("#label_data_cp").hide();
		$("#btn_cadastro_contas_a_pagar").hide();

		$.ajax({
	    	url: "pesquisas/get_compras_select.php",
	    	method: "post",
	    	data: {decisao: 1},
	    	success: function(data) {
	      		$("#compra_cp").html(data);
	      	}
	  	});

		$("#conteudo_extra_form_cadastro_cp").show();
		$("#conteudo_extra_form_cadastro_cp").html(
			"<div class='row' > <div class='col-md-12'>  "
				+"<div class='col-md-12'><p id='text_btn_pag'><b>Método de Pagamento</b></p></div>"
				+"<div class='col-md-1'> <button id='btn_av_cp' class='btn btn-warning'>À Vista</button> </div>"
				+"<div class='col-md-1'> <button id='btn_parcelado_cp' class='btn btn-warning'>Parcelado</button> </div>"
			+" </div> </div>"
			+"<div class='row'> <div class='col-md-12'>"
				+"</br><div id='input_parcelas'></div>"
				+"<div class='col-md-12'></br><div id='tabela_parcelamento'></div></div>"
			+" </div> </div>"
		);

		$("#btn_av_cp").hide();
		$("#btn_parcelado_cp").hide();
		$("#text_btn_pag").hide();

		$("#btn_av_cp").click(function(){
			$("#compra_cp").prop("disabled", true);
			$('#btn_parcelado_cp').attr('disabled', 'disabled');
			$("#label_data_cp").show();
			$("#btn_cadastro_contas_a_pagar").show();

			$("#input_parcelas").html(
				'<input type="hidden" name="tipo" value="a_vista"/>'

			);

			return false;
		});

		$("#btn_parcelado_cp").click(function(){
			$("#compra_cp").prop("disabled", true);
			$('#btn_av_cp').attr('disabled', 'disabled');
			$("#label_data_cp").show();
			$("#btn_cadastro_contas_a_pagar").show();


			$("#input_parcelas").html(
				"<div class='col-md-2'><div class='form-group'>"
				+"<label for='qtde_parcelas_cp'>Qtde. Parcelas</label>"
				+"<input type='number' class='form-control' id='qtde_parcelas_cp' placeholder='Insira...' name='qtde_parcelas_cp' min=1>"
				+"</div></div>"
				+'<input type="hidden" name="tipo" value="parcelado"/>'

			);
				

			$('#qtde_parcelas_cp').on('change', function(){
				valor = $(this).val();
				data_pagamento = $("#data_cp").val();
				valor_total = $("#valor_total_cp").val();
				
				$.ajax({
			    	url: "pesquisas/get_compras_select.php",
			    	method: "post",
			    	data: {decisao: 3, qtde_parcela: valor, data: data_pagamento, total: valor_total},
			    	success: function(data) {
			      		$("#tabela_parcelamento").html(data);
			      	}
	  			});

			});

			$("#qtde_parcelas_cp").prop("disabled", true);
			$("#btn_cadastro_contas_a_pagar").prop("disabled", true);


			$('#data_cp').on('change', function(){
				if ($("#data_cp").val() == ''){
					$("#qtde_parcelas_cp").val('');
					$("#qtde_parcelas_cp").prop("disabled", true);
					$("#tabela_parcelamento").html('');
					$("#btn_cadastro_contas_a_pagar").prop("disabled", true);
				}else{
					$("#qtde_parcelas_cp").prop("disabled", false);
					$("#btn_cadastro_contas_a_pagar").prop("disabled", false);
						
					if ($("#qtde_parcelas_cp").val() !== ''){
						$("#qtde_parcelas_cp").val('');
						$("#tabela_parcelamento").html('');
						
					}

				}
			});
			
			return false;
		});

		$('#compra_cp').on('change', function(){
			var valor = $(this).val();
			
			$.ajax({
		    	url: "pesquisas/get_compras_select.php",
		    	method: "post",
		    	data: {decisao: 2, id: valor},
		    	success: function(data) {
		      		var resultado = JSON.parse(data);

		      		$("#fornecedor_cp").prop("disabled", false);
		      		$("#valor_total_cp").prop("disabled", false);
		      		$("#data_compra_cp").prop("disabled", false);

		      		$("#label_fornecedor_cp").show();
		      		$("#label_valor_total_cp").show();
		      		$("#label_data_compra_cp").show();

		      		$("#fornecedor_cp").val(resultado[2]);
		      		$("#valor_total_cp").val(resultado[1]);
		      		$("#data_compra_cp").val(resultado[0]);

		      		$("#fornecedor_cp").prop("disabled", true);
		      		$("#valor_total_cp").prop("disabled", true);
		      		$("#data_compra_cp").prop("disabled", true);

      				$("#btn_av_cp").show();
					$("#btn_parcelado_cp").show();
					$("#text_btn_pag").show();


	      		}
	  		});


		});

	});
});