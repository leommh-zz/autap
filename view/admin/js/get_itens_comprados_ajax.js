$(document).ready( function(){
	var offset = 0;

   var id_compra;
	
   $(document).on('click', '.info_compra', function(){
         id_compra = $(this).data('info_compra');
         $('#modal_compra_view').modal({backdrop: 'static', keyboard: false});
         
         denovo();

         $("#alterar_compra_view").show();
         $("#fechar_compra_view").show();
         $("#cancelar_compra_view").hide();
         $("#concluir_compra_view").hide();

         $.ajax({
            url: "registros/altera_compra.php",
            method: "post",
            data: {id_compra: id_compra, decisao: 1},
            success: function(data) {  
               var resultado = JSON.parse(data);
               $("#data_comprada").val(resultado[0]);
               $("#empresa_comprada option[value="+resultado[3]+"] ").prop("selected", "selected");
               $("#valor_total_comprada").val(resultado[1]);

            }
         });

      $("#form_view_compra :input").prop("disabled", true);
         $("#alterar_compra_view").prop("disabled", false);
         $("#fechar_compra_view").prop("disabled", false);

      $("#alterar_compra_view").click(function(){
         $("#form_view_compra :input").prop("disabled", false);
         $(".campo_itens_altera").prop("disabled", true);

         $("#alterar_compra_view").hide();
         $("#fechar_compra_view").hide();
         $("#cancelar_compra_view").show();
         $("#concluir_compra_view").show();

         $("#cancelar_compra_view").prop("disabled", false);
         $("#concluir_compra_view").prop("disabled", false);

      });
      return false;
   });

      //Compra - Validar
   $("#form_view_compra").validate({
        rules : {
         quantidade:{
            required:true,
         },
         itens:{
            required:true,
         },
         valor_unitario:{
            required:true,
         },
         valor_total:{
            required:true,
         },
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
         quantidade:{
            required:"Informe a Quantidade",
         },
         itens:{
            required:"Escolha o Item",
         },
         valor_unitario:{
            required:"Informe o Valor Unitario",
         },
         valor_total:{
            required:"Informe o Total",
         },
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
      
            $.ajax({
               url: "registros/altera_compra.php",
               method: "post",
               data: $('#form_view_compra').serialize()+'&'+$.param({id_compra: id_compra, decisao: 3}),
               success: function(data){
              
                  $('#modal_alterado_concluido').modal();
                  $('#btn_alterado_ok').click(function(){
                     location.reload();
                  });
               }
            });
      }
     }
   });   



	function denovo(){
		$.ajax({
	        url: "pesquisas/get_table.php",
	        method: 'post',
	        data: {registros_por_pagina: $('#registros_por_pagina').val(), offset: 0, opcao: 'item_compra', utilitaria: id_compra},
	   		}).done(function(retorno_requisicao){
	   			$('#tabela_itens_comprados').html(retorno_requisicao);

         var pagina_clicada = $('.btn-atual').data('pagina_clicada');

         if (pagina_clicada == 1) {
           $('#btn_voltar').prop("disabled", true);
         }

         if (pagina_clicada == 1) {
           $('#btn_voltar').prop("disabled", true);
         }

         if ($('#btn-final').length) {
            $('#btn-final').prop("disabled", true);
         }

         if ($('.btn-vai').length) {
            // $('#btn_').hide();
            // $('#btn_11').removeClass('hide');

         }

				
			$('.paginar').click(function(){

            var pagina_clicada = $(this).data('pagina_clicada');

            pagina_clicada = pagina_clicada - 1; //necessário para ajustar o parâmetro offset

            //recupera os parametros de paginacao do formulario
            var registros_por_pagina = $('#registros_por_pagina').val();
            var pagina_atual = $('#pagina_atual').val();

            var offset_atualizado = pagina_clicada * registros_por_pagina;
            //aplica o valor atualizado do offset ao campo do form
            offset = offset_atualizado;

   				denovo();
	      });



			}); 
	}

	

	});