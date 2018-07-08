<?php 
  require_once('header.php');
  require_once("classes/modals.class.php");
  $modal = new Modals;
?>

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>COMPRA</h4>
      <button type="button" class="btn btn-info btn_nova_compra"> Novo Cadastro </button>
      <form class="form-search form-inline" style="float: right;">
        <input type="text" class="input-medium search-query form-control">
        <span><button type="submit" class="btn btn-info">Pesquisar</button></span>
      </form>
    </div>

    <div class="panel-body">
      <div class="table-responsive" id="tabela_compra"></div>   
    <form id="formPesquisa">
      <input type="hidden" name="registros_por_pagina" id="registros_por_pagina" value="8" />
      <input type="hidden" name="offset" id="offset" value="0" />
    </form>  
    </div>
  </div>
</div>

<script type="text/javascript" src="js/get_itens_compra_ajax.js"></script>
<script type="text/javascript" src="js/get_itens_comprados_ajax.js"></script>
<script type="text/javascript" src="js/get_compra_ajax.js"></script>
<script type="text/javascript" src="js/get_empresas_ajax.js"></script>
<?php $modal->modal_cadastro_compra(); ?>
<?php $modal->modal_compra_view(); ?>
<?php require_once('footer.php'); ?>

