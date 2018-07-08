<?php 

	session_start();
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';

	function dinheiro_php($valor){
        $valor1 = str_replace(".","",$valor);
        $valor2 = str_replace(",",".", $valor1);
        return($valor2);
    }
	
	function dinheiro_html($valor){
		$valor1 = number_format($valor, 2,',','.');
		return($valor1);	
	}

if ($decisao == 1){
	$quantidade = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
	$item_id = isset($_POST['itens']) ? $_POST['itens'] : '';
	$valor_unitario = isset($_POST['valor_unitario']) ? $_POST['valor_unitario'] : '';
	$descricao;	

	$valor_unitario = dinheiro_php($valor_unitario);
	$valor_total = ($valor_unitario * $quantidade);

	$valor_unitario = dinheiro_html($valor_unitario);
	$valor_total = dinheiro_html($valor_total);

	

	if(isset($_SESSION['carrinho'][$item_id]) ){
    	echo("Este item já está no carrinho");
		die();
	}

	$sql_texto_descrisao = "select descricao from item where id_item = '$item_id'";
	$resultado_id = mysqli_query($link, $sql_texto_descrisao);
	if($resultado_id){
	    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	    $descricao = $registro['descricao'];
	}

	
	$_SESSION['carrinho'][$item_id] = array('id_item'=>$item_id,
											'quantidade'=>$quantidade,
											'descricao'=>$descricao,
											'valor_unitario'=>$valor_unitario,
											'valor_total'=>$valor_total);


	echo json_encode ($_SESSION['carrinho'][$item_id]);

}
	
if ($decisao == 2){
	$contador_chaves = 0;
	$_SESSION['total_compra'] = 0;
	foreach($_SESSION['carrinho'] as $key => $row){
		$chave = array($contador_chaves => $key);
		$contador_chaves++;
		$_SESSION['total_compra'] = dinheiro_php($_SESSION['total_compra']);
		$_SESSION['total_compra'] += dinheiro_php($_SESSION['carrinho'][$key]['valor_total']);
		$_SESSION['total_compra'] = dinheiro_html($_SESSION['total_compra']);

		
	}

	echo($_SESSION['total_compra']);

}	

if ($decisao == 3){
	unset($_SESSION['carrinho']);
	unset($_SESSION['total_compra']);
}


?>