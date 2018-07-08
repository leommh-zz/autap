<?php

  session_start();

  if(!isset($_SESSION['comissao'])){
    header('Location: ../../logout_acesso.php');
  }

  require_once("classes/modals.class.php"); 
  $modal = new Modals;
  $modal->modal_cadastro_concluido();
  $modal->modal_alterado_concluido();
  $modal->modal_logout();


  // $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
   
?>

<script type="text/javascript">
  function aviso(i){
    //função para fazer anicamão nas mensagens da tela
    jQuery.fn.wait = function (MiliSeconds) {
        $(this).animate({ opacity: '+=0' }, MiliSeconds);
        return this;
    }

    $('#aviso').show();
    $('#aviso').fadeIn().wait(400).fadeOut('slow');
    $('#content-aviso').html(i);
}
</script>

<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AUTAP</title>

    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../lib/bootstrap/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  </head>

<body>

  <div id="aviso" class="alert alert-info"> <span id="content-aviso"></span> </div>

  <header>
        <nav class="navbar navbar-theme navbar-static-top" id="menu">
          <div class="container">
            <div class="navbar-header" >
              
              <button type="button" class="navbar-toggle collapsed color-white" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Altenar Navegação</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>

              <a href="index.php" class="navbar-brand">
                <span class="img-logo color-white">AUTAP</span>
              </a>

          
            </div>

            <div class="hidden-sm hidden-xs col-md-3 ">
              <div id="painel_user">
              <div class="container">
                <img src="../../img/perfil1.png"> 
                <span><?php echo $_SESSION['nome']; ?></span>
                </div>
              </div>
            </div>  

            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="pessoas.php" >Pessoas</a></li>
                <li><a href="onibus.php" >Ônibus</a></li>
                <li class="dropdown">
                  <a id="financeiro" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Movimentações</a>
                  <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="financeiro">
                    <li><a href="produtos.php" >Produtos</a></li>
                    <li><a href="compra.php" >Compra</a></li>
                    <li><a href="#" >Rateio</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a id="financeiro" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Financeiro</a>
                  <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="financeiro">
                    <li><a href="plano_contas.php" >Plano de Contas</a></li>
                    <li><a href="contas_a_pagar.php" >Contas à Pagar</a></li>
                    <li><a href="#" >Contas à Receber</a></li>
                  </ul>
                </li>
                <li class="dropdown">
                  <a id="extras" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle">Extras</a>
                  <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="extras">
                    <li><a href="estados.php" >Estados</a></li>
                    <li><a href="cidades.php" >Cidades</a></li>
                  </ul>
                </li>
                
                <li class="divider"></li>
                <li><a href="#" id="logout">Sair</a></li>
                
              </ul>
            </div>
          </div>
        </nav>

    

  </header>
  <!-- Alertas -->