<?php 

	require_once('../classes/db.class.php');
	$objDb = new db();
	$link = $objDb->conecta_mysql();

	//Variaveis
		//Geral
		$cpf_cpnj;

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


	$sql_validacao = "select * from pessoa where cpf_cnpj = '$cpf_cnpj'";

	$resultado_id = mysqli_query($link, $sql_validacao);

	if($resultado_id){
	    $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
	}

	$validacao = count($registro);

	if ($validacao == 0){
		$sql="insert into pessoa(razao_social, nome_fantasia, nome_pessoa, sexo, cpf_cnpj, rg, data_nascimento, endereco, numero, complemento, bairro, cep, fone, email, e_fornecedor, e_doador, e_parceiro, e_motorista, e_presidente, e_vicePresidente, e_tesoureiro, e_estudante, e_viceTesoureiro, e_secretario, cidade_id_cidade) "; 
		$sql.="values('$razao_social', '$nome_fantasia', '$nome_pessoa', '$sexo', '$cpf_cnpj', '$rg', '$data_nascimento', '$endereco', '$numero', '$complemento', '$bairro', '$cep', '$telefone', '$email', $e_fornecedor, $e_doador, $e_parceiro, $e_motorista, $e_presidente, $e_vicePresidente, $e_tesoureiro, $e_estudante, $e_viceTesoureiro, $e_secretario, $cidade)";
	}else{
		
		echo("CPF/CNPJ Já Cadastrado!!!");
		die();
	}


	
//executar a query
	if(mysqli_query($link, $sql)){
	echo'Usuário Registrado com Sucesso';
	} else {
	echo mysqli_error($link);
	}

//Campos para Testes
	// echo "\n\n ".$sql." \n\n";

	// echo "\n\nComissão - presidente: ".$e_presidente."\n\n";
	// echo "Comissão - vicePresidente: ".$e_vicePresidente."\n\n";
	// echo "Comissão - tesoureiro: ".$e_tesoureiro."\n\n";
	// echo "Comissão - viceTesoureiro: ".$e_viceTesoureiro."\n\n";
	// echo "Comissão - secretario: ".$e_secretario."\n\n";
	


	// echo "E_ESTUDANTE: ".$e_estudante."\n";
	// echo "E_MOTORISTA: ".$e_motorista."\n";
	// echo "E_DOADOR: ".$e_doador."\n";
	// echo "E_PARCEIRO: ".$e_parceiro."\n";
	// echo "E_FORNECEDOR: ".$e_fornecedor."\n\n";
	

	// echo "Geral\n";

	// echo "Email: ".$email."\n";

	// echo "Estado: ".$estado."\n";
	
	// echo "Cidade: ".$cidade."\n";
	
	// echo "Cep: ".$cep."\n";
	
	// echo "Endereco: ".$endereco."\n";
	
	// echo "Numero: ".$numero."\n";
	
	// echo "Bairro: ".$bairro."\n";
	
	// echo "Complemento: ".$complemento."\n\n";


	// echo "Pessoa Física\n";

	// echo "Nome: ".$nome."\n";
	
	// echo "Data de Nascimento: ".$data_nascimento."\n";
	
	// echo "Sexo: ".$sexo."\n";
	
	// echo "CPF: ".$cpf."\n";
	
	// echo "RG: ".$rg."\n";
	
	// echo "Comissao: ".$comissao."\n\n";

	// echo "Pessoa Jurídica\n";

	// echo "Razão Social: ".$razao_social."\n";
	// echo "Nome Fantasia: ".$nome_fantasia."\n";
	// echo "CNPJ: ".$cnpj."\n";




?>