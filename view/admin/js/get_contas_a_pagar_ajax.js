$(document).ready( function(){
	var offset = 0;
	denovo();

	function denovo(){
		$.ajax({
	        url: "pesquisas/get_table.php",
	        method: 'post',
	        data: {registros_por_pagina: $('#registros_por_pagina').val(), offset: offset, opcao: 'contas_a_pagar'},
	   		}).done(function(retorno_requisicao){
	   			$('#tabela_contas_a_pagar').html(retorno_requisicao);

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