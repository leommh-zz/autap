<?php 

require_once('../classes/db.class.php');
$objDb = new db();
$link = $objDb->conecta_mysql();

//Variaveis
	//Geral
	$estado_nome = isset($_POST['estado']) ? $_POST['estado'] : '';
	$estado_sigla = isset($_POST['sigla']) ? $_POST['sigla'] : '';


	echo "Nome: ".$estado_nome."  ";
	echo "Sigla: ".$estado_sigla."  ";


$sql = " insert into estado(nome, sigla) values ('$estado_nome', '$estado_sigla') ";

//executar a query
if(mysqli_query($link, $sql)){
	echo 'Usuário registrado com sucesso!';
} else {
	echo 'Erro ao registrar o usuário!';
}

		
	


?>