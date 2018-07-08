<?php 
	require_once('../classes/db.class.php');

	$select_estado = isset($_POST['select_estado']) ? $_POST['select_estado'] : false;

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	$sql = " select * from estado";
	$resultado_id = mysqli_query($link, $sql);

	echo '<option disabled selected>Selecione</option>';
	

	while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		echo '<option value='.$registro["id_estado"].'>'.$registro["nome"].'</option>';
	}
		
?>