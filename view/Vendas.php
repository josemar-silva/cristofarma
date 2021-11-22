<!doctype html>
<html lang="pt">
<script language=javascript type="text/javascript"></script>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">

<?php
        session_start(); // trabalhar com informaçoes persistentes, sem perder os dados ao trocar de pagina ou arquivo //
        
        require_once '../model/Produto.php';
        require_once '../model/ItemVenda.php';
        require_once '../model/Pessoa.php';
        require_once '../model/Venda.php';
        require_once '../model/Estoque.php';
        require_once '../model/Conexao.php';

        $produto = new Produto();
        $itemVenda = new ItemVenda();
        $pessoa = new Pessoa();
        $venda = new Venda();
        $estoque = new Estoque();
    ?>
    
    <title>Vendas</title>
</head>

<body>
    <header>
    <nav class="dp-menu">
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="#">PESQUISAR</a>
                <ul>
                    <li><a href="ConsultaClientes.php">Clientes</a></li>
                    <li><a href="ConsultaFornecedor.php">Fornecedores</a></li>
                    <li><a href="ConsultaFuncionarios.php">Funcionários</a></li>
                    <li><a href="ConsultaProdutos.php">Produtos</a></li>                    
                </ul>
            </li>
            <li><a href="Vendas.php">VENDAS</a></li>
            <li><a href="Caixa.php">CAIXA</a></li>
            <li><a href="#">PRODUTOS</a>
                 <ul>
                    <li><a href="CadastrarProdutos.php">Cadastro de Produtos</a></li>
                    <li><a href="AlimentarEstoque.php">Estoque de Produtos</a></li>                                        
                </ul>
            </li>
            <li><a href="Cadastros.php">CADASTROS</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    </header>
    <div id="divSair"    >
        <a href="../index.php">Sair</a>
    </div>
<form method="POST">
    <div id="itensAdicionados">

    <section id="principalVendas">
    
<div class="scroll">

    <table>
    <legend style="background-color: #191970; color: white;">VENDA / ORÇAMENTO</legend>

    
        <tr>
            <table class="table table-hover">
                <th> CODIGO PRODUTO </th>
                <th> DESCRIÇÃO DO PRODUTO </th>
                <th> LABORATÓRIO </th>
                <th> PREÇO UNID</th>
                <th> QTD </th>
                <th id="get_rows_value"> R$ TOTAL </th>
                <th> AÇÃO </th>                       
        </tr>
    <?php 
    
    
    echo '<div id="divCodigoVenda" style="margin-left: 1%; width:98%; margin-top: -3.5%;" >';
    echo '<label style="font-weight: bolder; font-size: 15px; margin-left: 1%;color: rgb(231, 225, 225);">Código da Venda:</label>';
    
        date_default_timezone_set('America/Sao_Paulo');
        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');
        $countVendasDia = count($venda->selectAllVenda());
        $codigo_gerado_venda = $ano.$mes.$dia.$countVendasDia;
        $outputCodigoVenda = $codigo_gerado_venda; /* GERANDO CODIGO DA VENDA */

        echo '<input id="codigoVenda" name="codigoVenda" value="'. $outputCodigoVenda .'"style="background-color: #191970; color: yellow; font-weight: bolder; text-align: 
        center; font-size: 13pt; border: none; display: inline-block;" size="10" disabled></input>';

    echo '</div>';

    
                        // ADIDIONANDO ITENS AO CARRINHO DE COMPRAS //

if (isset($_GET['id_produto_up_venda']) && !empty(['id_produto_up_venda']))
{ 
    $fk_id_produto = (int) $_GET['id_produto_up_venda'];

        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>';  

        if (!isset($_SESSION['venda'][$fk_id_produto])) 
        {   
            $_SESSION['venda'][$fk_id_produto] = 1;

        } else {

            $_SESSION['venda'][$fk_id_produto] += 1; // se a $_SESSION já existe é somado 1 ao seu valor que representa sua quantidade

            // $itemVenda->updateItemVenda($cdv, $fk_id_produto, $update_quantidade, $update_valor_total_item);
    }
}
                                            // CALCALAR VALORES DA VANDA

    if (isset($_POST['desconto']) && isset($_POST['totalSemDesconto'])) 
    { 
        $desc_porcentagem = filter_input(INPUT_POST, 'desconto');


        $venda_sem_desconto = (float) addslashes($_POST['totalSemDesconto']);

        $venda_com_desconto =  (float) addslashes($_POST['totalComDesconto']);

        $porcentagem = (float) $desc_porcentagem;

        $desconto_calculado = $venda->calculaDescontoPorcentagem($venda_sem_desconto, $porcentagem);

        $return_calculo_venda = $venda->calculaValorVenda($venda_sem_desconto, $desconto_calculado);

       
    } 

                                            // CRIAR VENDA E ITEM_VENDA

if (isset($_POST['fecharVenda']) && !empty($_POST['idClienteVenda']) && !empty($_POST['vendedor']) && !empty($_POST['tipoPagamento'])) 
{ 
            $vendaStatus = 'aberto';

            $codigo_venda = $codigo_gerado_venda;
            $pessoa_id_pessoa_vendedor =  addslashes($_POST['vendedor']); 
            $pessoa_id_pessoa_cliente =  addslashes($_POST['idClienteVenda']);
            $data_venda = addslashes($_POST['dataVenda']);
            $tipo_pagamento = addslashes($_POST['tipoPagamento']);
            $status_venda = $vendaStatus;
          
            $valor_venda_sem_desconto = (float) $venda_sem_desconto;
            $desconto = (float) $desconto_calculado;
            $valor_venda_com_desconto = (float) $return_calculo_venda;

            $total_item_venda = array_sum($_SESSION['venda']);

            $venda->createVenda($codigo_venda, $pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_cliente, $data_venda, $tipo_pagamento, $status_venda,
            $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $total_item_venda);

            foreach ($_SESSION['venda'] as $product => $value)
            {
                $prod = $produto->selectProduto($product);
                $quantidade_produto = $_SESSION['venda'][$product];
                $valor_produto = $quantidade_produto*$prod['preco_venda'];

                $itemVenda->createItemVenda((int)$outputCodigoVenda, (int)$product, (int)$quantidade_produto, (float)$valor_produto);
            }

            echo '<script> alert("Venda finalizada Com sucesso!")</script>';
                // session_destroy(); // encerrar a seção e destroi as variaves existentes nela
                    // echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>'; // REFRESH para atualizar a página
}


            
        // EXCLUINDO OS ITENS DO CARRINHO DE COMPRAS //

 if (isset($_GET['removeProdutoVenda']))
 {  
        $fk_id_produto = $_GET['removeProdutoVenda'];
            unset($_SESSION['venda'][$fk_id_produto]);
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>'; // REFRESH para atualizar a página
 }
        // EXIBINDO DADOS DOS ITENS NO CARRINHO DE COMPRAS //

$soma_total_venda = array(); // ARRAY PARA SOMAR TODOS OS VALORES TOTAIS DOS ITENS ADICIONAIS

if (isset($_SESSION['venda'])) {

    if (count($_SESSION['venda']) == 0) {

    } else {        
        foreach ($_SESSION['venda'] as $protutos => $quantidade)
        {
        $idItem = (int) $protutos;
            $dados = $produto->selectProduto($idItem);
                echo '<tr>
                        <td>'.$dados['id_produto'].'</td>'
                            .'<td>'.$dados['nome_produto'].'</td>'
                                .'<td>'; $consultaLike = $dados['pessoa_id_pessoa'];
                                          $return = $pessoa->selectPessoaFornecedor($consultaLike); 
                                          echo $return[0]['nome'] .'</td>'
                                    .'<td>'.$valor = $dados["preco_venda"].'</td>'
                                        .'<td>'.$quantidade.'</td>'
                                            .'<td id"get_rows_value">'.$soma = (int) $quantidade * number_format($dados["preco_venda"], 2, '.','.').'</td>';
                                                
                                                array_push($soma_total_venda, $soma); // ADICIONANDO OS VALORS AO ARRAY
?> 
    <td><a id="removeProdutoVenda" href="Vendas.php?removeProdutoVenda=<?php echo $dados['id_produto'];?>"> X </a></td> 
<?php
            echo '</tr>';
            
        }
    }
}
                                        // LIMPAR DAOS VARIAVIIS E CARRINHO AO FECHAR OU CANCELAR VENDA 

    if (isset($_POST['cancelarVenda']) && isset($_SESSION['venda'])) 
    {
        session_destroy();
        echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>';
    }
?>                      
       </table>
    </div>
</div>
    <div id="adicionaPrudutoVenda" >
                <a id="adicionar-produto" href="ConsultaProdutos.php?buscaProdutos=+" title="Buscar Produto"><img src="/img/search2.png"></a>
    </div><br>
        <div id="divDataHoraVenda">   
            <label style="color:red">Data:</label>
            <input id="dataVenda" name="dataVenda" value="<?php date_default_timezone_set('America/Sao_Paulo');
                echo date('d/m/Y'); ?>" 
                    style="color: blue; text-align: center; font-size: 20pt; border: none; display: inline; background-color: #feeaff;font-weight: bolder;; color: #161934;" 
                    size="8" ></input><br><br>
        </div>
            
    <div id="divDabosVenda" style="width: 32%; float: right; margin-right: 0.5%; height: 540px; font-size: 13pt; padding: 15px;color:red">
    <legend style="border: solid 1px #8b0210; background-color: #8b0211; color: white;">DADOS DA VENDA</legend>
        
                    <!-- ==================== BUSCAR VENDEDOR =====================-->

        <div id="vendedorSelecionado">

        <div id="divPagamentoTipo" style="display: inline; width: 20%;">           
            <label id="labelTipoPagamento"> Tipo de Pagamento:</label>    
                <select id="tipoPagamento" name="tipoPagamento" required class="form-control" style="display: inline; margin-left: 8%; width: 25%; text-align: center;"> 
                    <option value="a vista" >À Vista</option>
                    <option value="debito">Débito</option>
                    <option value="credito">Crédito</option>
                </select>
            </div><br><br>

                           <!-- =========================== BUSCAR CLIENTE ===============================-->

        <label for="idClienteVenda" st>ID Cliente:</label>
            <input id="idClienteVenda" type="text" name="idClienteVenda" class="form-control" size="5" style="margin-right: 54%;"
                value="<?php if (isset($_GET['id_cliente_up_venda']) && !empty(['id_cliente_up_venda'])) 
                {
                        $id_cliente_get_up = addslashes($_GET['id_cliente_up_venda']); 
                            $retornoConsulta = $pessoa->selectPessoaCliente($id_cliente_get_up); 
                                if(isset($retornoConsulta)){echo $retornoConsulta[0]['id_pessoa'];
                    }
                } 
                    ?>"><br><br>
          
            <label id="labelNomeCliente">Nome:</label>
            <input id="nomeCliente" type="search" class="form-control" name="nomeCliente" autofocus size="30" required style="margin-right: 11%;"
                value="<?php if (isset($_GET['id_cliente_up_venda']) && 'id_cliente_up_venda' !== NULL) 
                {
                        $id_cliente_get_up = addslashes($_GET['id_cliente_up_venda']); 
                            $retornoConsulta = $pessoa->selectPessoaCliente($id_cliente_get_up);
                                if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];
                    }
                } 
                    ?>"><br><br>

            <label id="labelCpf">CPF:</label>
            <input id="cpfCliente" type="text" name="cpfCliente" class="form-control" size="16" style="margin-right: 35%;"
                value="<?php if (isset($_GET['id_cliente_up_venda']) && !empty(['id_cliente_up_venda'])) 
                {
                        $id_cliente_get_up = addslashes($_GET['id_cliente_up_venda']); 
                            $retornoConsulta = $pessoa->selectPessoaCliente($id_cliente_get_up); 
                                if(isset($retornoConsulta)){echo $retornoConsulta[0]['cpf_cnpj'];
                    }
                }
                    ?>"><br><br><br>

        <div id="adicionaClienteVenda">
            <a href="ConsultaClientes.php?buscaCliente=<?php echo $clienteSelect = filter_input(INPUT_POST, 'nomeCliente'); ?>" title="Buscar Cliente"><img src="/img/search2.png"></a>
        </div>

                <label id="labelVendedorSelecionado">Vendedor:</label>
                                <select id="vendedor" name="vendedor" class="form-control" required style="display: inline; margin-left: 5%;">
                                    <option value=""  > Não Informado </option>
                                        <?php $dados = $pessoa->selectAllPessoaFuncionarioVendedor();
                                            if(count($dados) > 0)
                                            {
                                                for ($i=0; $i < count($dados) ; $i++) 
                                                { 
                                                    foreach ($dados[$i] as $key => $value) 
                                                    {
                                                        if ($key == "id_pessoa" ) // IMPRIMIR VALOR SOMENTE SE...
                                                        {
                                                            ?> 
                                                                <option value="<?php echo  $value; ?>" required> 
                                                                    <?php 
                                                        }
                                                    }
                                                    foreach ($dados[$i] as $key => $value) 
                                                    {
                                                        if ($key == "nome" ) // IMPRIMIR VALOR SOMENTE SE...
                                                        {
                                                            ?> 
                                                                    <?php echo  $value; ?> </option> <?php
                                                        }
                                                    }
                                                }
                                            } 
                                        ?> 
                            </select><br/><br/><br>
            <?php
                 $valor_total_venda = array_sum($soma_total_venda);      
            ?>

            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto" class="form-control" size="6" placeholder="0.00" 
                value="<?php if (isset($_SESSION['venda'])) {  echo number_format($valor_total_venda, 2, '.','.');  }  ?>"
                    style="text-align: right; color: blue; font-size: 25px; padding: 5%; background-color: #FFFF00; font-weight: bolder;"> <br><br>

            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" class="form-control" size="6" placeholder="%" 
                value="<?php  if (isset($desc_porcentagem)) { echo $desc_porcentagem.'%'; }  ?>" 
                    style="text-align: right; color: blue; font-size: 25px; padding: 5%; background-color: #FFFF00; font-weight: bolder;"><br><br>
            
            <label for="totalComDesconto" id="totalComDesconto" >Total com Desconto: R$</label>
            <input id="totalComDesconto" name="totalComDesconto" class="form-control"  size="6" placeholder="0.00"  
                value=" <?php if (isset($desc_porcentagem)) { echo number_format($return_calculo_venda, 2, '.','.'); } else { echo number_format($valor_total_venda, 2, '.','.');}?>" 
                    style="text-align: right; color: blue; font-size: 25px; padding: 5%; background-color: #FFFF00; font-weight: bolder;"><br><br><br> 

                    <!--======================== FUNCAO JAVASCRIPT COMFIRMAÇÃO ALERT ==============================-->

            <script language=javascript>
                            
                function confirmaCancelaVenda(){
                    if (confirm("Venda não finalizada, Deseja cancelar essa venda??"))
                        alert("Venda cancelada com sucesso!.");
                    }
            </script>

            <button class="btn btn-outline-danger" id="btnFecharVenda" name="fecharVenda" onclick="" style="display: inline;">Fechar Venda</button>
            <button class="btn btn-outline-danger" id="btnCncelarVenda" name="cancelarVenda" onclick=" return confirmaCancelaVenda();" style="display: inline; margin-left: 10%;">Cancelar</button>
        </div>
    </div>
</div>
    </form>
    </section>
</body>

</html>