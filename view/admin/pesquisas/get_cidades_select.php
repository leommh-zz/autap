<?php 
	require_once('../classes/db.class.php');

	$valor_estado = isset($_POST['estado']) ? $_POST['estado'] : '';


	$objDb = new db();
	$link = $objDb->conecta_mysql();
	$sql=" select C.id_cidade, C.nome, C.estado_id_estado, C.status from cidade AS C ";
	$sql.="INNER JOIN ESTADO AS ES on C.ESTADO_ID_ESTADO = ES.ID_ESTADO ";
	$sql.="WHERE ES.ID_ESTADO = '$valor_estado';";

	$resultado_id = mysqli_query($link, $sql);

	echo '<option disabled selected>Selecione</option>';

	while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
		echo '<option value='.$registro["id_cidade"].'>'.$registro["nome"].'</option>';
	}
		
?>