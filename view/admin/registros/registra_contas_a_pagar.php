<?php 
	session_start();

	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis

	function inverteData($data){    
	   $parteData = explode("/", $data);    
	   $dataInvertida = $parteData[2] . "-" . $parteData[1] . "-" . $parteData[0];
	   return $dataInvertida;			
	}

	//Geral
	$data = isset($_POST['data_cp']) ? $_POST['data_cp'] : '';
	$valor_total = isset($_POST['valor_total']) ? $_POST['valor_total'] : '';
	$compra_id = isset($_POST['compra_cp']) ? $_POST['compra_cp'] : '';
	$fornecedor_nome = isset($_POST['fornecedor_cp']) ? $_POST['fornecedor_cp'] : '';
	$fornecedor_id = $_SESSION['parcela_contas_a_pagar']['fornecedor_id'];
	$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
	
	$n_parcelas = $_SESSION['parcela_contas_a_pagar']['parcelas'];

	$sql_cadastro_contas_a_pagar = " insert into contas_a_pagar(data, valor_total, compra_id_compra, pessoa_id_pessoa) 
	values ('$data', '$valor_total', '$compra_id', '$fornecedor_id') ";

	if(mysqli_query($link, $sql_cadastro_contas_a_pagar)){
		echo 'Compra registrada com sucesso!';
	} else {
		echo 'Erro ao registrar a Compra!';
	}

	$sql_id_contas_a_pagar = " select max(id_contas_a_pagar) from contas_a_pagar ";
	
	$resultado_id = mysqli_query($link, $sql_id_contas_a_pagar);
	if($resultado_id){
	    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	    $id_contas_a_pagar = $registro['max(id_contas_a_pagar)'];
	}

	if ($tipo == 'parcelado'){

		for ($cont = 1; $cont < $n_parcelas+1; $cont++){

			$sql_parcelas_contas_a_pagar = "insert into parcela_contas_a_pagar(vencimento, valor, contas_a_pagar_id_contas_a_pagar) values('".inverteData($_SESSION['parcela_contas_a_pagar'][$cont]['data'])."', '".$_SESSION['parcela_contas_a_pagar'][$cont]['valor_parcela']."', '".$id_contas_a_pagar."')";

			if(mysqli_query($link, $sql_parcelas_contas_a_pagar)){
				echo 'Compra registrada com sucesso!';
			} else {
				echo 'Erro ao registrar a Compra!';
				echo mysqli_error($link);
				die();
			}

			// $data_recebida = $_SESSION['parcela_contas_a_pagar'][$cont]['data'];

			// $data_mudada = date_format(new DateTime($_SESSION['parcela_contas_a_pagar'][$cont]['data']), 'Y/m/d H:i:s');

			// echo "\n";
			// echo $_SESSION['parcela_contas_a_pagar'][$cont]['data'];
			// echo "\n";
			// echo $data_mudada;
			// echo "\n";
			// echo $_SESSION['parcela_contas_a_pagar'][$cont]['valor_parcela'];
		}

		
	}
	


	unset($_SESSION['parcela_contas_a_pagar']);
?>