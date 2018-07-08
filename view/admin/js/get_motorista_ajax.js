$(document).ready(function(){

  $.ajax({
      url: "pesquisas/get_motorista_select.php",
      method: "post",
      data: {select_motorista: true},
      success: function(data) {
          $(".campo_motorista").html(data);
       }
    });

  

});