<?php 

	session_start();

//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';

	
	$campos_compra = array('data','valor_total', 'status', 'pessoa_id_pessoa', 'id_compra');

    function dinheiro_php($valor){
        $valor1 = str_replace(".","",$valor);
        $valor2 = str_replace(",",".", $valor1);
        return($valor2);
    }
    
    function dinheiro_html($valor){
        $valor1 = number_format($valor, 2,',','.');
        return($valor1);    
    }

//Pesquisa o ID no Banco de Dados
	if ($decisao == 1){
		$id_compra = isset($_POST['id_compra']) ? $_POST['id_compra'] : '';
		$sql = " select * from compra where id_compra = $id_compra ";
		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		  	for ($cont=0; $cont < count($registro); $cont++){
		    	$resultado_final[$cont] = $registro[$campos_compra[$cont]];	
		    }
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		//$resultado_final[1] = dinheiro_php($resultado_final[1]);
		$resultado_final[1] = dinheiro_html($resultado_final[1]);

		echo json_encode ($resultado_final);
	}

//Calcula
	if ($decisao == 2){
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
 	if ($decisao == 3){
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


?>