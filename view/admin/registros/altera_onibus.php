<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';
	$id_onibus = isset($_POST['id_onibus']) ? $_POST['id_onibus'] : '';

	$empresa = isset($_POST['empresa']) ? $_POST['empresa'] : '';
	$motorista = isset($_POST['motorista']) ? $_POST['motorista'] : '';
	$status = isset($_POST['status']) ? $_POST['status'] : 'off';
	$modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
	$placa = isset($_POST['placa']) ? $_POST['placa'] : '';
	$ano = isset($_POST['ano']) ? $_POST['ano'] : '';
	$assentos = isset($_POST['assentos']) ? $_POST['assentos'] : '';

	$campos_onibus = array('modelo', 'placa', 'ano', 'assentos', 'empresa', 'motorista', 'status');

	if ($status == 'on'){
		$status = 1;
	}else if($status == 'off'){
		$status = 0;
	}

//Pesquisa o ID no Banco de Dados
	if ($decisao == 1){

		$sql = " select * from onibus where id_onibus = $id_onibus ";
		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		  	for ($cont=0; $cont < 7; $cont++){
		    	$resultado_final[$cont] = $registro[$campos_onibus[$cont]];	
		    }
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		echo json_encode ($resultado_final);
	}

//Altera o Estado no Banco de Dados
 	if ($decisao == 2){
 		$sql="update onibus set modelo = '$modelo', placa = '$placa', ano = '$ano', assentos = '$assentos', empresa = '$empresa', motorista = '$motorista', status = '$status' where id_onibus = '$id_onibus'";

 		if(mysqli_query($link, $sql)){
 			echo 'Serviço alterado com sucesso!';
 		} else {
 			echo 'Erro ao alterar o Serviço!';
 		}
 	}

//Deleta o Estado do Banco de Dados
 	if ($decisao == 3){
 		
 		$sql="delete from onibus where id_onibus = $id_onibus";
 		if(mysqli_query($link, $sql)){
 		} else {
 			echo 'Erro ao registrar o Plano de Contas!';
 		}
 	}

?>