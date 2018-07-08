<?php 

require_once('../classes/db.class.php');
$objDb = new db();
$link = $objDb->conecta_mysql();

//Variaveis
	//Geral
	$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
	$cidade_nome = isset($_POST['nome']) ? $_POST['nome'] : '';


	$sql = " insert into cidade(nome, estado_id_estado) values ('$cidade_nome', '$estado') ";

//executar a query
	if(mysqli_query($link, $sql)){
	echo 'Usuário registrado com sucesso!';
	} else {
	echo mysqli_error($link);
	}
?>