<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';
	$id_plano = isset($_POST['id_plano_contas']) ? $_POST['id_plano_contas'] : '';

	$nome_alterado = isset($_POST['descricao']) ? $_POST['descricao'] : '';
	$campos_plano_contas = array('descricao','tipo');

	function limpar_natureza(){
		$e_credora = 0;
		$e_devedora = 0;
	}


//Pesquisa o ID no Banco de Dados
	if ($decisao == 1){

		$sql = " select * from plano_contas where id_plano_contas = $id_plano ";
		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		  	for ($cont=0; $cont < 2; $cont++){
		    	$resultado_final[$cont] = $registro[$campos_plano_contas[$cont]];	
		    }
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		echo json_encode ($resultado_final);
	}

//Altera o Estado no Banco de Dados
 	if ($decisao == 2){
 		$sql="update plano_contas set descricao = '$nome_alterado' where id_plano_contas = $id_plano";
 		if(mysqli_query($link, $sql)){
 			echo 'Plano de Contas alterado com sucesso!';
 		} else {
 			echo 'Erro ao alterar o Plano de Contas!';
 		}
 	}

//Deleta o Estado do Banco de Dados
 	if ($decisao == 3){
 		
 		// $sql="select * from plano_contas where id_plano_contas = $id_plano";
 		// $resultado_id = mysqli_query($link, $sql);
 		// if($resultado_id){
 		//     $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
 		//     if ($registro !== null) {
 		//     	echo "O Plano não pode ser deletado, pois existem registros cadastrados nele.";
 		//     	die();
 		//     }
 		// } else {
 		//     echo 'Erro ao tentar recuperar o total de registros!';
 		// }
 		
 		$sql="delete from plano_contas where id_plano_contas = $id_plano";
 		if(mysqli_query($link, $sql)){
 		} else {
 			echo 'Erro ao registrar o Plano de Contas!';
 		}
 	}

?>