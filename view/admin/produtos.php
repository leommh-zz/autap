<?php 
  require_once('header.php');
  require_once("classes/modals.class.php");
  $modal = new Modals;
?>

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>PRODUTOS</h4>
      <button type="button" class="btn btn-info btn_novo_item" id="btn_novo_item"> Novo Cadastro </button>
      <form class="form-search form-inline" style="float: right;">
        <input type="text" class="input-medium search-query form-control">
        <span><button type="submit" class="btn btn-info">Pesquisar</button></span>
      </form>
    </div>

    <div class="panel-body">
      <div class="table-responsive" id="tabela_itens"></div>   
    <form id="formPesquisa">
      <input type="hidden" name="registros_por_pagina" id="registros_por_pagina" value="8" />
      <input type="hidden" name="offset" id="offset" value="0" />
    </form>  
    </div>
  </div>
</div>

<script type="text/javascript" src="js/get_item_ajax.js"></script>
<?php $modal->modal_cadastro_item(); ?>
<?php $modal->modal_alterar_item(); ?>
<?php $modal->modal_excluir_item(); ?>
<script type="text/javascript" src="js/controle_item.js"></script>
<?php require_once('footer.php'); ?>

