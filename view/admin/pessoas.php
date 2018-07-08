<?php 
  require_once('header.php');
  require_once("classes/modals.class.php"); 
  $modal = new Modals;

?>

<div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h4>PESSOAS</h4>
      <button type="button" class="btn btn-info btn_nova_pessoa"> Novo Cadastro </button>
      <form class="form-search form-inline" style="float: right;">
        <input type="text" class="input-medium search-query form-control">
        <span><button type="submit" class="btn btn-info">Pesquisar</button></span>
      </form>
    </div>

    <div class="panel-body">

     <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#pf" aria-controls="pf" role="tab" data-toggle="tab">Pessoa Física</a></li>
        <li role="presentation"><a href="#pj" aria-controls="pj" role="tab" data-toggle="tab">Pessoa Jurídica</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="pf">
          <div class="table-responsive" id="tabela_pessoa_fisica">
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="pj">
          <div class="table-responsive" id="tabela_pessoa_juridica">
          </div>


    <form id="formPesquisa">
      <input type="hidden" name="registros_por_pagina" id="registros_por_pagina" value="8" />
      <input type="hidden" name="offset" id="offset" value="0" />
    </form>  
    
    </div> 
  </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="js/get_pessoas_ajax.js"></script>
<?php 
  $modal->modal_cadastro_pessoa();
  $modal->modal_cadastro_concluido();
  $modal->modal_excluir_pessoa();
  $modal->modal_detalhes();

  require_once('footer.php');
?>
