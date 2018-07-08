<?php

  $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

?>

<!DOCTYPE HTML>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTAP</title>

<script src="lib/jquery/jquery-2.2.4.min.js"></script>
    <!-- bootstrap - link cdn -->
    <link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/estilo.css">
  
    <script>
      $(document).ready( function(){

        //verificar se os campos de usuário e senha foram devidamente preenchidos
        $('#campo_senha').formatter({'pattern': '{{999}}.{{999}}.{{999}}-{{99}}'});
        
        $('#btn_login').click(function(){

          var campo_vazio = false;

          if($('#campo_usuario').val() == ''){
            $('#campo_usuario').css({'border-color': '#A94442'});
            $('#alerta_usuario').html('Campo Vazio!');
            campo_vazio = true;
          } else {
            $('#campo_usuario').css({'border-color': '#CCC'});
            $('#alerta_usuario').html('');
          }

          if($('#campo_senha').val() == ''){
            $('#campo_senha').css({'border-color': '#A94442'});
            $('#alerta_senha').html('Campo Vazio!');
            campo_vazio = true;
          } else {
            $('#campo_senha').css({'border-color': '#CCC'});
            $('#alerta_senha').html('');
          }

          if(campo_vazio) return false;
        });
      });         
    </script>

  </head>

<body>

<header>
    <!-- Static navbar -->
      <nav class="navbar navbar-default navbar-static-top" id="menu">
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
          
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="#" >Opção</a></li>
              <li class="<?= $erro == 1 ? 'open' : '' ?>">
                <a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entrar</a>
                  <ul class="dropdown-menu" aria-labelledby="entrar">
                    <div class="col-md-12">
                      <br />
                      <form method="post" action="validar_acesso.php" id="formLogin">
                        <div class="form-group">
                          <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                          <p id="alerta_usuario" style="color: red;"></p>
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control formatter" id="campo_senha" name="senha" placeholder="Senha" />
                          <p id="alerta_senha" style="color: red;"></p>
                        </div>
                        <button type="buttom" class="btn btn-primary" id="btn_login">Entrar</button>
                        <br /><br />
                      </form>

                     <?php
                        if($erro == 1){
                          echo '<font color="#FF0000">Usuário e ou senha inválido(s)</font>';
                        }
                      ?> 
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </nav>

</header>
      

    <div class="container">

        <!-- Main component for a primary marketing message or call to action -->
        <div class="jumbotron">
          <h2>Site ainda em construção...</h2>
        </div>

        <div class="clearfix"></div>
    </div>


  
  
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    <!-- <script type="text/javascript" src="js/scripts.js"></script> -->
    <script type="text/javascript" src="lib/jquery/jquery.formatter.min.js"></script>
        
  
  </body>
</html>