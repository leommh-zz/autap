$(document).ready( function(){


$('.nav-tab').tab('show');

$('.dropdown-toggle').dropdown();

//Variáveis para checar checkbox
	var inicio_pf = false;
	var inicio_pj = false;
	var habilita_fornecedor = false;
	var habilita_parceiro = false;
	var habilita_fornecedor_view = false;
	var habilita_parceiro_view = false;
	var ck_estudante = 0;
	var ck_doador = 0;
	var ck_motorista = 0;
	var ck_parceiro = 0;
	var ck_fornecedor = 0;
	var ck_doador_pf = 0;
	var ck_doador_pj = 0;
	var id;

//Variáveis para Validação
	var validacao_pf = false;
	var validacao_pj = false;
	var validacao_estado = false;
	var todos_campos_pf_view = ['#pf_nome_view', '#pf_sexo_view', '#pf_cpf_view', '#pf_rg_view', 
	'#pf_end_view', '#pf_numero_view', '#pf_complemento_view', '#pf_bairro_view', '#pf_cep_view', 
	'#pf_telefone_view', '#pf_email_view', '#pf_nascimento_view', '#pf_comissao_view', '#ck_estudante_view',
	'#ck_motorista_view', '#ck_doador_pf_view', '.campo_estado','#altera_status_pf', '.campo_cidade'];

	var todos_campos_pj_view = ['#pj_razao_social_view', '#pj_nome_fantasia_view', '#pj_email_view', '#pj_cnpj_view', 
	'#pj_telefone_view', '#pj_estado_view', '#pj_cidade_view', '#pj_cep_view', '#pj_complemento_view', 
	'#pj_end_view', '#pj_numero_view', '#pj_bairro_view', "#ck_parceiro_view", "#ck_doador_pj_view", "#ck_fornecedor_view", "#altera_status_pj"];

//Ocultando elementos iniciais
	$("#pf_sub").hide();
	$("#pj_sub").hide();
	ocultar_inputs_pf();	
	ocultar_inputs_pj();	

//Parte de checagem e visualização de inputs
	function limpar_campos(){
		var forms = ['form_cadastro_pessoa_fisica', 'form_cadastro_pessoa_juridica'];
		var forms_tamanho = forms.length;
		for (cont = 0; cont < forms_tamanho; cont++){
			$('#'+forms[cont]).each (function(){
			  this.reset();
			});
		}
		$('.campo_cidade').prop("disabled", true);
		$('.campo_estado').prop("disabled", false);
		$('#pf_comissao').prop('selectedIndex',0);
	}

	function ocultar_inputs_pf(){
		var inputs = ['col_pf_nome', 'col_pf_email', 'col_pf_nascimento', 'col_pf_cpf', 'col_pf_rg', 'col_pf_telefone', 'col_pf_estado', 'col_pf_cidade', 'col_pf_cep', 'col_pf_end', 'col_pf_numero', 'col_pf_bairro', 'col_pf_complemento', 'col_pf_comissao', 'col_pf_sexo', 'col_btn_cadastro'];
		var inputs_tamanho = inputs.length;
		for (cont = 0; cont < inputs_tamanho; cont++){
			$('#'+inputs[cont]).hide();
		}
		$('#pf_comissao').prop('selectedIndex',0);
	}

	function mostrar_inputs_pf(){
		var inputs = ['col_pf_nome', 'col_pf_email', 'col_pf_nascimento', 'col_pf_cpf', 'col_pf_rg', 'col_pf_telefone', 'col_pf_estado', 'col_pf_cidade', 'col_pf_cep', 'col_pf_end', 'col_pf_numero', 'col_pf_bairro', 'col_pf_complemento', 'col_pf_sexo', 'col_btn_cadastro'];
		var inputs_tamanho = inputs.length;
		for (cont = 0; cont < inputs_tamanho; cont++){
			$('#'+inputs[cont]).show();
		}
	}

	function ocultar_inputs_pj(){
		var inputs = ['col_pj_razao_social','col_pj_email','col_pj_nome_fantasia','col_pj_cnpj','col_pj_telefone','col_pj_estado','col_pj_cidade','col_pj_cep','col_pj_complemento','col_pj_end','col_pj_numero','col_pj_bairro','col_btn_cadastro_pj'];
		var inputs_tamanho = inputs.length;
		for (cont = 0; cont < inputs_tamanho; cont++){
			$('#'+inputs[cont]).hide();
		}
		$('#pf_comissao').prop('selectedIndex',0);
	}

	function mostrar_inputs_pj(){
		var inputs = ['col_pj_razao_social','col_pj_email','col_pj_nome_fantasia','col_pj_cnpj','col_pj_telefone','col_pj_estado','col_pj_cidade','col_pj_cep','col_pj_complemento','col_pj_end','col_pj_numero','col_pj_bairro','col_btn_cadastro_pj'];
		var inputs_tamanho = inputs.length;
		for (cont = 0; cont < inputs_tamanho; cont++){
			$('#'+inputs[cont]).show();
		}
	}
	
	function mostrar(id){
		$("#"+id).show();
	}

	function ocultar(id){
		$("#"+id).hide();
	}

	function habilitar_estudante_view(){
		$("#ck_estudante_view").click(function(){
			if ($("#ck_estudante_view").prop("checked") == true){
				$("#col_pf_comissao_view").show();
			}else{
				$("#col_pf_comissao_view").hide();
				$('#pf_comissao_view').prop('selectedIndex',0);
			}
		});
	}

	function checkbox_pessoa(id, id2, id3, estado, variavel){
		if($("#"+id).prop("checked") == estado){
 			mostrar(id2);
 			ocultar(id3);
 			if (variavel == 'inicio_pf') {
 				inicio_pf = true;
 			}else if(variavel == 'inicio_pj'){
 				inicio_pj = true;
 			}
 			if (variavel == 'remove_pf' && inicio_pf == true) {
 				$('.checkbox_sub_pessoa').removeAttr('checked');
 				limpar_campos();
 				ocultar_inputs_pf();
 				desabilitar_checkbox();
 				inicio_pf = false;
 			}else if (variavel == 'remove_pj' && inicio_pj == true){
 				 $('.checkbox_sub_pessoa').removeAttr('checked');
 				limpar_campos();
 				ocultar_inputs_pj();
 				desabilitar_checkbox();
 				inicio_pj = false;
 			}
        } 
	}

	function desabilitar_checkbox_view(){
		if ($("#ck_parceiro_view").prop("checked") == true) {
				$('#ck_fornecedor_view').prop("disabled", true);
			}else if($("#ck_fornecedor_view").prop("checked") == true){
				$('#ck_parceiro_view').prop("disabled", true);
			}

		$("#ck_parceiro_view").click(function(){
			if ($("#ck_parceiro_view").prop("checked") == true) {
				$('#ck_parceiro_view').prop("disabled", false);
				$('#ck_fornecedor_view').prop("disabled", true);
			}else{
				$('#ck_fornecedor_view').prop("disabled", false);
			} 
		});
		$("#ck_fornecedor_view").click(function(){
			if($("#ck_fornecedor_view").prop("checked") == true){
				$('#ck_fornecedor_view').prop("disabled", false);
				$('#ck_parceiro_view').prop("disabled", true);
			}else{
				$('#ck_parceiro_view').prop("disabled", false);
			}
		});
	}

	function desabilitar_checkbox(){
		if (habilita_parceiro == true) {
				$('#ck_fornecedor').prop("disabled", false);
				habilita_parceiro = false;
			}else if(habilita_fornecedor == true){
				$('#ck_parceiro').prop("disabled", false);
				habilita_fornecedor = false;
			}
	}

	function mostrar_multi_opcoes(id, id2, id3, estado, estado2, estado3, tipo){
		if( ($("#"+id).prop("checked") == estado) 
			&& ($("#"+id2).prop("checked") == estado2) 
			&& ($("#"+id3).prop("checked") == estado3)){
 			
	 			if (tipo == 'pf') {
	 				mostrar_inputs_pf();
	 				if (ck_estudante == 1) {
	 					$("#col_pf_comissao").show();
	 				}
	 				if ($("#ck_estudante").prop("checked") == false) {
	 					$("#col_pf_comissao").hide();
	 				}
	 			}else if(tipo == 'pj'){
	 				mostrar_inputs_pj();
	 			
	 			}
	 			
        }   
	}

	function mostrar_1_opcao(id, estado, tipo){
		if( ($("#"+id).prop("checked") == estado)){
			
			limpar_campos();
 			
 			if (tipo == 'pf'){
 				mostrar_inputs_pf();

 				if (id == 'ck_estudante') {
 				$("#col_pf_comissao").show();
 				ck_estudante = 1;
	 			}else if (id == 'ck_motorista'){
	 				ck_motorista = 1;
	 			}else if (id == 'ck_doador_pf'){
	 				ck_doador_pf = 1;
	 			}

	 			if ($("#ck_estudante").prop("checked") == false) {
 					$("#col_pf_comissao").hide();
 				}
 			}else if(tipo == 'pj'){
 				mostrar_inputs_pj();

 				if (id == 'ck_parceiro') {
					$('#ck_fornecedor').prop("disabled", true);
					habilita_parceiro = true;	
				}else if (id == 'ck_fornecedor'){
					$('#ck_parceiro').prop("disabled", true);
					habilita_fornecedor = true;
				}

 			}
			 //Verifica se os checkbox do topo estão selecionados!
        }   
	}

	function ocultar_todas_opcoes(id, id2, id3, estado, variavel, variavel2, variavel3, tipo){
		if( ($("#"+id).prop("checked") == false) 
			&&  ($("#"+id2).prop("checked") == false) 
			&& ($("#"+id3).prop("checked") == false)){
 			
				if(tipo == 'pf'){
					ocultar_inputs_pf();
					ck_estudante = 0;
		 			ck_motorista = 0;
		 			ck_doador_pf = 0;
				}else if (tipo == 'pj'){
					ocultar_inputs_pj();
					ck_parceiro = 0;
		 			ck_fornecedor = 0;
		 			ck_doador_pj = 0;
				}
 				 //Verifica se os checkbox do topo estão selecionados!
        } 
	}

	function ocultar_1_opcao(id, estado, tipo){
		if( ($("#"+id).prop("checked") == estado)){

				if(tipo == 'pf'){
					ocultar_inputs_pf();
					ck_estudante = 0;
		 			ck_motorista = 0;
		 			ck_doador_pf = 0;
				}else if (tipo == 'pj'){
					
					if (id == 'ck_parceiro') {
						ck_parceiro = 0;
					}else if(id == 'ck_fornecedor'){
						ck_fornecedor = 0;
					}else if(id == 'ck_doador_pj'){
						ck_doador_pj = 0;
					}

		 			if ( id == 'ck_parceiro' && habilita_parceiro == true) {
		 				$('#ck_fornecedor').prop("disabled", false);
						habilita_parceiro = false;
		 			}else if ( id == 'ck_fornecedor' && habilita_fornecedor == true){
		 				$('#ck_parceiro').prop("disabled", false);
						habilita_fornecedor = false;
		 			}
				}
 			 //Verifica se os checkbox do topo estão selecionados!
        } 
	}

	function limpar_cks(){
		ck_estudante = 0;
		ck_doador = 0;
		ck_motorista = 0;
		ck_parceiro = 0;
		ck_fornecedor = 0;
		ck_doador_pj = 0;
		ck_doador_pf = 0;
	}

	$('.checkbox_pessoa').on("click", function(){
		//Checando Pessoa Física e Pessoa Jurídica
		checkbox_pessoa('ck_pessoa_fisica', 'pf_sub', 'label_pessoa_juridica', true, 'inicio_pf');
		checkbox_pessoa('ck_pessoa_fisica', 'label_pessoa_juridica', 'pf_sub', false, 'remove_pf');
		checkbox_pessoa('ck_pessoa_juridica','pj_sub','label_pessoa_fisica', true, 'inicio_pj');
		checkbox_pessoa('ck_pessoa_juridica','label_pessoa_fisica','pj_sub', false, 'remove_pj');
	});

	$('.checkbox_sub_pessoa').on("click", function(){
		//Checando Pessoa Física - Subs
		mostrar_1_opcao('ck_estudante', true, 'pf');
		mostrar_1_opcao('ck_motorista', true, 'pf');
		mostrar_1_opcao('ck_doador_pf', true, 'pf');
		mostrar_multi_opcoes('ck_estudante','ck_motorista','ck_doador_pf', true, true, false, 'pf');
		mostrar_multi_opcoes('ck_estudante','ck_motorista','ck_doador_pf', true, false, true, 'pf');
		mostrar_multi_opcoes('ck_estudante','ck_motorista','ck_doador_pf', false, true, true, 'pf');
		mostrar_multi_opcoes('ck_estudante','ck_motorista','ck_doador_pf', true, true, true, 'pf');
		ocultar_todas_opcoes('ck_estudante', 'ck_motorista', 'ck_doador_pf', false, ck_estudante, ck_motorista, ck_doador_pf, 'pf');

		// //Checando Pessoa Jurídica - Subs
		mostrar_1_opcao('ck_parceiro', true, 'pj');
		mostrar_1_opcao('ck_fornecedor', true, 'pj');
		mostrar_1_opcao('ck_doador_pj',  true, 'pj');
		mostrar_multi_opcoes('ck_parceiro','ck_fornecedor','ck_doador_pj', true, false, true, 'pj');
		mostrar_multi_opcoes('ck_parceiro','ck_fornecedor','ck_doador_pj', false, true, true, 'pj');
		ocultar_1_opcao('ck_parceiro', false, 'pj');
		ocultar_1_opcao('ck_fornecedor', false, 'pj');
		ocultar_1_opcao('ck_doador_pj', false, 'pj');
		ocultar_todas_opcoes('ck_parceiro', 'ck_fornecedor', 'ck_doador_pj', false, ck_parceiro, ck_fornecedor, ck_doador_pj, 'pj');
	});

// ** Parte de Cadastro de Pessoas ** //
	//Função AJAX que envia os dados do form
	function cadastro_ajax(id_form){
		$.ajax({
	    	url: "registros/registra_pessoa.php",
	    	method: "post",
	    	data: $('#'+id_form).serialize()+'&'+$.param({e_estudante: ck_estudante, e_motorista: ck_motorista, e_doador: ck_doador, e_parceiro: ck_parceiro, e_fornecedor: ck_fornecedor}),
	    	success: function(data) {	
	    		$('#modal_cadastro_concluido').modal();
	    		$('#btn_cadastro_ok').click(function(){
	    			location.reload();
	    		});
	      	}
		});
		return false;
	}

	function altera_ajax(id_form){
		$.ajax({
	    	url: "registros/altera_pessoa.php",
	    	method: "post",
	    	data: $('#'+id_form).serialize()+'&'+$.param({e_estudante: ck_estudante, e_motorista: ck_motorista, e_doador: ck_doador, e_parceiro: ck_parceiro, e_fornecedor: ck_fornecedor, decisao: 2, id_pessoa: id}),
	    	success: function(data) {
	    		$('#modal_alterado_concluido').modal();
	    		$('#btn_alterado_ok').click(function(){
	    			location.reload();
	    		});
	      	}
		});
		return false;
	}

	function altera_ajax(id_form){
		$.ajax({
	    	url: "registros/altera_pessoa.php",
	    	method: "post",
	    	data: $('#'+id_form).serialize()+'&'+$.param({e_estudante: ck_estudante, e_motorista: ck_motorista, e_doador: ck_doador, e_parceiro: ck_parceiro, e_fornecedor: ck_fornecedor, decisao: 2, id_pessoa: id}),
	    	success: function(data) {
	    		$('#modal_alterado_concluido').modal();
	    		$('#btn_alterado_ok').click(function(){
	    			location.reload();
	    		});
	      	}
		});
		return false;
	}

//FUNCTION CPF VALIDAR
jQuery.validator.addMethod("cpf", function(value, element) {
   value = jQuery.trim(value);

    value = value.replace('.','');
    value = value.replace('.','');
    cpf = value.replace('-','');
    while(cpf.length < 11) cpf = "0"+ cpf;
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
    var a = [];
    var b = new Number;
    var c = 11;
    for (i=0; i<11; i++){
        a[i] = cpf.charAt(i);
        if (i < 9) b += (a[i] * --c);
    }
    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11-x }
    b = 0;
    c = 11;
    for (y=0; y<10; y++) b += (a[y] * c--);
    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }

    var retorno = true;
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

    return this.optional(element) || retorno;

}, "Informe um CPF válido");

//FUNCTION CNPJ VALIDAR
$.validator.addMethod('cpnj', function(cnpj, element) {
  var $return, digitos, i, numeros, pos, resultado, soma, tamanho;
  $return = true;
  cnpj = cnpj.replace(/[^\d]+/g, '');
  if (cnpj === '') {
    $return = false;
  }
  if (cnpj.length !== 14) {
    $return = false;
  }
  if (cnpj === '00000000000000' || cnpj === '11111111111111' || cnpj === '22222222222222' || cnpj === '33333333333333' || cnpj === '44444444444444' || cnpj === '55555555555555' || cnpj === '66666666666666' || cnpj === '77777777777777' || cnpj === '88888888888888' || cnpj === '99999999999999') {
    $return = false;
  }
  tamanho = cnpj.length - 2;
  numeros = cnpj.substring(0, tamanho);
  digitos = cnpj.substring(tamanho);
  soma = 0;
  pos = tamanho - 7;
  i = tamanho;
  while (i >= 1) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) {
      pos = 9;
    }
    i--;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
  if (resultado !== parseInt(digitos.charAt(0))) {
    $return = false;
  }
  tamanho = tamanho + 1;
  numeros = cnpj.substring(0, tamanho);
  soma = 0;
  pos = tamanho - 7;
  i = tamanho;
  while (i >= 1) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) {
      pos = 9;
    }
    i--;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
  if (resultado !== parseInt(digitos.charAt(1))) {
    $return = false;
  }
  return $return;
}, "Informe um CNPJ válido");



	//Validação Cadastrar Pessoa
		$("#form_cadastro_pessoa_fisica").validate({
	        rules : {
	             nome:{
	                    required:true,
	             },
	             email:{
	                    required:true,
	             },
	             data_nascimento:{
	                    required:true,
	             },             
	             sexo:{
	                    required:true,
	             },             
	             cpf:{	
	             		cpf: true,
	                    required:true,
	             },             
	             rg:{
	                    required:true,
	             },             
	             telefone:{
	                    required:true,
	             },             
	             estado:{
	                    required:true,
	             },             
	             cidade:{
	                    required:true,
	             },                        
	             cep:{
	                    required:true,
	             },             
	             endereco:{
	                    required:true,
	             },             
	             numero:{
	                    required:true,
	             },             
	             bairro:{
	                    required:true
	             }                                           
	       	},
	       	messages:{
	             nome:{
	                    required:"Por favor, informe seu nome"
	             },
	             email:{
	                    required:"Informe um email"
	             },
	             data_nascimento:{
	                    required:"Informe a Data de Nascimento"
	             },
	             sexo:{
	                    required:"Escolha o Sexo"
	             },             
	             cpf:{
	                    required:"Informe o CPF"
	             },             
	             rg:{
	                    required:"informe o RG"
	             },             
	             telefone:{
	                    required:"informe o Telefone"
	             },             
	             estado:{
	                    required:"Escolha o Estado"
	             },             
	             cidade:{
	                    required:"Escolha a Cidade"
	             },                         
	             cep:{
	                    required:"Informe o CEP"
	             },             
	             endereco:{
	                    required:"Informe o Endereço"
	             },             
	             numero:{
	                    required:"Informe o Número"
	             },             
	             bairro:{
	                    required:"Informe o Bairro"
	             }     
	       	},
			invalidHandler: function() {
			    validacao_pf = false;
			    return false;
		  	},
		    submitHandler: function(form) {
	       		validacao_pf = true;

	       		if (validacao_pf == true){
	       			E_SELECT('ck_estudante', 'ck_motorista', 'ck_doador_pf');
					cadastro_ajax('form_cadastro_pessoa_fisica');
				}
		  	}
		});

		$("#form_cadastro_pessoa_juridica").validate({
		        rules : {
		             razao_social:{
		                    required:true,
		             },
		             email:{
		                    required:true,
		             },
		             cnpj:{
		                    required:true,
		                    cpnj: true,
		             },                         
		             telefone:{
		                    required:true,
		             },             
		             estado:{
		                    required:true,
		             },             
		             cidade:{
		                    required:true,
		             },                        
		             cep:{
		                    required:true,
		             },             
		             endereco:{
		                    required:true,
		             },             
		             numero:{
		                    required:true,
		             },             
		             bairro:{
		                    required:true
		             }                                           
		       	},

		       	messages:{
		             razao_social:{
		                    required:"Por favor, informe a razao social"
		             },
		             email:{
		                    required:"Informe um email"
		             },  
		             cnpj:{
		                    required:"Informe o cnpj"
		             },             
		             telefone:{
		                    required:"informe o Telefone"
		             },             
		             estado:{
		                    required:"Escolha o Estado"
		             },             
		             cidade:{
		                    required:"Escolha a Cidade"
		             },                         
		             cep:{
		                    required:"Informe o CEP"
		             },             
		             endereco:{
		                    required:"Informe o Endereço"
		             },             
		             numero:{
		                    required:"Informe o Número"
		             },             
		             bairro:{
		                    required:"Informe o Bairro"
		             }     
		       	},
				invalidHandler: function() {
				    validacao_pj = false;
				    return false;
			  	},
			    submitHandler: function(form) {
		       		validacao_pj = true;

		       		if (validacao_pj == true){
		       			E_SELECT('ck_parceiro', 'ck_fornecedor', 'ck_doador_pj');
						cadastro_ajax('form_cadastro_pessoa_juridica');
					}
			  	}
		});


	//Validação Alterar Pessoa
		$("#form_view_pessoa_fisica").validate({
	        rules : {
	             nome:{
	                    required:true,
	             },
	             email:{
	                    required:true,
	             },
	             data_nascimento:{
	                    required:true,
	             },             
	             sexo:{
	                    required:true,
	             },             
	             cpf:{
	             		cpf: true,
	                    required:true,
	             },             
	             rg:{
	                    required:true,
	             },             
	             telefone:{
	                    required:true,
	             },             
	             estado:{
	                    required:true,
	             },             
	             cidade:{
	                    required:true,
	             },                        
	             cep:{
	                    required:true,
	             },             
	             endereco:{
	                    required:true,
	             },             
	             numero:{
	                    required:true,
	             },             
	             bairro:{
	                    required:true
	             }                                           
	       	},
	       	messages:{
	             nome:{
	                    required:"Por favor, informe seu nome"
	             },
	             email:{
	                    required:"Informe um email"
	             },
	             data_nascimento:{
	                    required:"Informe a Data de Nascimento"
	             },
	             sexo:{
	                    required:"Escolha o Sexo"
	             },             
	             cpf:{
	                    required:"Informe o CPF"
	             },             
	             rg:{
	                    required:"informe o RG"
	             },             
	             telefone:{
	                    required:"informe o Telefone"
	             },             
	             estado:{
	                    required:"Escolha o Estado"
	             },             
	             cidade:{
	                    required:"Escolha a Cidade"
	             },                         
	             cep:{
	                    required:"Informe o CEP"
	             },             
	             endereco:{
	                    required:"Informe o Endereço"
	             },             
	             numero:{
	                    required:"Informe o Número"
	             },             
	             bairro:{
	                    required:"Informe o Bairro"
	             }     
	       	},
			invalidHandler: function() {
			    validacao_pf_view = false;
			    return false;
		  	},
		    submitHandler: function(form) {
	       		validacao_pf_view = true;

	       		if (validacao_pf_view == true){
	       			E_SELECT('ck_estudante_view', 'ck_motorista_view', 'ck_doador_pf_view');
					altera_ajax('form_view_pessoa_fisica');
				}
		  	}
		});

		$("#form_view_pessoa_juridica").validate({
		        rules : {
		             razao_social:{
		                    required:true,
		             },
		             email:{
		                    required:true,
		             },
		             cnpj:{
		                    required:true,
		                    cpnj: true,
		             },                         
		             telefone:{
		                    required:true,
		             },             
		             estado:{
		                    required:true,
		             },             
		             cidade:{
		                    required:true,
		             },                        
		             cep:{
		                    required:true,
		             },             
		             endereco:{
		                    required:true,
		             },             
		             numero:{
		                    required:true,
		             },             
		             bairro:{
		                    required:true
		             }                                           
		       	},

		       	messages:{
		             razao_social:{
		                    required:"Por favor, informe a razao social"
		             },
		             email:{
		                    required:"Informe um email"
		             },  
		             cnpj:{
		                    required:"Informe o cnpj"
		             },             
		             telefone:{
		                    required:"informe o Telefone"
		             },             
		             estado:{
		                    required:"Escolha o Estado"
		             },             
		             cidade:{
		                    required:"Escolha a Cidade"
		             },                         
		             cep:{
		                    required:"Informe o CEP"
		             },             
		             endereco:{
		                    required:"Informe o Endereço"
		             },             
		             numero:{
		                    required:"Informe o Número"
		             },             
		             bairro:{
		                    required:"Informe o Bairro"
		             }     
		       	},
				invalidHandler: function() {
				    validacao_pj = false;
				    return false;
			  	},
			    submitHandler: function(form) {
		       		validacao_pj = true;

		       		if (validacao_pj == true){
		       			E_SELECT('ck_parceiro_view', 'ck_fornecedor_view', 'ck_doador_pj_view');
						altera_ajax('form_view_pessoa_juridica');
					}
			  	}
		});


	//Função que checa os valores dos selects das forms
	function E_SELECT(ck1, ck2, ck3){
		limpar_campos;
		if ($("#"+ck1).prop("checked") == true){
			if (ck1 == 'ck_estudante_view') {
				ck_estudante = 1;
			}else if(ck1 == 'ck_parceiro_view'){
				ck_parceiro = 1;
			}else if(ck1 == 'ck_estudante'){
				ck_estudante = 1;
			}else if(ck1 == 'ck_parceiro'){
				ck_parceiro = 1;
			}
		}else{
			if (ck1 == 'ck_estudante') {
				ck_estudante = 0;
			}else if(ck1 == 'ck_parceiro_view'){
				ck_parceiro = 0;
			}else if(ck1 == 'ck_estudante'){
				ck_estudante = 0;
			}else if(ck1 == 'ck_parceiro'){
				ck_parceiro = 0;
			}	
		}

		if ($("#"+ck2).prop("checked") == true){
			if (ck2 == 'ck_motorista_view') {
				ck_motorista = 1;
			}else if(ck2 == 'ck_fornecedor_view'){
				ck_fornecedor = 1;
			}else if(ck2 == 'ck_motorista'){
				ck_motorista = 1;
			}else if(ck2 == 'ck_fornecedor'){
				ck_fornecedor = 1;
			}	
		}else{
			if (ck2 == 'ck_motorista_view') {
				ck_motorista = 0;
			}else if(ck2 == 'ck_fornecedor_view'){
				ck_fornecedor = 0;
			}else if(ck2 == 'ck_motorista'){
				ck_motorista = 0;
			}else if(ck2 == 'ck_fornecedor'){
				ck_fornecedor = 0;
			}	
		}

		if ($("#"+ck3).prop("checked") == true){
			if (ck3 == 'ck_doador_pf_view') {
				ck_doador = 1;
			}else if(ck3 == 'ck_doador_pj_view'){
				ck_doador = 1;
			}else if(ck3 == 'ck_doador_pf'){
				ck_doador = 1;
			}else if(ck3 == 'ck_doador_pj'){
				ck_doador = 1;
			}	
		}else{
			if (ck3 == 'ck_doador_pf_view') {
				ck_doador = 0;
			}else if(ck3 == 'ck_doador_pj_view'){
				ck_doador = 0;
			}else if(ck3 == 'ck_doador_pf'){
				ck_doador = 0;
			}else if(ck3 == 'ck_doador_pj'){
				ck_doador = 0;
			}	
		}

	}


	//Pessoa Física - Alterar
		$("#pf_alterar_pessoa_view").click(function(){
			for (cont=0; cont < todos_campos_pf_view.length; cont++){
				$(todos_campos_pf_view[cont]).prop("disabled", false);
			}
			$("#altera_status_pf").bootstrapSwitch('disabled',false);
			$("#pf_deletar_pessoa_view").hide();
			$("#pf_alterar_pessoa_view").hide();
			$("#pf_fechar_pessoa_view").hide();
			$("#pf_cancelar_pessoa_view").show();
			$("#pf_concluir_pessoa_view").show();

		});

	//Pessoa Jurídica - Alterar
		$("#pj_alterar_pessoa_view").click(function(){
			for (cont=0; cont < todos_campos_pj_view.length; cont++){
				$(todos_campos_pj_view[cont]).prop("disabled", false);
			}
			$("#altera_status_pj").bootstrapSwitch('disabled',false);
			$("#pj_deletar_pessoa_view").hide();
			$("#pj_alterar_pessoa_view").hide();
			$("#pj_fechar_pessoa_view").hide();
			$("#pj_cancelar_pessoa_view").show();
			$("#pj_concluir_pessoa_view").show();

			desabilitar_checkbox_view();

		});


	//Pessoa Física & Jurídica - View



	$(document).on('click', '#pf_info', function(){

   		id = $(this).data('info_pessoa');
   		$('#modal_pf_detalhes').modal({backdrop: 'static', keyboard: false});
   		habilitar_estudante_view();

   		$("#pf_deletar_pessoa_view").show();
		$("#pf_alterar_pessoa_view").show();
		$("#pf_fechar_pessoa_view").show();
		$("#pf_cancelar_pessoa_view").hide();
		$("#pf_concluir_pessoa_view").hide();

		for (cont=0; cont < todos_campos_pf_view.length; cont++){
			$(todos_campos_pf_view[cont]).prop("disabled", true);
		}

   		$.ajax({
	    	url: "registros/altera_pessoa.php",
	    	method: "post",
	    	data: {decisao: 1, tipo: 'pf', id_pessoa: id},
	    	success: function(data) {
				var resultado = JSON.parse(data);

				var campospf_normais = ['pf_nome_view', 'pf_sexo_view', 'pf_cpf_view', 'pf_rg_view', 
				'pf_end_view', 'pf_numero_view', 'pf_complemento_view', 'pf_bairro_view', 'pf_cep_view', 
				'pf_telefone_view', 'pf_email_view', 'pf_nascimento_view'];
				var comissao = [resultado[16], resultado[17], resultado[18], resultado[19], resultado[20]];
				var tipo = [resultado[12], resultado[13], resultado[14]];
				
				for (cont=0; cont<13; cont++){
					$("#"+campospf_normais[cont]).val(resultado[cont]);

				}

				if (comissao[0] == '1') {
      				$("#pf_comissao_view option[value='1']").prop('selected', 'selected');
				}else if(comissao[1] == '1'){
      				$("#pf_comissao_view option[value='2']").prop('selected', 'selected');
				}else if (comissao[2] == '1'){
      				$("#pf_comissao_view option[value='3']").prop('selected', 'selected');
				}else if (comissao[3] == '1'){
      				$("#pf_comissao_view option[value='4']").prop('selected', 'selected');	
				}else if (comissao[4] == '1'){
      				$("#pf_comissao_view option[value='5']").prop('selected', 'selected');
				}else{
      				$("#pf_comissao_view option[value='0']").prop('selected', 'selected');
				}

				if(tipo[0] == '1') {
					$('#ck_estudante_view').prop('checked', true);
				}
				if(tipo[1] == '1'){
					$('#ck_motorista_view').prop('checked', true);
				}
				if(tipo[2] == '1'){
					$('#ck_doador_pf_view').prop('checked', true);
				}

	
				$.ajax({
			    	url: "pesquisas/get_cidades_select.php",
			    	method: "post",
			    	data: {estado: resultado[24]},
			    	success: function(data) {
      					$(".campo_cidade").html(data);
      					$("#pf_estado_view option[value='"+resultado[24]+"']").prop('selected', 'selected');
						$("#pf_cidade_view option[value='"+resultado[22]+"']").prop('selected', 'selected');
			      	}
			  	});

				$("#altera_status_pf").bootstrapSwitch('disabled',false);

			  	if(resultado[21] == 0){
					$('#altera_status_pf').bootstrapSwitch('state', false);
				}else if (resultado[21] == 1){
					$('#altera_status_pf').bootstrapSwitch('state', true);
				}
	
				$("#altera_status_pf").bootstrapSwitch('disabled',true);
	      	}
		});

		return false;
	});

	$(document).on('click', '#pj_info', function(){
		
   		id = $(this).data('info_pessoa');
     		$('#modal_pj_detalhes').modal({backdrop: 'static', keyboard: false});

		for (cont=0; cont < todos_campos_pj_view.length; cont++){
			$(todos_campos_pj_view[cont]).prop("disabled", true);
		}


   		$.ajax({
	    	url: "registros/altera_pessoa.php",
	    	method: "post",
	    	data: {decisao: 1, tipo: 'pj', id_pessoa: id},
	    	success: function(data) {
				var resultado = JSON.parse(data);
		
				var campospj_normais = ['pj_razao_social_view', 'pj_nome_fantasia_view', 'pj_cnpj_view', 'pj_email_view', 
				'pj_telefone_view', 'pj_cep_view', 'pj_complemento_view', 'pj_end_view', 'pj_numero_view', 'pj_bairro_view'];


				 var tipo = [resultado[10], resultado[11], resultado[12]];

				$("#pj_deletar_pessoa_view").show();
				$("#pj_alterar_pessoa_view").show();
				$("#pj_fechar_pessoa_view").show();
				$("#pj_cancelar_pessoa_view").hide();
				$("#pj_concluir_pessoa_view").hide();
				
				for (cont=0; cont < campospj_normais.length; cont++){
					$("#"+campospj_normais[cont]).val(resultado[cont]);

				}


				if(tipo[0] == '1') {
					$('#ck_parceiro_view').prop('checked', true);
				}
				if(tipo[1] == '1'){
					$('#ck_fornecedor_view').prop('checked', true);
				} 
				if(tipo[2] == '1'){
					$('#ck_doador_pj_view').prop('checked', true);
				}

	
				$.ajax({
			    	url: "pesquisas/get_cidades_select.php",
			    	method: "post",
			    	data: {estado: resultado[15]},
			    	success: function(data) {
      					$(".campo_cidade").html(data);
      					$("#pj_estado_view option[value='"+resultado[15]+"']").prop('selected', 'selected');
						$("#pj_cidade_view option[value='"+resultado[14]+"']").prop('selected', 'selected');
			      	}
			  	});

				$("#altera_status_pj").bootstrapSwitch('disabled',false);

			  	if(resultado[13] == 0){
					$('#altera_status_pj').bootstrapSwitch('state', false);
				}else if (resultado[13] == 1){
					$('#altera_status_pj').bootstrapSwitch('state', true);
				}

				$("#altera_status_pj").bootstrapSwitch('disabled',true);

	      	}
		});

		return false;
	});


//Deletar Pessoa

	$(document).on('click', '#pf_deletar_pessoa_view', function(){
   		$('#modal_excluir_pessoa').modal({backdrop: 'static', keyboard: false});
   		
   		$("#btn_excluir_pessoa").click(function(){
	   		$.ajax({
		    	url: "registros/altera_pessoa.php",
		    	method: "post",
		    	data: ({id_pessoa: id, decisao: 3}),
			});
			location.reload();
			return false;
   		});
	});

	$(document).on('click', '#pj_deletar_pessoa_view', function(){
   		$('#modal_excluir_pessoa').modal({backdrop: 'static', keyboard: false});
   		
   		$("#btn_excluir_pessoa").click(function(){
	   		$.ajax({
		    	url: "registros/altera_pessoa.php",
		    	method: "post",
		    	data: ({id_pessoa: id, decisao: 3}),
			});
			location.reload();
			return false;
   		});
	});

});