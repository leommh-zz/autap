<?php 
require_once('classes/forms.class.php');
$form = new Forms;

class Modals{

//Functions
	function modal_simples($classe, $titulo, $id_modal, $form_function, $tamanho_modal){
		global $form;
		echo '
		<div class="modal fade '.$classe.'" role="dialog" aria-hidden="true" id="'.$id_modal.'">
	      <div class="modal-dialog '.$tamanho_modal.'">

	      	<div class="panel panel-primary">
		       <div class="panel-heading">
		       	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		            <span aria-hidden="true" style="color: white">&times;</span></button>
		            <h4 class="modal-title">'.$titulo.'</h4>
		       </div>
		       		<div class="row">
				       	<div class="col-md-12" id="">
				        	<div class="panel-body">';
					    	$form->$form_function();
						echo'</div>
						</div>
					</div>
			    </div>
		 	</div>

	      </div>
	    </div>';
	}

	function modal_composto($classe, $titulo, $id_modal, $tamanho_modal, $formulario){
		global $form;
		echo '
			<div class="modal fade '.$classe.' pessoa_view" role="dialog" aria-hidden="false" id="'.$id_modal.'">
		      <div class="modal-dialog '.$tamanho_modal.'">
		      	<div class="panel panel-info">
			       <div class="panel-heading">
			       	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			            <span aria-hidden="true">&times;</span></button>
			            <h4 class="modal-title">'.$titulo.'</h4>
			       </div>
			       		<div class="row">
					       	<div class="col-md-12" id="">
					        	<div class="panel-body">';
						    	$form->$formulario();
							echo'</div>
							</div>
						</div>
				    </div>
			 	</div>
			 </div>
			</div>';
	}

	function modal_aviso($id_modal, $mensagem, $id_botao){
		echo'
	    <div class="modal fade modal_avisos" role="dialog" aria-hidden="true" id="'.$id_modal.'">
	        <div class="modal-dialog modal-sm">
	          	<div class="modal-content">
	            	<div class="modal-body">
	                	<h4>'.$mensagem.'</h4>
		        	</div>
		        	<div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			          <button type="button" class="btn btn-primary" id="'.$id_botao.'">Confirmar</button>
		        	</div>
		        </div>
		        
		    </div>
		</div>';
	}

	function modal_aviso2($id_modal, $mensagem, $id_botao){
		echo'
	    <div class="modal fade modal_avisos" role="dialog" aria-hidden="false" id="'.$id_modal.'">
	        <div class="modal-dialog modal-sm">
	          	<div class="modal-content">
	            	<div class="modal-body">
	                	<h4>'.$mensagem.'</h4>
		        	</div>
		        	<div class="modal-footer">
		        	<script>
		        	$(document).ready(function(){
			        	$("#'.$id_botao.'").click(function(){

							$(".modal_avisos").modal("hide");
						    $(".modal_avisos-backdrop").hide();
						    $("body").css({"overflow":"scroll!important"});

			        	});
			        });
					</script>
			          <button type="button" class="btn btn-primary '.$id_botao.'" id="'.$id_botao.'"">OK</button>
		        	</div>
		        </div>
		        
		    </div>
		</div>';
	}

//Modals de Cadastro

	function modal_cadastro_pessoa(){
		global $form;
		echo'<div class="modal fade modal_pessoas" role="dialog" aria-hidden="true">
	    <div class="modal-dialog modal-lg">
	      <div class="panel panel-info">
	        <div class="panel-heading">
	          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	          <h4 class="modal-title">Novo Cadastro</h4>
	        </div>
	        <div class="panel-footer">
	           <div class="row">
	            <div class="col-md-12">
	              <label class="checkbox-inline" id="label_pessoa_fisica">
	                <input type="checkbox" id="ck_pessoa_fisica" class="checkbox_pessoa"> Pessoa Física
	              </label>
	              <label class="checkbox-inline" id="label_pessoa_juridica">
	                <input type="checkbox" id="ck_pessoa_juridica" class="checkbox_pessoa"> Pessoa Jurídica
	              </label>
	              <div class="row">
	                <div class="col-md-12">
	                  <div id="pf_sub" class="container">
	                    <label class="checkbox-inline" id="label_estudante">
	                      <input type="checkbox" id="ck_estudante" class="checkbox_sub_pessoa"> Estudante
	                    </label>
	                    <label class="checkbox-inline" id="label_motorista">
	                      <input type="checkbox" id="ck_motorista" class="checkbox_sub_pessoa"> Motorista
	                    </label>
	                    <label class="checkbox-inline" id="label_doador_pf">
	                      <input type="checkbox" id="ck_doador_pf" class="checkbox_sub_pessoa"> Doador
	                    </label>
	                  </div>
	                  <div id="pj_sub" class="container">
	                    <label class="checkbox-inline" id="label_parceiro">
	                      <input type="checkbox" id="ck_parceiro" class="checkbox_sub_pessoa"> Parceiro
	                    </label>
	                    <label class="checkbox-inline" id="label_fornecedor">
	                      <input type="checkbox" id="ck_fornecedor" class="checkbox_sub_pessoa"> Fornecedor
	                    </label>
	                    <label class="checkbox-inline" id="label_doador_pj">
	                      <input type="checkbox" id="ck_doador_pj" class="checkbox_sub_pessoa"> Doador
	                    </label>
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	        <div class="panel-body">

	          <div class="row">
	            <div class="col-md-12" id="forms_cadastro_pessoa">';
	          
	              $form->cadastro_pessoa_fisica();
	              $form->cadastro_pessoa_juridica();

	            echo '</div>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>';
	}

	function modal_cadastro_estado(){
	    $this->modal_simples('modal_estado', 'Cadastro - Estado','modal_cadastro_estado', 'cadastro_estado','modal-md');
	}

	function modal_cadastro_cidade(){
	    $this->modal_simples('modal_cidade', 'Cadastro - cidade','modal_cadastro_cidade', 'cadastro_cidade','modal-md');
	}

	function modal_cadastro_onibus (){
		$this->modal_simples('modal_onibus', 'Cadastro - Ônibus','modal_cadastro_onibus', 'cadastro_onibus','modal-md');
	}

	function modal_cadastro_plano_contas (){
		$this->modal_simples('modal_plano_contas', 'Cadastro - Plano de Contas','modal_cadastro_plano_contas', 'cadastro_plano_contas','modal-md');
	}

	function modal_cadastro_item(){
	    $this->modal_simples('modal_item', 'Cadastro - Item','modal_cadastro_item', 'cadastro_item','modal-md');
	}

	function modal_cadastro_contas_a_pagar(){
	    $this->modal_simples('modal_contas_a_pagar', 'Cadastro - Contas à Pagar','modal_contas_a_pagar', 'cadastro_contas_a_pagar','modal-lg');
	}


//Modals de Alteração
	function modal_alterar_estado(){
		$this->modal_simples('', 'Alterar - Estado','modal_alterar_estado', 'alterar_estado','modal-md');
	}

	function modal_alterar_cidade(){
		$this->modal_simples('', 'Alterar - Cidade','modal_alterar_cidade', 'alterar_cidade','modal-md');
	}

	function modal_alterar_plano_contas(){
		$this->modal_simples('', 'Alterar - Plano de Contas','modal_alterar_plano_contas', 'alterar_plano_contas','modal-md');
	}

	function modal_alterar_item(){
	    $this->modal_simples('', 'Visualizar - Item','modal_alterar_item', 'alterar_item','modal-md');
	}

	function modal_alterar_onibus(){
	    $this->modal_simples('', 'Alterar - Ônibus','modal_alterar_onibus', 'alterar_onibus','modal-md');
	}




//Modals de Exclusão
	function modal_excluir_estado(){
		$this->modal_aviso('modal_excluir_estado', 
		'Tem certeza que deseja deletar este estado?', 'btn_excluir_estado');
	}

	function modal_excluir_cidade(){
		$this->modal_aviso('modal_excluir_cidade', 
		'Tem certeza que deseja deletar esta Cidade?', 'btn_excluir_cidade');
	}

	function modal_excluir_pessoa(){
		$this->modal_aviso('modal_excluir_pessoa', 
		'Tem certeza que deseja deletar esta Pessoa?', 'btn_excluir_pessoa');
	}

	function modal_excluir_plano_contas(){
		$this->modal_aviso('modal_excluir_plano_contas', 
		'Tem certeza que deseja deletar este Plano?', 'btn_excluir_plano_contas');
	}

	function modal_excluir_item(){
		$this->modal_aviso('modal_excluir_item', 
		'Tem certeza que deseja deletar este Item?', 'btn_excluir_item');
	}

	function modal_excluir_onibus(){
		$this->modal_aviso('modal_excluir_onibus', 
		'Tem certeza que deseja deletar este Ônibus?', 'btn_excluir_onibus');
	}

	function modal_logout(){
		$this->modal_aviso('modal_logout', 
		'Tem certeza que deseja sair do sistema?', 'btn_logout');
	}

//Modals Detalhes

	function modal_view_contas_a_pagar(){
	    $this->modal_simples('modal_view_contas_a_pagar', 'Visualizar - Contas à Pagar','modal_view_contas_a_pagar', 'view_contas_a_pagar','modal-lg');
	    echo "<script>
	    	$('#cancelar_form_view_cp').hide();
	    	$('#btn_cadastro_contas_a_pagar').hide();
	    	$('#fechar_form_view_cp').show();

	    </script>";
	}


	function modal_compra_view(){
	    $this->modal_simples('', 'View - Compra','modal_compra_view', 'view_compra','modal-lg');
	}

	function modal_detalhes(){
		
		$this->modal_composto('pessoa_pj_view', 'PESSOA JURÍDICA - DETALHES','modal_pj_detalhes','modal-lg','view_pessoa_juridica');
		echo "<br>";
		$this->modal_composto('pessoa_pf_view', 'PESSOA FÍSICA - DETALHES','modal_pf_detalhes','modal-lg','view_pessoa_fisica');
	}

	function modal_cadastro_compra(){
		global $form;
		echo '
			<div class="modal fade compra pessoa_view" role="dialog" aria-hidden="false" id="modal_compra">
		      	<div class="modal-dialog modal-lg">
		      		<div class="panel panel-primary">

			       		<div class="panel-heading">
			       	 		<button type="button" class="close" data-dismiss="modal" aria-label="Close">

			            	<span aria-hidden="true">&times;</span></button>
			            	<h4 class="modal-title">COMPRA</h4>
			       		</div>

			       		<div class="panel-body">
				       		<div class="row">
						       	<div class="col-md-12">';
							    	$form->cadastro_item_compra();

		
								 echo '<table class="table table-bordered table-hover table-responsive table-condensed" id="main_tabela_itens_compra" >';
					                echo '<thead class="table-inverse">';
					                    echo '<tr>';
					                     echo "<th>Quantidade</th>";
					                     echo "<th>Descrição</th>";
					                     echo "<th>Valor Unitário</th>";
					                     echo "<th>Valor Total</th>";
					                    echo '</tr>';
					                echo '</thead>';
			                   		echo '<tbody id="tabela_itens_compra">';
				                    echo '</tbody>'; 
					             echo '</table>';

					             echo "<div class='row row_carrinho'><div class='col-md-12'><h4>Nenhum Item Adicionado ao Carrinho!</h4></div></div>";
	
							    	
							    	$form->cadastro_compra(); 	
					echo'		</div>
							</div>
			    		</div>
			 		</div>
			 	</div>
			</div>';

	}


//Modals de Aviso

	function modal_cadastro_concluido(){
		$this->modal_aviso2('modal_cadastro_concluido', 
		'Cadastro Realizado com Sucesso!', 'btn_cadastro_ok');
	}

	function modal_alterado_concluido(){
		$this->modal_aviso2('modal_alterado_concluido', 
		'Alteração Realizada com Sucesso!', 'btn_alterado_ok');
	}



}
?>