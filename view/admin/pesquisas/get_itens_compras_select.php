<?php 
	require_once('../classes/db.class.php');

	$objDb = new db();
	$link = $objDb->conecta_mysql();
	$sql=" select * from item where status = 1";

	$resultado_id = mysqli_query($link, $sql);

	echo '<option disabled selected>Selecione</option>';

	while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		echo '<option value='.$registro["id_item"].'>'.$registro["descricao"].'</option>';
	}
		
?>