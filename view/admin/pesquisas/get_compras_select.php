<?php 
	session_start();
	require_once('../classes/db.class.php');

	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';

	$objDb = new db();
	$link = $objDb->conecta_mysql();


	if ($decisao == 1){
		$sql="select * from compra";

		$resultado_id = mysqli_query($link, $sql);

		echo '<option disabled selected>Selecione</option>';

		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
			echo '<option value='.$registro["id_compra"].'> Data: '.$registro["data"].' | Total: '.$registro["valor_total"].'</option>';
		}
	}

	if ($decisao == 2){

		$id = isset($_POST['id']) ? $_POST['id'] : '';
		$campos = array('data','valor_total','pessoa_id_pessoa');

		$sql="select * from compra where id_compra = '".$id."'";

		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		  	for ($cont=0; $cont < 3; $cont++){
		    	$resultado_final[$cont] = $registro[$campos[$cont]];	
		    }

		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		$_SESSION['parcela_contas_a_pagar']['fornecedor_id'] = $resultado_final[2];

		$sql_fornecedor = "select * from pessoa where id_pessoa = '".$resultado_final[2]."' ";

		$resultado_id = mysqli_query($link, $sql_fornecedor);
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

		$resultado_final[2] = $registro['razao_social'];

		echo json_encode ($resultado_final);
	}

	if ($decisao == 3){
		$valor_total = isset($_POST['total']) ? $_POST['total'] : '';
		$parcelas = isset($_POST['qtde_parcela']) ? $_POST['qtde_parcela'] : '';
		$data_pagamento = isset($_POST['data']) ? $_POST['data'] : '';
		$data_corrigida = date ('d/m/Y', strtotime($data_pagamento));

		$_SESSION['parcela_contas_a_pagar']['parcelas'] = $parcelas;

		$valor_parcela = ($valor_total/$parcelas);

		echo '<table class="table table-hover">
			    <thead>
			        <tr>
			            <th>Nº</th>
			            <th>Data de Vencimento</th>
			            <th>Valor da Parcela</th>
			        </tr>
			    </thead>
			    <tbody>';
			    for($cont=1; $cont<$parcelas+1; $cont++){
				
				$data_corrigida = date('d/m/Y', strtotime($data_pagamento."+".$cont." month"));

				$_SESSION['parcela_contas_a_pagar'][$cont]['data'] = $data_corrigida;

				echo'<tr>
			            <td>'.$cont.'</td>';
			       echo'<td>'.$data_corrigida.'</td>
			       		<td> R$ '.$valor_parcela.'</td>
			        </tr>';
			    $_SESSION['parcela_contas_a_pagar'][$cont]['valor_parcela'] = $valor_parcela;
			    
			    }
			echo'</tbody>
			</table>';


	}
	
		
?>