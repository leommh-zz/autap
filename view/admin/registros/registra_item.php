<?php 
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	//Geral

	$_SESSION['nome_item'] = isset($_POST['nome']) ? $_POST['nome'] : '';
	$_SESSION['tipo_item'] = isset($_POST['tipo']) ? $_POST['tipo'] : '';
	$_SESSION['quantidade_item'] = isset($_POST['quantidade']) ? $_POST['quantidade'] : '';
	$_SESSION['peso_item'] = isset($_POST['peso']) ? $_POST['peso'] : '';
	$_SESSION['marca_item'] = isset($_POST['marca']) ? $_POST['marca'] : '';
	$_SESSION['genero_item'] = isset($_POST['descricao']) ? $_POST['descricao'] : '';



	$sql = " insert into item(descricao, tipo, quantidade, peso, marca, genero) values ('".ucwords(strtolower($_SESSION['nome_item']))."', '".$_SESSION['tipo_item']."', '".$_SESSION['quantidade_item']."', '".$_SESSION['peso_item']."', '".$_SESSION['marca_item']."', '".$_SESSION['genero_item']."' )";

	//executar a query
	if(mysqli_query($link, $sql)){
		echo 'Serviço registrado com sucesso!';
	} else {
		echo 'Erro ao registrar o Serviço!';
	}

	echo "\Nome: ".$_SESSION['descricao_item']."  \n";
	echo "Tipo: ".$_SESSION['tipo_item']."  \n";
?>