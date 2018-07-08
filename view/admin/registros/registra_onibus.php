<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';

	$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
	$motorista = isset($_POST['motorista']) ? $_POST['motorista'] : '';

	$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
	$placa = isset($_POST['placa']) ? $_POST['placa'] : '';
	$ano = isset($_POST['ano']) ? $_POST['ano'] : '';
	$assentos = isset($_POST['assentos']) ? $_POST['assentos'] : '';
	
	$sql = "insert into onibus(modelo, ano, assentos, placa, empresa, motorista ) values ('$modelo', '$assentos', '$ano', '$placa', '$empresa', '$motorista')";

//executar a query
	if(mysqli_query($link, $sql)){
	echo 'Usuário registrado com sucesso!';
	} else {
	echo mysqli_error($link);
	}

?>