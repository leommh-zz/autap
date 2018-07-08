<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';
	$id_estado = isset($_POST['id_estado']) ? $_POST['id_estado'] : '';
	$nome_estado_alterado = isset($_POST['estado']) ? $_POST['estado'] : '';
	$sigla_estado_alterada = isset($_POST['sigla']) ? $_POST['sigla'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : 'off';
	$status_inicial;

	if ($status == 'on'){
		$status = 1;
	}else if($status == 'off'){
		$status = 0;
	}
	
//Pesquisa o ID no Banco de Dados
	if ($decisao == 1){

		$sql = " select * from estado where id_estado = $id_estado ";

		$resultado_id = mysqli_query($link, $sql);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    $status_inicial = $registro['status'];
		  	$resultado_final = array('0' => $registro['nome'], '1' => $registro['sigla'], '2' => $registro['status'] ); 
			echo json_encode ($resultado_final);
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}
	}

//Altera o Estado no Banco de Dados
	if ($decisao == 2){

		$sql = "select * from cidade where estado_id_estado = $id_estado";
		$resultado_id = mysqli_query($link, $sql);
		$registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);


		$sql="update estado set nome = '$nome_estado_alterado', sigla = '$sigla_estado_alterada', status = '$status' where id_estado = $id_estado";

		if(mysqli_query($link, $sql)){
			echo 'Usuário alterado com sucesso!';
		} else {
			echo 'Erro ao registrar o usuário!';
		}
	
	}

//Deleta o Estado do Banco de Dados
	if ($decisao == 3){

		$sql="select * from cidade where estado_id_estado = $id_estado";
		$resultado_id = mysqli_query($link, $sql);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    if ($registro !== null) {
		    	echo "O estado não pode ser deletado, pois existem cidades cadastradas nele.";
		    	die();
		    }
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		$sql="delete from estado where id_estado = $id_estado";


		if(mysqli_query($link, $sql)){
		} else {
			echo 'Erro ao registrar o usuário!';
		}

	}

?>