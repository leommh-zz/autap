<?php

	session_start();
	require_once('conexao/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	$registro;

	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];

	$sql = " select * from pessoa WHERE email = '$usuario' and cpf_cnpj = '$senha' ";

    $resultado_id = mysqli_query($link, $sql);
    if($resultado_id){
        $dados_usuario = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);

        if (($dados_usuario['e_presidente'] == '1') 
    	or ($dados_usuario['e_vicePresidente'] == '1')
    	or ($dados_usuario['e_tesoureiro'] == '1')
    	or ($dados_usuario['e_viceTesoureiro'] == '1')
    	or ($dados_usuario['e_secretario'] == '1')){
        	$_SESSION['nome'] = $dados_usuario['nome_pessoa'];
        	$_SESSION['email'] = $dados_usuario['email'];
        	$_SESSION['comissao'] = true;
        	header('Location: view/admin/index.php');
        } else if($dados_usuario['e_estudante'] == '1'){
        	echo("Você é um estudante menino!");
        	echo("<a href='logout_acesso.php'>SAIR</a>");
        }else{
        	header('Location: index.php?erro=1');
        }
    } else {
        echo 'Erro!';
    }


?>