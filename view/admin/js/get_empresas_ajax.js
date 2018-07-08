$(document).ready(function(){

  $.ajax({
      url: "pesquisas/get_empresas_select.php",
      method: "post",
      data: {select_empresa: true},
      success: function(data) {
          $(".campo_empresa").html(data);
       }
    });

  

});