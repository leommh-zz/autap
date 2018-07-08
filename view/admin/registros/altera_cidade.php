<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';
	$id_cidade = isset($_POST['id_cidade']) ? $_POST['id_cidade'] : '';

	$nome_cidade_alterada = isset($_POST['nome']) ? $_POST['nome'] : '';
	$estado_alterado = isset($_POST['estado']) ? $_POST['estado'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : 'off';

	$nome_estado;
	$nome_cidade;
	$id_estado;
	$id_estado_alterado;

	if ($status == 'on'){
		$status = 1;
	}else if($status == 'off'){
		$status = 0;
	}
	
//Pesquisa o ID no Banco de Dados
	if ($decisao == 1){

		$sql="select * from cidade where id_cidade = $id_cidade";
		$resultado_id = mysqli_query($link, $sql);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    $id_estado = $registro['estado_id_estado'];
		    $nome_cidade = $registro['nome'];
		    $status_cidade = $registro['status'];
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		$resultado_final = array('0' => $id_estado, '1' => $nome_cidade, '2' => $status_cidade); 
		echo json_encode ($resultado_final);

	}

//Altera a Cidade no Banco de Dados
	if ($decisao == 2){


		$sql="update cidade set nome = '$nome_cidade_alterada', estado_id_estado = $estado_alterado, status = '$status' where id_cidade = $id_cidade";

		if(mysqli_query($link, $sql)){
			echo 'Usuário alterado com sucesso!';
		} else {
			echo 'Erro ao registrar o usuário!';
		}

	}

//Deleta a Cidade do Banco de Dados
	if ($decisao == 3){
	
		$id_cidade = isset($_POST['id_cidade']) ? $_POST['id_cidade'] : '';

		$sql="delete from cidade where id_cidade = $id_cidade";

		

		if(mysqli_query($link, $sql)){
			echo 'Usuário Deletado com sucesso!';
		} else {
			echo 'Erro ao Deletar o usuário!';
		}

	}

?>