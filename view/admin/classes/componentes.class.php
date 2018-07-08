<?php 
	class Componentes{

		public $id;
		public $nome;
		public $tipo;
		public $placeholder;

		function campo_texto($id, $nome, $placeholder, $tipo, $name, $pattern, $min=''){
			echo '<div class="form-group">';	
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<input type='.$tipo.' class="form-control formatter" id='.$id.' placeholder='.$placeholder.' name='.$name.' '.$min.'>';

				if ($pattern != 'no_mask'){
				echo "<script type='text/javascript'>";
						echo" $('#".$id."').formatter({'pattern': '".$pattern."'});";
				echo"</script>";
				}

				
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';	
		}

		function campo_data($id, $nome){
			echo '<div class="form-group">';	
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<input type="date" class="form-control" id='.$id.' name="data_nascimento">';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';	
		}

		function campo_data2($id, $nome){
			echo '<div class="form-group">';	
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<input type="date" class="form-control" id='.$id.' name="'.$id.'">';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';	
		}

		function campo_cidade($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for="campo_cidade">'.$nome.'</label>';
				echo '<select class="form-control campo_cidade" id="'.$id.'" name="cidade">';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_estado($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for="campo_estado">'.$nome.'</label>';
				echo '<select class="form-control campo_estado" id="'.$id.'" name="estado">';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_sexo($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control" id='.$id.' name="sexo">';
					echo '<option disabled selected>Escolha</option>';
					echo '<option>Masculino</option>';
					echo '<option>Feminino</option>';
					echo '<option>Outro</option>';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_comissao($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control" id='.$id.' name="comissao">';
					echo '<option value=0>Nenhum</option>';
					echo '<option value=1>Presidente</option>';
					echo '<option value=2>Vice_Presidente</option>';
					echo '<option value=3>Tesoureiro</option>';
					echo '<option value=4>Vice_Tesoureiro</option>';
					echo '<option value=5>Secretário</option>';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_onibus($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control" id='.$id.' name="onibus">';
					echo '<option>Onibus1</option>';
					echo '<option>Onibus2</option>';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_empresa($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control campo_empresa" id='.$id.' name="empresa">';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_motorista($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control campo_motorista" id='.$id.' name="motorista">';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_plano_contas($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control" id='.$id.' name="plano_contas">';
					echo '<option disabled selected>Escolha</option>';
					echo '<option value="Credora">Credora</option>';
					echo '<option value="Devedora">Devedora</option>';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_textarea($id, $nome){
			echo '<div class="form-group">';
					echo '<textarea rows="5" cols="50" maxlength="500" id='.$id.' placeholder="'.$nome.'" name="descricao"></textarea>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_status($id, $nome){
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'';
				echo "<br/>";
					echo '<input type="checkbox" id='.$id.' name="status" data-size="small" data-on-text="Ativo" data-off-text="Inativo" checked>';
				echo '</label>';	
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_tipo_item($id, $nome, $tipo){	
			echo '<div class="form-group">';
				echo '<label for='.$id.'>'.$nome.'</label>';
				echo '<select class="form-control" id='.$id.' name="'.$tipo.'">';
					echo '<option disabled selected>Escolha</option>';
					echo '<option value="Serviço">Serviço</option>';
					echo '<option value="Produto">Produto</option>';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function campo_itens($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for="'.$id.'">'.$nome.'</label>';
				echo '<select class="form-control campo_itens" id="'.$id.'" name="itens">';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		function select_padrao($id, $nome){	
			echo '<div class="form-group">';
				echo '<label for="'.$id.'">'.$nome.'</label>';
				echo '<select class="form-control '.$id.'" id="'.$id.'" name="'.$id.'">';
				echo '</select>';
				echo'<div class="help-block with-errors"></div>';
			echo '</div>';
		}

		
	}



?>

<html>
	<head>
		<script src="../../lib/jquery/jquery-2.2.4.min.js"></script>
		<script src="../../lib/jquery/jquery.validate.js"></script>
	  	<script src="../../lib/jquery/jquery.formatter.min.js"></script>
	    <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
	</head>
</html>