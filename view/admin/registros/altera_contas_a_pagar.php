<?php

	session_start();

//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';


	$campos_contas_a_pagar = array('data','valor_total', 'status', 'compra_id_compra', 'pessoa_id_pessoa');


//Pesquisa o ID no Banco de Dados
	if ($decisao == 1){

		$id_contas_a_pagar = isset($_POST['id_contas_a_pagar']) ? $_POST['id_contas_a_pagar'] : '';

		$sql = " select * from contas_a_pagar where id_contas_a_pagar = $id_contas_a_pagar ";
		$resultado_id = mysqli_query($link, $sql);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		  	for ($cont=0; $cont < count($campos_contas_a_pagar); $cont++){
		    	$resultado_final[$cont] = $registro[$campos_contas_a_pagar[$cont]];
		    }
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		$sql_id_compra = " select * from compra where id_compra = ".$resultado_final[3]." ";
		$resultado_id = mysqli_query($link, $sql_id_compra);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    $resultado_final[3] = "ID: ".$registro['id_compra']."   |   Data: ".$registro['data']."   |   Valor: ".$registro['valor_total'];
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		$sql_id_pessoa = " select * from pessoa where id_pessoa = ".$resultado_final[4]." ";
		$resultado_id = mysqli_query($link, $sql_id_pessoa);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    $resultado_final[4] = $registro['razao_social'];
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}




		//$resultado_final[1] = dinheiro_php($resultado_final[1]);
		// $resultado_final[1] = dinheiro_html($resultado_final[1]);

		echo json_encode ($resultado_final);
	}


//Pesquisa o ID das Parcelas
	if ($decisao == 2){

		$id_contas_a_pagar = isset($_POST['id_contas_a_pagar']) ? $_POST['id_contas_a_pagar'] : '';

		$sql_n_parcelas = "select COUNT(id_parcela_contas_a_pagar) from parcela_contas_a_pagar where contas_a_pagar_id_contas_a_pagar = ".$id_contas_a_pagar."";


		$resultado_id = mysqli_query($link, $sql_n_parcelas);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    $numero_parcelas = $registro['COUNT(id_parcela_contas_a_pagar)'];
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		$sql = " select * from parcela_contas_a_pagar where contas_a_pagar_id_contas_a_pagar = $id_contas_a_pagar ";
		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
			if ($numero_parcelas > 0){
				echo '<table class="table table-hover">
						<thead>
								<tr>
										<th>Nº</th>
										<th>Data de Vencimento</th>
										<th>Valor da Parcela</th>
										<th>Quitada</th>
								</tr>
						</thead>
						<tbody>';

						$cont = 1;
				 while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
					echo'<tr>
									<td>'.$cont.'</td>';
						 echo'<td>'.$registro['vencimento'].'</td>
								<td> R$ '.$registro['valor'].'</td>
								<td>';

							echo '<div class="form-group">';
						echo '<input class="meupau" data-btn_status="'.$registro['id_parcela_contas_a_pagar'].'" type="checkbox"  id="'.$registro['id_parcela_contas_a_pagar'].'" name="status" data-size="small" data-on-text="Sim" data-off-text="Não" '; if($registro["quitada"] == 0){
									echo ""; }else{ echo"checked"; } echo'  />';
					echo '</div>';


								 echo '
							</tr>';

							$cont++;
				 }





						echo'</tbody>
				</table>';

			} else {
					echo '';
			}

		}else{
			echo "";
		}
	}



//Calcula
	if ($decisao == 3){
		$id_compra = isset($_POST['id_compra']) ? $_POST['id_compra'] : '';
		$id_item = isset($_POST['id_item']) ? $_POST['id_item'] : '';
		$dados[$id_item]['quantidade'] = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
		$dados[$id_item]['valor_unitario'] = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : '';
		$valor_unitario_temp = $dados[$id_item]['valor_unitario'];

		$dados[$id_item]['valor_unitario'] = dinheiro_php($dados[$id_item]['valor_unitario']);
		$dados[$id_item]['valor_total'] = ($dados[$id_item]['quantidade'] * $dados[$id_item]['valor_unitario']);


		$_SESSION['compra_'.$id_compra][$id_item]['valor_total'] = $dados[$id_item]['valor_total'];

		$contador_chaves = 0;
		$total_compra = 0;


		foreach($_SESSION['compra_'.$id_compra] as $key => $row){
			$chave = array($contador_chaves => $key);
			$contador_chaves++;

			$total_compra += $_SESSION['compra_'.$id_compra][$key]['valor_total'];

		}

		$_SESSION['compra_'.$id_compra][$id_item]['valor_total'] = dinheiro_html($_SESSION['compra_'.$id_compra][$id_item]['valor_total']);
		$_SESSION['compra_'.$id_compra][$id_item]['quantidade'] = $dados[$id_item]['quantidade'];
		$_SESSION['compra_'.$id_compra][$id_item]['valor_unitario'] = $valor_unitario_temp;

		$dados[$id_item]['valor_unitario'] = $dados[$id_item]['valor_unitario'];
		$dados[$id_item]['valor_total'] = dinheiro_html($dados[$id_item]['valor_total']);
		$total_compra = dinheiro_html($total_compra);


		$resultado_final = array(0=>$dados[$id_item]['quantidade'], 1=>$dados[$id_item]['valor_total'], 2=>$total_compra);
		echo json_encode ($resultado_final);

	}


//Altera
 	if ($decisao == 4){
 		$id_compra = isset($_POST['id_compra']) ? $_POST['id_compra'] : '';
		$data = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
		$valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '';
		$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';

		$valor_total = dinheiro_php ($valor_total);

		$sql_altera_compra = " update compra set data = '$data', valor_total = '$valor_total', pessoa_id_pessoa = '$empresa' where id_compra = '$id_compra' ";

		echo $sql_altera_compra."\n\n";

		if(mysqli_query($link, $sql_altera_compra)){
			echo 'Compra registrada com sucesso!';
		} else {
			echo 'Erro ao registrar a Compra!';
		}


		foreach($_SESSION['compra_'.$id_compra] as $key => $row){

			$_SESSION['compra_'.$id_compra][$key]['valor_unitario'] = $_SESSION['compra_'.$id_compra][$key]['valor_unitario'];


			$sql_altera_itens_compra = " update item_compra set quantidade = '".$_SESSION['compra_'.$id_compra][$key]['quantidade']."', valor_unitario = '".dinheiro_php($_SESSION['compra_'.$id_compra][$key]['valor_unitario'])."', valor_total = '".dinheiro_php($_SESSION['compra_'.$id_compra][$key]['valor_total'])."' where id_item_compra = '".$_SESSION['compra_'.$id_compra][$key]['id_item_compra']."' ";

			echo $sql_altera_itens_compra."\n\n";

			if(mysqli_query($link, $sql_altera_itens_compra)){
				echo 'Compra registrada com sucesso!';
			} else {
				echo 'Erro ao registrar a Compra!';
				echo mysqli_error($link);
				die();
			}

		}

 	}



//Altera estado quitada

 	if ($decisao == 5){
 		$id_btn_quitada = isset($_POST['id_btn_quitada']) ? $_POST['id_btn_quitada'] : '';
 		$estado_btn_quitada = isset($_POST['btn_estado']) ? $_POST['btn_estado'] : '';

 		if ($estado_btn_quitada == 'true'){
 			$estado_binario_quitada = 1;
 		}else if ($estado_btn_quitada == 'false'){
 			$estado_binario_quitada = 0;
 		}

 		$sql_quitada = "update parcela_contas_a_pagar set quitada = '$estado_binario_quitada' where id_parcela_contas_a_pagar = '".$id_btn_quitada."'";

 		if(mysqli_query($link, $sql_quitada)){
			echo 'Compra registrada com sucesso!';
		} else {
			echo 'Erro ao registrar a Compra!';
			echo mysqli_error($link);
			die();
		}


 	}

?>
