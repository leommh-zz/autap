<?php 
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	//Geral
	$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
	$natureza = isset($_POST['plano_contas']) ? $_POST['plano_contas'] : '';



	$sql = " insert into plano_contas(tipo, descricao) values ('$natureza', '$descricao') ";

	//executar a query
	if(mysqli_query($link, $sql)){
		echo 'Plano de Contas registrado com sucesso!';
	} else {
		echo 'Erro ao registrar o Plano de Contas!';
	}

	echo "\nDescrição: ".$descricao."  \n";
	echo "Natureza da Conta: ".$natureza."  \n";
?>