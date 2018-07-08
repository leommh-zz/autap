<?php 
//Conexão com o Banco de Dados
	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

//Variaveis

	$decisao = isset($_POST['decisao']) ? $_POST['decisao'] : '';
	$tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
	$id_pessoa = $_POST['id_pessoa'];
	
	$resultado_final;
	$id_cidade;

	//Alteração

		$cpf_cpnj;
		$status = isset($_POST['status']) ? $_POST['status'] : 'off';
		$estado = isset($_POST['estado']) ? $_POST['estado'] : '';
		$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : '';
		$cep = isset($_POST['cep']) ? $_POST['cep'] : '';
		$endereco = isset($_POST['endereco']) ? $_POST['endereco'] : '';
		$numero = isset($_POST['numero']) ? $_POST['numero'] : '';
		$bairro = isset($_POST['bairro']) ? $_POST['bairro'] : '';
		$complemento = isset($_POST['complemento']) ? $_POST['complemento'] : '';

		//Pessoa Fisica
		$nome_pessoa = isset($_POST['nome']) ? $_POST['nome'] : '';
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : '';
		$sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
		$cpf = isset($_POST['cpf']) ? ($_POST['cpf']) : '';
		$rg = isset($_POST['rg']) ? ($_POST['rg']): '';
		$telefone = isset($_POST['telefone']) ? ($_POST['telefone']): '';
		
		//Pessoa Física - Especiais
		$comissao = isset($_POST['comissao']) ? $_POST['comissao'] : '';
		$e_presidente = 0;
		$e_vicePresidente = 0;
		$e_tesoureiro = 0;
		$e_viceTesoureiro = 0;
		$e_secretario = 0;
		

		//Pessoa Física - Nível de Acesso 

		$e_estudante = isset($_POST['e_estudante']) ? $_POST['e_estudante'] : '';
		$e_motorista = isset($_POST['e_motorista']) ? $_POST['e_motorista'] : '';
		$e_doador = isset($_POST['e_doador']) ? $_POST['e_doador'] : '';
		$e_parceiro = isset($_POST['e_parceiro']) ? $_POST['e_parceiro'] : '';
		$e_fornecedor = isset($_POST['e_fornecedor']) ? $_POST['e_fornecedor'] : '';

		//Pessoa Jurídica
		$razao_social = isset($_POST['razao_social']) ? $_POST['razao_social'] : '';
		$nome_fantasia = isset($_POST['nome_fantasia']) ? $_POST['nome_fantasia'] : '';
		$cnpj = isset($_POST['cnpj']) ? ($_POST['cnpj']) : '';


		$email_existe = 0;
		$razao_social_existe = 0;
		$cpf_existe = 0;
		$cnpj_existe = 0;
		$rg_existe = 0;

	if ($status == 'on'){
		$status = 1;
	}else if($status == 'off'){
		$status = 0;
	}

	
function limpar_comissao(){
	$e_presidente = 0;
	$e_vicePresidente = 0;
	$e_tesoureiro = 0;
	$e_viceTesoureiro = 0;
	$e_secretario = 0;
}


switch ($comissao) {
    case '0':
        limpar_comissao();
        break;
    case '1':
        limpar_comissao();
        $e_presidente = 1;
        break;	 
    case '2':
        limpar_comissao();
        $e_vicePresidente = 1;
        break;	
    case '3':
        limpar_comissao();
        $e_tesoureiro = 1;
        break;
    case '4':
        limpar_comissao();
        $e_viceTesoureiro = 1;
        break;	
    case '5':
        limpar_comissao();
        $e_secretario = 1;
        break;	   
	}

	if ($cpf == '') {
		$cpf_cnpj = $cnpj;
	}else if ($cnpj == ''){
		$cpf_cnpj = $cpf;
	}

$campos_pf = array('nome_pessoa', 'sexo', 'cpf_cnpj', 'rg', 'endereco', 'numero', 'complemento', 'bairro', 'cep', 'fone', 'email','data_nascimento', 'e_estudante', 'e_motorista', 'e_doador', 'status', 'e_presidente','e_vicePresidente', 'e_tesoureiro', 'e_viceTesoureiro', 'e_secretario','status', 'cidade_id_cidade');

$campos_pj = array('razao_social', 'nome_fantasia', 'cpf_cnpj', 'email', 'fone', 'cep', 'complemento','endereco', 'numero', 'bairro', 'e_parceiro','e_fornecedor', 'e_doador','status', 'cidade_id_cidade');


//Pesquisa o ID no Banco de Dados - Pessoa Física
	if ($decisao == 1 && $tipo=='pf'){

		$sql="select nome_pessoa, sexo, cpf_cnpj, rg, endereco, numero, complemento, bairro, cep, fone, email, data_nascimento, e_estudante, e_motorista, e_doador, status, e_presidente, e_vicePresidente, e_tesoureiro, e_viceTesoureiro, e_secretario, cidade_id_cidade from pessoa where 
			id_pessoa = $id_pessoa";
		$resultado_id = mysqli_query($link, $sql);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    for ($cont=0; $cont < 23; $cont++){
		    	$resultado_final[$cont] = $registro[$campos_pf[$cont]];
		    	
		    }
		    $id_cidade = $registro['cidade_id_cidade'];

		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}


		$sql_estado = "select estado_id_estado from cidade where id_cidade = $id_cidade";
		$resultado_id = mysqli_query($link, $sql_estado);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    	$resultado_final[24] = $registro['estado_id_estado'];
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		echo json_encode ($resultado_final);

	}

	if ($decisao == 1 && $tipo=='pj'){

		$sql="select razao_social, nome_fantasia, cpf_cnpj, email, fone, cep, complemento, endereco, numero, bairro, e_parceiro,  e_fornecedor, e_doador, status, cidade_id_cidade from pessoa where id_pessoa = $id_pessoa";


		$resultado_id = mysqli_query($link, $sql);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    for ($cont=0; $cont < 14; $cont++){
		    	$resultado_final[$cont] = $registro[$campos_pj[$cont]];
		    	
		    }
		    $id_cidade = $registro['cidade_id_cidade'];

		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}


		$sql_estado = "select estado_id_estado from cidade where id_cidade = $id_cidade";
		$resultado_id = mysqli_query($link, $sql_estado);
		if($resultado_id){
		    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
		    	$resultado_final[14] = $id_cidade;
		    	$resultado_final[15] = $registro['estado_id_estado'];
		} else {
		    echo 'Erro ao tentar recuperar o total de registros!';
		}

		echo json_encode ($resultado_final);

	}

//Altera a Pessoa Física no Banco de Dados
	if ($decisao == 2){

		$sql="update pessoa set razao_social = '$razao_social', nome_fantasia = '$nome_fantasia', nome_pessoa = '$nome_pessoa', sexo = '$sexo', data_nascimento = '$data_nascimento', cpf_cnpj = '$cpf_cnpj', rg = '$rg', endereco = '$endereco', numero = '$numero', complemento = '$complemento', bairro = '$bairro', cep = '$cep', fone = '$telefone', email = '$email', e_fornecedor = $e_fornecedor, e_doador = $e_doador, e_parceiro = $e_parceiro, e_motorista = $e_motorista, e_presidente = $e_presidente, e_vicePresidente = $e_vicePresidente, e_tesoureiro = $e_tesoureiro, e_estudante = $e_estudante, e_viceTesoureiro = $e_viceTesoureiro, e_secretario = $e_secretario, status = $status, cidade_id_cidade = $cidade where id_pessoa = $id_pessoa";


		if(mysqli_query($link, $sql)){
			echo 'Usuário alterado com sucesso!';
		} else {
			echo 'Erro ao registrar o usuário!';
			
			echo mysqli_error ($link);
		}

	}

//Deleta a Pessoa do Banco de Dados
	if ($decisao == 3){
	
		$sql="delete from pessoa where id_pessoa = $id_pessoa";

		if(mysqli_query($link, $sql)){
			echo 'Usuário Deletado com sucesso!';
		} else {
			echo 'Erro ao Deletar o usuário!';
		}

	}

?>