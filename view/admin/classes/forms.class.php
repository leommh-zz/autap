<?php 
//Classe que contem os Componentes
require_once('componentes.class.php');
$componentes = new Componentes;

class Forms{

//Functions

	//Função que cria o Formulário.
	function form_padrao($id_form, array $tipo_campo, array $tamanho, array $campo_id, $btn_id){
		global $componentes;
		echo '<form method="post" action="" class="formularios" data-toggle="validator" id="'.$id_form.'">';
			echo'<div class="row">';
				for ($cont=0; $cont < count($tipo_campo); $cont++){
					echo '<div class='.$tamanho[$cont].' id='.$campo_id[$cont].'>';
						echo eval('$componentes->'.$tipo_campo[$cont]);
					echo '</div>';
				}          
		    	echo'<div id="conteudo_extra_'.$id_form.'"></div>
	    		<script>$("#conteudo_extra_'.$id_form.'").hide();</script>';

			echo "</div>";
			echo'<div class="row">';
				echo '<div class="col-md-12">';
					echo '<div style="float:right; margin-right: 16.8px;" id="col_'.$btn_id.'">
				          <button id="alterar_'.$id_form.'" type="button" class="btn btn-default" >Alterar</button>
				          <button id="fechar_'.$id_form.'" type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				          <button id="cancelar_'.$id_form.'" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				          <button id="'.$btn_id.'" type="submit" class="btn btn-primary  '.$btn_id.'">Confirmar</button>
				          <script>$("#alterar_'.$id_form.'").hide();</script>
				          <script>$("#fechar_'.$id_form.'").hide();</script>
				    	</div>';
			    echo "</div>";
		    echo "</div>";
		echo "</form>";
	}

	function form_itens_compra($id_form, array $tipo_campo, array $tamanho, array $campo_id, $btn_id){
		global $componentes;
		echo '<form method="post" action="" class="formularios" data-toggle="validator" id="'.$id_form.'">';
			echo'<div class="row row_cadastro_item_compra">';
				for ($cont=0; $cont < count($tipo_campo); $cont++){
					echo '<div class='.$tamanho[$cont].' id='.$campo_id[$cont].'>';
						echo eval('$componentes->'.$tipo_campo[$cont]);
					echo '</div>';
				}   
				echo '<div class="">';
					echo '<button type="submit" class="btn btn-default" id="'.$btn_id.'">Inserir</button>'; 
				echo '</div>';      
			echo "</div>";
					
		echo "</form>";
	}

//Formulários de Cadastro
	function cadastro_pessoa_fisica(){
		$this->form_padrao('form_cadastro_pessoa_fisica', 
			array("campo_texto('pf_nome','Nome Completo*','Insira...', 'text', 'nome', 'no_mask', '');",
				"campo_texto('pf_email','Email*','Insira...', 'email', 'email', 'no_mask', '');",
				"campo_data('pf_nascimento','Nascimento*','');",
				"campo_sexo('pf_sexo','Sexo*', '');",
				"campo_texto('pf_cpf','CPF*','Insira...', 'text', 'cpf', '{{999}}.{{999}}.{{999}}-{{99}}', '');",
				"campo_texto('pf_rg','RG*','Insira...', 'text', 'rg', 'no_mask', '');",
				"campo_texto('pf_telefone','Telefone*','Insira...', 'text', 'telefone', '({{99}}) {{99999}}-{{9999}}', '');",
				"campo_estado('pf_estado', 'Estado*', '');",
				"campo_cidade('pf_cidade', 'Cidade*', '');",
				"campo_texto('pf_cep','CEP*','Insira...', 'text', 'cep', '{{99}}.{{999}}-{{999}}', '');",
				"campo_texto('pf_end','Endereço*','Insira...', 'text', 'endereco', 'no_mask', '');",
				"campo_texto('pf_numero','Número*','Insira...', 'text', 'numero', 'no_mask', '');",
				"campo_texto('pf_bairro','Bairro*','Insira...', 'text', 'bairro', 'no_mask', '');",
				"campo_texto('pf_complemento','Complemento','Insira...', 'text', 'complemento', 'no_mask', '');",
				"campo_comissao('pf_comissao', 'Comissão', '');"), 
			array("col-md-7", "col-md-5", "col-md-3", "col-md-2", "col-md-3", "col-md-4", "col-md-3", "col-md-3", "col-md-4", "col-md-2", "col-md-5", "col-md-2", "col-md-3", "col-md-2", "col-md-3"), 
			array("col_pf_nome", "col_pf_email", "col_pf_nascimento", "col_pf_sexo", "col_pf_cpf", "col_pf_rg", "col_pf_telefone", "col_pf_estado", "col_pf_cidade", "col_pf_cep", "col_pf_end", "col_pf_numero", "col_pf_bairro", "col_pf_complemento", "col_pf_comissao"), "btn_cadastro" 
		);
	}

	function cadastro_pessoa_juridica(){
		$this->form_padrao('form_cadastro_pessoa_juridica', 
			array("campo_texto('pj_razao_social','Razão Social*','Insira...','text','razao_social', 'no_mask', '');",
				"campo_texto('pj_email','Email*','Insira...', 'email', 'email', 'no_mask', '');",
				"campo_texto('pj_nome_fantasia','Nome Fantasia','Insira...', 'text','nome_fantasia', 'no_mask', '');",
				"campo_texto('pj_cnpj','CNPJ*','Insira...','text', 'cnpj', '{{99}}.{{999}}.{{999}}/{{9999}}-{{99}}', '');",
				"campo_texto('pj_telefone','Telefone*','Insira...', 'text', 'telefone', '({{99}}) {{99999}}-{{9999}}', '');",
				"campo_estado('pj_estado', 'Estado*', 'estado', '');",
				"campo_cidade('pj_cidade', 'Cidade*', 'cidade', '');",
				"campo_texto('pj_cep','CEP*','Insira...', 'text', 'cep', '{{99}}.{{999}}-{{999}}', '');",
				"campo_texto('pj_complemento','Complemento','Insira...', 'text','complemento', 'no_mask', '');",
				"campo_texto('pj_end','Endereço*','Insira...', 'text', 'endereco', 'no_mask', '');",
				"campo_texto('pj_numero','Número*','Insira...', 'text', 'numero', 'no_mask', '');",
				"campo_texto('pj_bairro','Bairro*','Insira...', 'text', 'bairro', 'no_mask', '');"), 
			array("col-md-7", "col-md-5", "col-md-8", "col-md-4", "col-md-3", "col-md-3", "col-md-3", "col-md-2", "col-md-2", "col-md-2", "col-md-7", "col-md-2", "col-md-3", "col-md-3"), 
			array("col_pj_razao_social", "col_pj_email", "col_pj_nome_fantasia", "col_pj_cnpj", "col_pj_telefone", "col_pj_estado", "col_pj_cidade", "col_pj_cep", "col_pj_complemento", "col_pj_end", "col_pj_numero", "col_pj_bairro"), "btn_cadastro_pj" 
		);
	}

	function cadastro_estado(){
		$this->form_padrao('form_cadastro_estado', 
			array("campo_texto('estado_nome', 'Nome*','Insira...', 'text', 'estado', 'no_mask', '');",
				"campo_texto('estado_sigla', 'Sigla*','Insira...', 'text', 'sigla', '{{aa}}', '');"), 
			array("col-md-9", "col-md-3"), 
			array("div_estado_nome", "div_estado_sigla"), "btn_cadastro_estado"
		);
	}

	function cadastro_cidade(){
		$this->form_padrao('form_cadastro_cidade', 
			array("campo_estado('pf_estado', 'Estado*', '');",
				"campo_texto('cidade_nome', 'Nome*', 'Insira...', 'text', 'nome', 'no_mask', '');"), 
			array("col-md-3", "col-md-10"), 
			array("div_estado", "div_cidade"), "btn_cadastro_cidade"
		);
	}

	function cadastro_onibus(){
		$this->form_padrao('form_cadastro_onibus', 
			array("campo_texto('modelo_onibus','Modelo*','Insira...','text','modelo', 'no_mask', '');",
				"campo_texto('placa_onibus','Placa*','Insira...','text','placa', 'no_mask', '');",
				"campo_texto('ano_onibus','Ano*','Insira...','text','ano', '{{9999}}', '');",
				"campo_texto('assento_onibus','Assentos*','Insira...','text','assentos', '{{99}}', '');",
				"campo_empresa('empresa_onibus','Empresa*', '');",
				"campo_motorista('motorista_onibus','Motorista*', '');"), 
			array("col-md-5", "col-md-4", "col-md-3", "col-md-2", "col-md-4", "col-md-4"), 
			array("", "", "", "", "", ""), "btn_cadastro_onibus"
		);
	}

	function cadastro_plano_contas(){
		$this->form_padrao('form_cadastro_plano_contas', 
			array("campo_plano_contas('natureza_conta', 'Tipo de Conta*');",
				"campo_textarea('descricao','Descrição*');"), 
			array("col-md-3", "col-md-10"), 
			array("", ""), "btn_cadastro_plano_contas"
		);
	}

	function cadastro_item(){
		$this->form_padrao('form_cadastro_item', 
			array("campo_tipo_item('tipo_item','Tipo*', 'tipo');",
				"campo_texto('nome_item','Nome*','Insira...','text','nome', 'no_mask', '');",
			"campo_texto('quantidade_item','Qtde. Estoque*','Insira...','number','quantidade', 'no_mask', 'min=1');",
			"campo_texto('peso_item','Peso (Gramas)*','Insira...','number','peso', 'no_mask', 'min=1');",
			"campo_texto('marca_item','Marca*','Insira...','text','marca', 'no_mask', '');",
			"campo_textarea('genero_item', '*Tipo do Produto/Observações...');"), 
			array("col-md-12", "col-md-12", "col-md-3", "col-md-3", "col-md-6", "col-md-12"), 
			array("label_tipo_item", "label_nome_item", "label_quantidade_item", "label_peso_item", "label_marca_item", "label_genero_item"), "btn_cadastro_item"
		);
	}

	function cadastro_item_compra(){
		$this->form_itens_compra('form_cadastro_item_compra', 
			array("campo_texto('quantidade_item','Quantidade*','Insira...','number','quantidade', 'no_mask', 'min=1');",
				"campo_itens('campo_itens','Itens*');",
				"campo_texto('valor_unitario','Valor Unitário*','Insira...','text','valor_unitario', 'no_mask', '');"), 
			array("col-md-2", "col-md-7", "col-md-2"), 
			array("", "", ""), "btn_cadastro_item_compra"
		);
	}

	function cadastro_compra (){
		global $componentes;

		echo '<form method="post" action="" class="" data-toggle="validator" id="form_cadastro_compra">';
			echo "<div class='row row_cadastro_compra'>";

				echo "<div class='col-md-3' id=''>";
					$componentes->campo_data('data','Data');
				echo "</div>";

				echo "<div class='col-md-5' id=''>";
					$componentes->campo_empresa('empresa','Fornecedor');
				echo "</div>";

				echo "<div class='col-md-3' id='' style='float: right;'>";
					$componentes->campo_texto('valor_total_compra', 'Valor Total*', 'Total', 'text', 'valor_total', 'no_mask');
				echo "</div>";

			echo "</div>";
			
			echo '<div style="float:right;" id="">
	          <button type="button" class="btn btn-default" data-dismiss="modal" id="btn_cancel_compra">Cancelar</button>
	          <button type="submit" class="btn btn-primary" id="btn_cadastro_compra">Confirmar</button>
	        	</div>';

		echo '</form>';	
	}

	function cadastro_contas_a_pagar(){
		$this->form_padrao('form_cadastro_cp', 
			array("select_padrao('compra_cp','Compra*');",
				"campo_texto('fornecedor_cp','Fornecedor*', '...', 'text', 'fornecedor_cp', 'no_mask', '');",
				"campo_data2('data_compra_cp', 'Data da Compra');",
				"campo_texto('valor_total_cp', 'Valor Total*', 'Total', 'text', 'valor_total', 'no_mask');",
				"campo_data2('data_cp', 'Data de Pagamento');"), 
			array("col-md-12", "col-md-12","col-md-4", "col-md-4", "col-md-4"), 
			array("label_compra_cp", "label_fornecedor_cp","label_data_compra_cp", "label_valor_total_cp", "label_data_cp"), "btn_cadastro_contas_a_pagar"
		);
	}


//Formulários de Alteração
	function alterar_estado(){
		$this->form_padrao('form_alterar_estado', 
			array("campo_status('altera_status_estado','Status');",
				"campo_texto('altera_estado_nome', 'Nome*','Insira...', 'text', 'estado', 'no_mask', '');",
				"campo_texto('altera_estado_sigla', 'Sigla*','Insira...', 'text', 'sigla', '{{aa}}', '');"), 
			array("col-md-12","col-md-9", "col-md-3"), 
			array("","", ""), "btn_alterar_estado"
		);
	}

	function alterar_cidade(){
		$this->form_padrao('form_alterar_cidade', 
			array("campo_status('altera_status_cidade','Status');",
				"campo_estado('altera_pf_estado', 'Estado*','');",
				"campo_texto('altera_cidade_nome','Nome*','Insira...','text','nome', 'no_mask','');"), 
			array("col-md-12","col-md-3", "col-md-10"), 
			array("","", ""), "btn_alterar_cidade"
		);
	}

	function alterar_plano_contas(){
		$this->form_padrao('form_alterar_plano_contas', 
			array("campo_plano_contas('altera_natureza_conta', 'Tipo de Conta*');",
				"campo_textarea('altera_descricao','Descrição*');"), 
			array("col-md-3", "col-md-12"), 
			array("", ""), "btn_alterar_plano_contas"
		);
	}

	function alterar_item (){
		$this->form_padrao('form_alterar_item', 
			array("campo_status('altera_status_item','Status');",
				"campo_texto('altera_nome_item','Descrição*','Insira...','text','altera_nome', 'no_mask', '');",
				"campo_tipo_item('altera_tipo','Tipo*', 'tipo');", 
				"campo_texto('altera_quantidade_item','Qtde. Estoque*','Insira...','number','altera_quantidade', 'no_mask', 'min=1');",
				"campo_texto('altera_peso_item','Peso (Gramas)*','Insira...','number','altera_peso', 'no_mask', 'min=1');",
				"campo_texto('altera_marca_item','Marca*','Insira...','text','altera_marca', 'no_mask', '');",
				"campo_textarea('altera_genero_item', '*Tipo do Produto/Observações...'); "), 
			array("col-md-12", "col-md-10", "col-md-5", "col-md-3", "col-md-3", "col-md-6", "col-md-12"), 
			array("","label_altera_nome_item", "label_altera_tipo_item", "label_altera_quantidade_item", "label_altera_peso_item", "label_altera_marca_item", "label_altera_genero_item"), "btn_alterar_item"
		);

	}


	function alterar_onibus(){
		$this->form_padrao('form_alterar_onibus', 
			array("campo_status('altera_status_onibus','Status');",
				"campo_texto('altera_modelo_onibus','Modelo*','Insira...','text','modelo', 'no_mask', '');",
				"campo_texto('altera_placa_onibus','Placa*','Insira...','text','placa', 'no_mask', '');",
				"campo_texto('altera_ano_onibus','Ano*','Insira...','text','ano', '{{9999}}', '');",
				"campo_texto('altera_assento_onibus','Assentos*','Insira...','text','assentos', '{{99}}', '');",
				"campo_empresa('altera_empresa_onibus','Empresa*', '');",
				"campo_motorista('altera_motorista_onibus','Motorista*', '');"), 
			array("col-md-12", "col-md-5", "col-md-4", "col-md-3", "col-md-2", "col-md-4", "col-md-4"), 
			array("", "", "", "", "", "", ""), "btn_alterar_onibus"
		);
	}


//Formulários de view

	function view_contas_a_pagar(){
		$this->form_padrao('form_view_cp', 
			array("campo_texto('view_compra_cp','Compra*', '...', 'text', 'compra_cp', 'no_mask', '');",
				"campo_texto('view_fornecedor_cp','Fornecedor*', '...', 'text', 'fornecedor_cp', 'no_mask', '');",
				"campo_texto('view_valor_total_cp', 'Valor Total*', 'Total', 'text', 'valor_total', 'no_mask');",
				"campo_data2('view_data_cp', 'Data de Pagamento');"), 
			array("col-md-12", "col-md-12","col-md-4", "col-md-4", "col-md-4"), 
			array("label_compra_cp", "label_fornecedor_cp","label_data_compra_cp", "label_valor_total_cp", "label_data_cp"), "btn_cadastro_contas_a_pagar"
		);
	}



	function view_pessoa_fisica(){
		global $componentes;
		echo '<form method="post" action="" class="" data-toggle="validator" id="form_view_pessoa_fisica">';
			echo "<div class='row'>";
			echo '
					<div class="col-md-12" id="pf_sub" class="container">
	                    <label class="checkbox-inline" id="label_estudante">
	                      <input type="checkbox" id="ck_estudante_view" class="checkbox_sub_pessoa" disabled> Estudante
	                    </label>
	                    <label class="checkbox-inline" id="label_motorista">
	                      <input type="checkbox" id="ck_motorista_view" class="checkbox_sub_pessoa" disabled> Motorista
	                    </label>
	                    <label class="checkbox-inline" id="label_doador_pf">
	                      <input type="checkbox" id="ck_doador_pf_view" class="checkbox_sub_pessoa"  disabled> Doador
	                    </label>
	                  </div>';
			echo "</div>
			<br>";

			echo "<div class='row'>";
			echo "<div class='col-md-12' id=''>";
				$componentes->campo_status('altera_status_pf','Status');
			echo "</div>";
				echo "<div class='col-md-7' id='col_pf_nome'>";
					$componentes->campo_texto('pf_nome_view','Nome Completo*','Insira...', 'text', 'nome', 'no_mask', 'disabled');
				echo "</div>";
				echo "<div class='col-md-5' id='col_pf_email'>";
					$componentes->campo_texto('pf_email_view','Email*','Insira...', 'email', 'email', 'no_mask', 'disabled');
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='col-md-3' id='col_pf_nascimento'>";
					$componentes->campo_data('pf_nascimento_view','Nascimento*', 'disabled');
				echo "</div>";
				echo "<div class='col-md-2' id='col_pf_sexo'>";
					$componentes->campo_sexo('pf_sexo_view','Sexo*', 'disabled');
				echo "</div>";
				echo "<div class='col-md-3' id='col_pf_cpf'>";
					$componentes->campo_texto('pf_cpf_view','CPF*','Insira...', 'text', 'cpf', '{{999}}.{{999}}.{{999}}-{{99}}', 'disabled');
				echo "</div>"; 
				echo "<div class='col-md-4' id='col_pf_rg'>";
					$componentes->campo_texto('pf_rg_view','RG*','Insira...', 'text', 'rg', 'no_mask', 'disabled');
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='col-md-3' id='col_pf_telefone'>";
					$componentes->campo_texto('pf_telefone_view','Telefone*','Insira...', 'text', 'telefone', '({{99}}) {{99999}}-{{9999}}', 'disabled');
				echo "</div>";
				echo "<div class='col-md-3' id='col_pf_estado'>";
					$componentes->campo_estado('pf_estado_view', 'Estado*', 'disabled');
				echo "</div>";
				echo "<div class='col-md-4' id='col_pf_cidade'>";
					$componentes->campo_cidade('pf_cidade_view', 'Cidade*', '');
				echo "</div>";
				echo "<div class='col-md-2' id='col_pf_cep'>";
					$componentes->campo_texto('pf_cep_view','CEP*','Insira...', 'text', 'cep', '{{99}}.{{999}}-{{999}}', 'disabled');
				echo "</div>";
			echo "</div>";

			echo "<div class='row'>";
				echo "<div class='col-md-5' id='col_pf_end'>";
					$componentes->campo_texto('pf_end_view','Endereço*','Insira...', 'text', 'endereco', 'no_mask', 'disabled');
				echo "</div>";
				echo "<div class='col-md-2' id='col_pf_numero'>";
					$componentes->campo_texto('pf_numero_view','Número*','Insira...', 'text', 'numero', 'no_mask', 'disabled');
				echo "</div>";
				echo "<div class='col-md-3' id='col_pf_bairro'>";
					$componentes->campo_texto('pf_bairro_view','Bairro*','Insira...', 'text', 'bairro', 'no_mask', 'disabled');
				echo "</div>";
				echo "<div class='col-md-2' id='col_pf_complemento'>";
					$componentes->campo_texto('pf_complemento_view','Complemento*','Insira...', 'text', 'complemento', 'no_mask', 'disabled');
				echo "</div>";
			echo "</div>";
			
			echo "<div class='row'>";
				echo "<div class='col-md-3' id='col_pf_comissao_view'>";
					$componentes->campo_comissao('pf_comissao_view', 'Comissão', 'disabled');
				echo "</div>";
			echo "</div>";

			echo '<div class="row">
					       	<div class="col-md-12" id="">
					            <button type="button" class="btn btn-warning" id="pf_alterar_pessoa_view">Alterar</button>
					            <button type="button" class="btn btn-danger" id="pf_deletar_pessoa_view">Deletar</button>
					            <div style="float: right;">
					            <button type="button" class="btn btn-danger" id="pf_cancelar_pessoa_view" data-dismiss="modal">Cancelar</button>
					            <button type="submit" class="btn btn-success" id="pf_concluir_pessoa_view" >Concluir</button>

					            <button id="pf_fechar_pessoa_view" class="btn btn-info" data-dismiss="modal" aria-label="Close">Fechar</button>
					            </div>
							</div>
						</div>';		        	
		echo '</form>';	
	}

	function view_pessoa_juridica(){
		global $componentes;
		echo '<form method="post" action="" class="" data-toggle="validator" id="form_view_pessoa_juridica">';

			echo "<div class='row'>";
			echo '
					<div class="col-md-12" id="pf_sub" class="container">
	                    <label class="checkbox-inline" id="label_parceiro_view">
	                      <input type="checkbox" id="ck_parceiro_view" class="checkbox_sub_pessoa" disabled> Parceiro
	                    </label>
	                    <label class="checkbox-inline" id="label_fornecedor_view">
	                      <input type="checkbox" id="ck_fornecedor_view" class="checkbox_sub_pessoa" disabled> Fornecedor
	                    </label>
	                    <label class="checkbox-inline" id="label_doador_pj_view">
	                      <input type="checkbox" id="ck_doador_pj_view" class="checkbox_sub_pessoa"  disabled> Doador
	                    </label>
	                  </div>';
			echo "</div>
			<br>";

		echo "<div class='row'>";
			echo "<div class='col-md-12' id=''>";
				$componentes->campo_status('altera_status_pj','Status');
			echo "</div>";
			echo "<div class='col-md-7' id='col_pj_razao_social'>";
				$componentes->campo_texto('pj_razao_social_view','Razão Social*','Insira...','text','razao_social', 'no_mask', '');
			echo "</div>";
			echo "<div class='col-md-5' id='col_pj_email'>";
				$componentes->campo_texto('pj_email_view','Email*','Insira...', 'email', 'email', 'no_mask', '');
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-md-8' id='col_pj_nome_fantasia'>";
				$componentes->campo_texto('pj_nome_fantasia_view','Nome Fantasia*','Insira...', 'text','nome_fantasia', 'no_mask', '');
			echo "</div>";
			echo "<div class='col-md-4' id='col_pj_cnpj'>";
				$componentes->campo_texto('pj_cnpj_view','CNPJ*','Insira...','text', 'cnpj', '{{99}}.{{999}}.{{999}}/{{9999}}-{{99}}', '');
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-md-3' id='col_pj_telefone'>";
				$componentes->campo_texto('pj_telefone_view','Telefone*','Insira...', 'text', 'telefone', '({{99}}) {{99999}}-{{9999}}', '');
			echo "</div>";
			echo "<div class='col-md-3' id='col_pj_estado'>";
				$componentes->campo_estado('pj_estado_view', 'Estado*', 'estado', '');
			echo "</div>";
			echo "<div class='col-md-2' id='col_pj_cidade'>";
				$componentes->campo_cidade('pj_cidade_view', 'Cidade*', 'cidade', '');
			echo "</div>";
			echo "<div class='col-md-2' id='col_pj_cep'>";
				$componentes->campo_texto('pj_cep_view','CEP*','Insira...', 'text', 'cep', '{{99}}.{{999}}-{{999}}', '');
			echo "</div>";
			echo "<div class='col-md-2' id='col_pj_complemento'>";
				$componentes->campo_texto('pj_complemento_view','Complemento','Insira...', 'text','complemento', 'no_mask', '');
			echo "</div>";
		echo "</div>";

		echo "<div class='row'>";
			echo "<div class='col-md-7' id='col_pj_end'>";
				$componentes->campo_texto('pj_end_view','Endereço*','Insira...', 'text', 'endereco', 'no_mask', '');
			echo "</div>";
			echo "<div class='col-md-2' id='col_pj_numero'>";
				$componentes->campo_texto('pj_numero_view','Número*','Insira...', 'text', 'numero', 'no_mask', '');
			echo "</div>";
			echo "<div class='col-md-3' id='col_pj_bairro'>";
				$componentes->campo_texto('pj_bairro_view','Bairro*','Insira...', 'text', 'bairro', 'no_mask', '');
			echo "</div>";
		echo "</div>";

		echo '<div class="row">
					       	<div class="col-md-12" id="">
					            <button type="button" class="btn btn-warning" id="pj_alterar_pessoa_view">Alterar</button>
					            <button type="button" class="btn btn-danger" id="pj_deletar_pessoa_view">Deletar</button>
					            <div style="float: right;">
					            <button type="button" class="btn btn-danger" id="pj_cancelar_pessoa_view" data-dismiss="modal">Cancelar</button>
					            <button type="submit" class="btn btn-success" id="pj_concluir_pessoa_view" >Concluir</button>

					            <button id="pj_fechar_pessoa_view" class="btn btn-info" data-dismiss="modal" aria-label="Close">Fechar</button>
					            </div>
							</div>
						</div>';		


		echo '</form>';	
	}

	function view_compra(){
		global $componentes;
		echo '<form method="post" action="" class="" data-toggle="validator" id="form_view_compra">';


			echo'<div class="table-responsive" id="tabela_itens_comprados"></div>';   

			echo "<div class='row'>";

				echo '<input type="hidden" name="registros_por_pagina" id="registros_por_pagina" value="8" />';
				echo '<input type="hidden" name="offset" id="offset" value="0" />';

				echo "<div class='col-md-3' id=''>";
					$componentes->campo_data('data_comprada','Data');
				echo "</div>";

				echo "<div class='col-md-5' id=''>";
					$componentes->campo_empresa('empresa_comprada','Fornecedor');
				echo "</div>";

				echo "<div class='col-md-3' id='' style='float: right;'>";
					$componentes->campo_texto('valor_total_comprada', 'Valor Total*', 'Total', 'text', 'valor_total', 'no_mask');
				echo "</div>";
			echo "</div>";

			echo '<div class="row">
					       	<div class="col-md-12" id="">
					            <button type="button" class="btn btn-warning" id="alterar_compra_view">Alterar</button>
					            <div style="float: right;">
					            <button type="button" class="btn btn-danger" id="cancelar_compra_view" data-dismiss="modal">Cancelar</button>
					            <button type="submit" class="btn btn-success" id="concluir_compra_view" >Concluir</button>

					            <button id="fechar_compra_view" class="btn btn-info" data-dismiss="modal" aria-label="Close">Fechar</button>
					            </div>
							</div>
						</div>';		        	
		echo '</form>';	
	}


}

?>