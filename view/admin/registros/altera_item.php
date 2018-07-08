<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis
	$_SESSION['$decisao_item'] = isset($_POST['decisao']) ? $_POST['decisao'] : ''; 
	$_SESSION['$id_item'] = isset($_POST['id_item']) ? $_POST['id_item'] : '';
	$_SESSION['$status_item'] = isset($_POST['status']) ? $_POST['status'] : 'off';


	$_SESSION['nome_item'] = isset($_POST['altera_nome']) ? $_POST['altera_nome'] : '';
	$_SESSION['tipo_item'] = isset($_POST['altera_tipo']) ? $_POST['alter_tipo'] : '';
	$_SESSION['quantidade_item'] = isset($_POST['altera_quantidade']) ? $_POST['altera_quantidade'] : '';
	$_SESSION['peso_item'] = isset($_POST['altera_peso']) ? $_POST['altera_peso'] : '';
	$_SESSION['marca_item'] = isset($_POST['altera_marca']) ? $_POST['altera_marca'] : '';
	$_SESSION['genero_item'] = isset($_POST['descricao']) ? $_POST['descricao'] : '';


	
	$campos_item = array('descricao','tipo', 'status', 'quantidade', 'marca', 'genero', 'peso');


	if ($_SESSION['$status_item'] == 'on'){
		$_SESSION['$status_item'] = 1;
	}else if($_SESSION['$status_item'] == 'off'){
		$_SESSION['$status_item'] = 0;
	}
	
//Pesquisa o ID no Banco de Dados
	if ($_SESSION['$decisao_item'] == 1){

		$sql = " select * from item where id_item = ".$_SESSION['$id_item']."";
		$resultado_id = mysqli_query($link, $sql);

		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		  	for ($cont=0; $cont < 7; $cont++){
		    	$resultado_final[$cont] = $registro[$campos_item[$cont]];	
		    }
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		echo json_encode ($resultado_final);
	}

//Altera o Serviço no Banco de Dados
 	if ($_SESSION['$decisao_item'] == 2){
 		$sql="update item set descricao = '".$_SESSION['nome_item']."', status = '".$_SESSION['$status_item']."', quantidade = '".$_SESSION['quantidade_item']."', peso = '".$_SESSION['peso_item']."', marca = '".$_SESSION['marca_item']."', genero = '".$_SESSION['genero_item']."' where id_item =".$_SESSION['$id_item']."";

 		if(mysqli_query($link, $sql)){
 			echo 'Serviço alterado com sucesso!';
 		} else {
 			echo 'Erro ao alterar o Serviço!';
 		}
 	}

//Deleta o Serviço do Banco de Dados
 	if ($_SESSION['$decisao_item'] == 3){
 		
 		$sql="delete from item where id_item = ".$_SESSION['$id_item']." ";
 		if(mysqli_query($link, $sql)){
 		} else {
 			echo 'Erro ao registrar o Plano de Contas!';
 		}
 	}

?>