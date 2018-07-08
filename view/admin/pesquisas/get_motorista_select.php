<?php 
	require_once('../classes/db.class.php');

	$select_motorista = isset($_POST['select_motorista']) ? $_POST['select_motorista'] : false;

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	$sql = " select * from pessoa where e_motorista = '1'";
	$resultado_id = mysqli_query($link, $sql);

	echo '<option disabled selected>Selecione</option>';
	
	while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		echo '<option value='.$registro["id_pessoa"].'>'.$registro["nome_pessoa"].'</option>';
	}
		
?>