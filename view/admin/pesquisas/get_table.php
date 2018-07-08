<?php

    session_start();

    require_once('../classes/db.class.php');
    $objDb = new db();
    $link = $objDb->conecta_mysql();

    $opcao = isset($_POST['opcao']) ? $_POST['opcao'] : '';
    $registros_por_pagina = $_POST['registros_por_pagina'];
    $click_voltar = isset($_POST['click_voltar']) ? $_POST['click_voltar'] : false;
    $click_avancar = isset($_POST['click_avancar']) ? $_POST['click_avancar'] : false;
    $utilitaria = isset($_POST['utilitaria']) ? $_POST['utilitaria'] : '';
    $total_registros = 0;
    $registro;


//Funções

    function dinheiro_php($valor){
        $valor1 = str_replace(".","",$valor);
        $valor2 = str_replace(",",".", $valor1);
        return($valor2);
    }
    
    function dinheiro_html($valor){
        $valor1 = number_format($valor, 2,',','.');
        return($valor1);    
    }

    function data_brasil($data0){
        $data1 = explode("-",$data0);
        $data2 = $data1[2]."/".$data1[1]."/".$data1[0];
        return($data2);
    }

    function localizar_nome($var_nome, $var_tabela, $var_id, $var_id_sistema){
        global $link;

        $sql = "select $var_nome from $var_tabela where  $var_id = $var_id_sistema";
        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
            $nome = $registro[''.$var_nome.''];
        }
        return $nome;
    }

    function total_registros($sql){
        global $link;
        global $registros_por_pagina;
        global $total_registros;

        //////////////////////////////////////////////////////////////////////
        //======== recupera o total de registros com base no filtro =======//

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            $registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC);
            $total_registros = $registro['total_registros'];

        } else {
            echo 'Erro ao tentar recuperar o total de registros!';
            echo mysqli_error($link);
        }

        return $total_registros;
        //////////////////////////////////////////////////////////////////////
    }

    function th($numero, $th){
        for ($cont=0; $cont < $numero; $cont++){
            echo "<th>".$th[$cont]."</th>";
        }
    }

    function td($numero, $td){
        global $registro;

        for ($cont=0; $cont < $numero; $cont++){
            
            if (isset($registro['status'])) {
                switch ($registro['status']) {
                case '1':
                    $registro['status'] = 'ATIVO';
                    break;
                
                case '0':
                    $registro['status'] = 'INATIVO';
                    break;
                }
            }

            echo "<td>".$registro[''.$td[$cont].'']."</td>";
        }
    }

    function btn_alterar($table){
        global $registro;
        echo '<td><button type="button" class="btn btn-warning btn-xs alterar_'.$table.'" 
        data-alt_'.$table.'="'.$registro['id_'.$table].'"> Alterar </button></td>';
    }

    function btn_deletar($table){
        global $registro;
        echo '<td><button type="button" class="btn btn-danger btn-xs deletar_'.$table.'" 
        data-del_'.$table.'="'.$registro['id_'.$table.''].'"> Deletar </button></td>';
    }

    function btn_info($table, $id){
        global $registro;
        echo '<td><button type="button" class="btn btn-info btn-xs info_'.$table.'" 
        data-info_'.$table.'="'.$registro['id_'.$table.''].'" id="'.$id.'"> Ver Mais </button></td>';
    }

    function paginacao($offset){
        global $total_registros;
        global $registros_por_pagina;

        //como o offset (página) inicia em zero, ajusto para que visualmente seja indicado o início em seu respectivo valor +1
         $offset++;

         $total_paginas = ceil($total_registros / $registros_por_pagina);
        // a função ceil() arredonda o resultado para o inteiro superior mais próximo
           
            if ($total_paginas == 1){
                die();
            }

         echo "<div class='paginacao'>";
         echo "Página ".ceil($offset / $registros_por_pagina)." de $total_paginas. Total de registros: $total_registros";
         echo "<br />";

         //cria os links de paginação
         $pagina_atual = ceil($offset / $registros_por_pagina); //localiza a pagna atual
         $pagina_anterior = $i = $pagina_atual -1;
         $pagina_proxima = $i = $pagina_atual +1;
         $ponto_inicial = $i-1;
       
         $ponto_final = $i+2;

         if ($ponto_final > $total_paginas) {
             $ponto_final = $total_paginas;
         }

        function cria_botoes($ponto_inicial, $ponto_final, $pagina_atual, $pagina_anterior, $pagina_proxima, $total_paginas){



            for($i = $ponto_inicial; $i <= $ponto_final; $i++) {    
               
                if ($i <= $ponto_final) {
                    if ($i == $ponto_inicial) {
                        echo '<div class="btn-group">';
                        echo '<button class="btn btn-info paginar" paginar" id="btn_inicio" data-pagina_clicada="1"> << </button>&nbsp';
                        echo '<button class="btn btn-info paginar" paginar" id="btn_voltar" data-pagina_clicada="'.$pagina_anterior.'"> < </button>&nbsp';
                    }
                    
                    $classe_botao = $pagina_atual == $i ? 'btn-primary btn-atual' : 'btn-default'; 

                    echo '<button style="width: 50px;" class="btn '.$classe_botao.' paginar" id="btn_'.$i.'" data-pagina_clicada="'.$i.'">'.$i.'</button>';
                }
               

                $passar_adiante = $pagina_atual > $ponto_final ? 'btn-vai' : 'btn-fica';

                 if ($i == $ponto_final) {
                        $block_final = $pagina_atual == $total_paginas ? 'btn-final' : 'btn-normal';
                        $final_da_lista = $total_paginas;
                        
                        echo '&nbsp<button class="btn btn-info '.$passar_adiante.' paginar" id="'.$block_final.'" data-pagina_clicada="'.$pagina_proxima.'"> > </button>';
                        echo '&nbsp<button class="btn btn-info paginar" paginar" id="btn_fim" data-pagina_clicada="'.$final_da_lista.'"> >> </button>';
                        echo'</div>';
                        echo'</div>';
                    }

                
            }
        }

        cria_botoes($ponto_inicial, $ponto_final, $pagina_atual, $pagina_anterior, $pagina_proxima, $total_paginas);
    }

//Tabelas
    function tabela_pessoa_fisica(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM pessoa where razao_social = ""');
        $offset = $_POST['offset'];
        $sql = "select * FROM pessoa where razao_social = ''";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive table-condensed" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(6, array('NOME','RG','TELEFONE','EMAIL','STATUS','DETALHES'));
                    echo '</tr>';
                echo '</thead>';

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    echo '<tbody>';
                        echo '<tr>';
                            td(5, array('nome_pessoa','rg','fone', 'email','status'));
                            btn_info('pessoa', 'pf_info');
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_pessoa_juridica(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM pessoa where nome_pessoa = ""');
        $offset = $_POST['offset'];
        $sql = " select * FROM pessoa where nome_pessoa = ''";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
            if($resultado_id){
                echo '<table class="table table-bordered table-hover table-responsive  table-condensed" >';
                    echo '<thead class="table-inverse">';
                        echo '<tr>';
                            th(6, array('RAZAO SOCIAL','CNPJ','TELEFONE','EMAIL','STATUS','DETALHES'));
                        echo '</tr>';
                    echo '</thead>';

                    while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                        echo '<tbody>';
                            echo '<tr>';
                                td(5, array('razao_social','cpf_cnpj','fone', 'email', 'status'));
                                btn_info('pessoa', 'pj_info');
                            echo '</tr>';
                        echo '</tbody>';
                    }
                 echo '</table>';

                 paginacao($offset);  
            } else {
                echo 'Erro na consulta dos registros!';
            }
    }

    function tabela_estado(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM estado');
        $offset = $_POST['offset'];
        $sql = " select * FROM estado";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive table-condensed " >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(5, array('ESTADO','SIGLA','STATUS','ALTERAR','DELETAR'));
                    echo '</tr>';
                echo '</thead>';

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    echo '<tbody>';
                        echo '<tr>';
                            td(3, array('nome','sigla','status'));
                            btn_alterar('estado');
                            btn_deletar('estado'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_cidade(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM cidade');
        $offset = $_POST['offset'];

        $sql = "select estado.sigla, cidade.id_cidade, cidade.nome, cidade.status FROM cidade ";
        $sql.=" inner join estado on cidade.estado_id_estado = estado.id_estado ";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";
       
        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive table-condensed" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(5, array('CIDADE','UF','STATUS','ALTERAR','DELETAR'));
                    echo '</tr>';
                echo '</thead>';
                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    echo '<tbody>';
                        echo '<tr>';
                            td(3, array('nome', 'sigla','status'));
                            btn_alterar('cidade');
                            btn_deletar('cidade'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_plano_contas(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM plano_contas');
        $offset = $_POST['offset'];
        $sql = " select * FROM plano_contas";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(4, array('DESCRIÇÃO','TIPO', 'ALTERAR','DELETAR'));
                    echo '</tr>';
                echo '</thead>';

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    echo '<tbody>';
                        echo '<tr>';
                            td(2, array('descricao', 'tipo'));
                            btn_alterar('plano_contas');
                            btn_deletar('plano_contas'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_item(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM item');
        $offset = $_POST['offset'];
        $sql = " select * FROM item";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(5, array('NOME','TIPO', 'STATUS', 'VISUALIZAR','DELETAR'));
                    echo '</tr>';
                echo '</thead>';

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    echo '<tbody>';
                        echo '<tr>';
                            td(3, array('descricao', 'tipo', 'status'));
                            btn_info('item', 'btn_info_produto');
                            btn_deletar('item'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_onibus(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM onibus');
        $offset = $_POST['offset'];
        $sql = " select * FROM onibus";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(8, array('MODELO','ANO', 'ASSENTOS', 'PLACA', 'MOTORISTA', 'EMPRESA', 'ALTERAR','DELETAR'));
                    echo '</tr>';
                echo '</thead>';

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    echo '<tbody>';
                        echo '<tr>';
                            $nome_motorista = localizar_nome('nome_pessoa', 'pessoa', 'id_pessoa', $registro['motorista']);
                            $nome_fornecedor = localizar_nome('razao_social', 'pessoa', 'id_pessoa', $registro['empresa']);
                            td(4, array('modelo', 'ano', 'assentos', 'placa'));
                            echo "<td>".$nome_motorista."</td>";
                          echo "<td>".$nome_fornecedor."</td>";   
                            btn_alterar('onibus');
                            btn_deletar('onibus'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_compra(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM compra');
        $offset = $_POST['offset'];
        $sql = " select * FROM compra";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(5, array('DATA DA COMPRA','VALOR TOTAL', 'STATUS', 'FORNECEDOR','DETALHES'));
                    echo '</tr>';
                echo '</thead>';

                

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    if(isset($registro['data'])){
                        $registro['data'] = data_brasil($registro['data']);
                    }
            
                    echo '<tbody>';
                        echo '<tr>';
                            $nome_fornecedor = localizar_nome('razao_social', 'pessoa', 'id_pessoa', $registro['pessoa_id_pessoa']);
                            td(3, array('data', 'valor_total', 'status'));
                            echo "<td>".$nome_fornecedor."</td>";
                            btn_info('compra', 'compra');
                            // btn_deletar('compra'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_itens_comprados(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        global $utilitaria;
        total_registros('select count(*) as total_registros FROM item_compra where compra_id_compra = '.$utilitaria.' ');
        $offset = $_POST['offset'];
        $sql = " select * FROM item_compra where compra_id_compra = ".$utilitaria." ";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(4, array('QUANTIDADE', 'DESCRIÇÃO', 'VALOR UNITÁRIO', 'VALOR TOTAL'));
                    echo '</tr>';
                echo '</thead>';

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                   $registro['valor_unitario'] = dinheiro_html($registro['valor_unitario']);
                   $registro['valor_total'] = dinheiro_html($registro['valor_total']);

                   $_SESSION['compra_'.$utilitaria][$registro['id_item_compra']]['quantidade'] = $registro['quantidade'];
                   $_SESSION['compra_'.$utilitaria][$registro['id_item_compra']]['valor_unitario'] = $registro['valor_unitario'];
                   $_SESSION['compra_'.$utilitaria][$registro['id_item_compra']]['valor_total'] = $registro['valor_total'];
                   $_SESSION['compra_'.$utilitaria][$registro['id_item_compra']]['id_item_compra'] = $registro['id_item_compra'];


                    echo '<tbody>';
                        echo '<tr>';
                            echo '<td><div class="" id=""><div class="form-group"><input type="number" class="form-control formatter valid" id="quantidade_item_'.$registro['id_item_compra'].'" placeholder="Insira..." name="quantidade" min="1" aria-required="true" aria-invalid="false" value="'.$registro['quantidade'].'" ><div class="help-block with-errors"></div></div></div></td>';

                            echo '<td><div class="" id=""><div class="form-group"><select class="form-control campo_itens_altera valid" id="campo_itens_'.$registro['id_item_compra'].'" name="itens" aria-required="true" aria-invalid="false"><option disabled="" selected="">Selecione</option><option value="'.$registro["item_id_item"].'" >Aluguel Transporte</option><option value="9">Produto Limpeza</option></select><div class="help-block with-errors"></div></div></div></td>';

                            echo '<td><div class="" id=""><div class="form-group"><input type="text" class="form-control formatter valid" id="valor_unitario_'.$registro['id_item_compra'].'" placeholder="Insira..." name="valor_unitario" aria-required="true" aria-invalid="false" value="'.$registro['valor_unitario'].'" ><div class="help-block with-errors" data-thousands="." data-decimal="," ></div></div></div></td>';

                            echo '<td><div class="" id=""><div class="form-group"><input type="text" class="form-control formatter valid" id="valor_total_'.$registro['id_item_compra'].'" placeholder="Insira..." name="valor_total" aria-required="true" aria-invalid="false" value="'.$registro['valor_total'].'"><div class="help-block with-errors"></div></div></div></td>';
                        echo '</tr>';
                    echo '</tbody>';

                    echo '<script> 

                        $("#valor_unitario_'.$registro['id_item_compra'].'").maskMoney({
                             thousands: ".",
                             decimal: ","
                        });

                        $("#valor_total_'.$registro['id_item_compra'].'").maskMoney({
                             thousands: ".",
                             decimal: ","
                        });

                        $("#campo_itens_'.$registro['id_item_compra'].' option[value='.$registro["item_id_item"].'] ").prop("selected", "selected");

                        $("#campo_itens_'.$registro['id_item_compra'].'").prop("disabled", true);
                        $("#quantidade_item_'.$registro['id_item_compra'].'").prop("disabled", true);
                        $("#valor_unitario_'.$registro['id_item_compra'].'").prop("disabled", true);
                        $("#valor_total_'.$registro['id_item_compra'].'").prop("disabled", true);


                        function atualiza_valor(id){
                            $.ajax({
                                url: "registros/altera_compra.php",
                                method: "post",
                                data: {id_item: id, quantidade:$("#quantidade_item_"+id+"").val(), valor_unitario: $("#valor_unitario_"+id+"").val(), id_compra: '.$registro['compra_id_compra'].',  decisao: 2},
                                success: function(data) {  
                                    var resultado = JSON.parse(data);
                                    $("#valor_total_"+id+"").val(resultado[1]);
                                    $("#valor_total_comprada").val(resultado[2]);

                                }
                             });
                        }

                        $("#quantidade_item_'.$registro['id_item_compra'].'").on("change", function(){
                            atualiza_valor('.$registro['id_item_compra'].');
                        });

                        $("#valor_unitario_'.$registro['id_item_compra'].'").on("change", function(){
                            atualiza_valor('.$registro['id_item_compra'].');
                        });


                        </script>';

                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

    function tabela_contas_a_pagar(){
        global $registros_por_pagina;
        global $link;
        global $registro;
        total_registros('select count(*) as total_registros FROM compra');
        $offset = $_POST['offset'];
        $sql = " select * FROM contas_a_pagar";
        $sql.=" LIMIT $registros_por_pagina OFFSET $offset ";

        $resultado_id = mysqli_query($link, $sql);
        if($resultado_id){
            echo '<table class="table table-bordered table-hover table-responsive" >';
                echo '<thead class="table-inverse">';
                    echo '<tr>';
                        th(5, array('DATA','VALOR TOTAL', 'STATUS', 'FORNECEDOR', 'DETALHES'));
                    echo '</tr>';
                echo '</thead>';

                

                while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC)){
                    if(isset($registro['data'])){
                        $registro['data'] = data_brasil($registro['data']);
                    }
            
                    echo '<tbody>';
                        echo '<tr>';
                            $nome_fornecedor = localizar_nome('razao_social', 'pessoa', 'id_pessoa', $registro['pessoa_id_pessoa']);
                            td(3, array('data', 'valor_total', 'status'));
                            echo "<td>".$nome_fornecedor."</td>";
                            btn_info('contas_a_pagar', 'contas_a_pagar');
                            // btn_deletar('compra'); 
                        echo '</tr>';
                    echo '</tbody>';
                }
             echo '</table>';

             paginacao($offset);  
        } else {
            echo 'Erro na consulta dos registros!';
        }
    }

//Seleção   
switch ($opcao) {
    case 'pessoa_fisica':
        tabela_pessoa_fisica();
        break;
    case 'pessoa_juridica':
        tabela_pessoa_juridica();
        break;
    case 'estado':
        tabela_estado();
        break;
    case 'cidade':
        tabela_cidade();
        break;
    case 'plano_contas':
        tabela_plano_contas();
        break; 
    case 'itens':
        tabela_item();
        break;    
    case 'onibus':
        tabela_onibus();
        break; 
    case 'compra':
        tabela_compra();
        break;  
    case 'item_compra':
        tabela_itens_comprados();
        break;    
    case 'contas_a_pagar':
        tabela_contas_a_pagar();
        break;      
 } 
      
?>