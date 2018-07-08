<?php 
	session_start();
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	function dinheiro_php($valor){
        $valor1 = str_replace(".","",$valor);
        $valor2 = str_replace(",",".", $valor1);
        return($valor2);
    }

	function dinheiro_html($valor){
		$valor1 = number_format($valor, 2,'','.');
		return($valor1);	
	}

//Variaveis
	//Geral
	$data_compra = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
	$valor_total = isset($_SESSION['total_compra']) ? $_SESSION['total_compra'] : '';
	$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
	$id_compra;

	$valor_total = dinheiro_php($valor_total);
	
	$sql_cadastro_compra = " insert into compra(data, valor_total, pessoa_id_pessoa) 
			 values ('$data_compra', '$valor_total', '$empresa') ";

	if(mysqli_query($link, $sql_cadastro_compra)){
		echo 'Compra registrada com sucesso!';
	} else {
		echo 'Erro ao registrar a Compra!';
	}

	$sql_id_compra = " select max(id_compra) from compra ";
	
	$resultado_id = mysqli_query($link, $sql_id_compra);
	if($resultado_id){
	    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	    $id_compra = $registro['max(id_compra)'];
	}

	foreach($_SESSION['carrinho'] as $key => $row){

		$_SESSION['carrinho'][$key]['valor_unitario'] = dinheiro_php($_SESSION['carrinho'][$key]['valor_unitario']);
		$_SESSION['carrinho'][$key]['valor_total'] = dinheiro_php($_SESSION['carrinho'][$key]['valor_total']);

		$sql_cadastro_itens_compra = "insert into item_compra(quantidade, valor_unitario, valor_total, item_id_item, compra_id_compra) values('".$_SESSION['carrinho'][$key]['quantidade']."', '".$_SESSION['carrinho'][$key]['valor_unitario']."', '".$_SESSION['carrinho'][$key]['valor_total']."', '".$_SESSION['carrinho'][$key]['id_item']."', '".$id_compra."')";

		if(mysqli_query($link, $sql_cadastro_itens_compra)){
			echo 'Compra registrada com sucesso!';
		} else {
			echo 'Erro ao registrar a Compra!';
			echo mysqli_error($link);
			die();
		}
	}

	unset($_SESSION['carrinho']);
	unset($_SESSION['total_compra']);

?>