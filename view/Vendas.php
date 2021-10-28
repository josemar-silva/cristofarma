<!doctype html>
<html lang="pt">
<script language=javascript type="text/javascript"></script>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <?php
        require_once '../model/Produto.php';
        require_once '../model/PrudutoVenda.php';
        require_once '../model/Pessoa.php';
        require_once '../model/Venda.php';
        require_once '../model/Estoque.php';

        $produto = new Produto();
        $produtoVenda = new ProdutoVenda();
        $pessoa = new Pessoa();
        $venda = new Venda();
        $estoque = new Estoque();

        if (isset($_POST['fecharVenda'])) {

            if (!empty($_POST['idClienteVenda']) && !empty($_POST['vendedor'])) {

            $vendaStatus = 'aberto';


            $pessoa_id_pessoa_vendedor = addslashes($_POST['vendedor']); 
            $pessoa_id_pessoa_cliente = addslashes($_POST['idClienteVenda']);
            $data_venda = addslashes($_POST['dataVenda']);
            $tipo_pagamento = addslashes($_POST['tipoPagamento']);
            $status_venda = $vendaStatus;
            $valor_venda_sem_desconto = addslashes($_POST['totalSemDesconto']);
            $desconto = addslashes($_POST['desconto']);
            $valor_venda_com_desconto  = addslashes($_POST['totalComDesconto']);
            $total_item_venda = '1';

            if ($venda->createVenda($pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_cliente, $data_venda, $tipo_pagamento, $status_venda,
            $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $total_item_venda)) {

                    $idVenda = $venda->selectVendaId($data_venda,  $pessoa_id_pessoa_cliente);
                    $idProduto = '9';
                    $produtoVenda->createProdutoVenda($idVenda, $idProduto);

                    echo '<script> alert("Venda finalizada Com sucesso!")</script>';
                } else {

                    echo '<script> alert("Não foi possível concluir essa venda!")</script>';

                }

            } else {
                echo '<script> alert(" Preencha todos os campos!")</script>';
            }

    } else {

        if (isset($_POST['cancelarVenda'])) {

            header('location: Vendas.php');
            echo '<script> alert(" Venda não finalizada, Deseja cancelar essa venda?")</script>';
        } 
    }
    
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
            <li><a href="CupomFiscal.php">CUPOM FISCAL</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    </header>
    <div id="divSair"    >
        <a href="index.php">Sair</a>
    </div>

    <section id="principalVendas">
    <legend style="margin-left: -10%">REALIZAR VENDA/ORÇAMENTO</legend>

<div id="itensAdicionados">
<div class="scroll">
    <form action="" method="POST">
    <table>
        <?php

            if (isset($_GET['id_produto_up_venda']) && !empty(['id_produto_up_venda'])) {

                echo '<tr>';
                echo '<table class="table table-hover">';
                    echo '<th> ID PRODUTO </th>';
                    echo '<th> DESCRIÇÃO DO PRODUTO </th>';
                    echo '<th> LABORATÓRIO </th>';
                    echo '<th> PREÇO UNID</th>';
                    echo '<th> QNTD </th>'; 
                    echo '<th> AÇÃO </th>';                          
                echo '</tr>';

        $dadosPoduto = $produto->selectProduto($_GET['id_produto_up_venda']);
        if(count($dadosPoduto) > 0)  
        {
           for ($i=0; $i < count($dadosPoduto) ; $i++) 
            { 
                 echo "<tr>"; // abre a linha dos dados selecionados
                    foreach ($dadosPoduto[$i] as $key => $value) 
                    {
                        if ($key == 'id_produto')  // IMPRIMIR VALOR SOMENTE SE...
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    } foreach ($dadosPoduto[$i] as $key => $value) 
                    {
                        if ($key == 'nome_produto')  
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }                              
                    foreach ($dadosPoduto[$i] as $key => $value) 
                    {   
                        if ($key == 'produto_fornecedor')  // IMPRIMIR VALOR SOMENTE SE...
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    } foreach ($dadosPoduto[$i] as $key => $value) 
                    {
                        if ($key == 'preco_venda')  // IMPRIMIR VALOR SOMENTE SE...
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
    ?>
        
        <td>
            <input id="quantidadeItemVenda" type="number" name="quantidadeItemVenda" id="cQtd" min="0" max="100" value="1" autofocus required style="font-size: 10pt; text-align: center;"></label>
        </td>                     
     
            <td>
                <a id="removeProdutoVenda" href="#"> X </a>
            </td>
                 <?php
                    echo "</tr>"; // fecha linha dos dados selecionados
            } 
        }   
    } else {
        echo '<tr>';
        echo '<table class="table table-hover">';
            echo '<th> ID PRODUTO </th>';
            echo '<th> DESCRIÇÃO DO PRODUTO </th>';
            echo '<th> LABORATÓRIO </th>';
            echo '<th> PREÇO UNID</th>';
            echo '<th> QTD </th>';
            echo '<th> AÇÃO </th>';                           
        echo '</tr>';
    }
    ?>       
    </table>
    </form>
    </div>
</div>

    <div id="adicionaPrudutoVenda" style="padding: 10px;" >
                <a href="ConsultaProdutos.php?buscaProdutos=+"><img src="/img/search.png">Adcionar Produto</a>
    </div>

    <form id="upVendas" action="" method="POST">

        <div id="divDataHoraVenda">   
            <label>Data/Hora:</label>
            <input id="dataVenda" name="dataVenda" value="<?php date_default_timezone_set('America/Sao_Paulo');
                echo date('d/m/Y H:i:s'); ?>" 
                    style="color: blue; text-align: center; font-size: 15pt; border: none; display: inline;" 
                    size="15" disabled></input>
        </div>
            <div id="divPagamentoTipo">            
                <label id="labelTipoPagamento"> Tipo de Pagamento:</label>    
                <select id="tipoPagamento" name="tipoPagamento" class="form-control"> 
                    <option value="" selected> </option>
                    <option value="a vista" >À Vista</option>
                    <option value="debito">Débito</option>
                    <option value="credito">Crédito</option>
                </select>
            </div><br>
    <div id="divDabosVenda" style="width: 30%; float: right; margin-right: 0.5%; height: 540px; font-size: 13pt;">
    <legend style="border: solid 1px #8b0210; background-color: #8b0211; color: white;">DADOS DA VENDA</legend>
        
                                <!-- ==================== BUSCAR VENDEDOR =====================-->

        <div id="vendedorSelecionado">      
                <label id="labelVendedorSelecionado">Vendedor:</label>
                                <select id="vendedor" name="vendedor" class="form-control" style="display: inline; margin-left: 8%;">
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
                            </select><br/><br/><br/><br/>

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
                <input id="nomeCliente" type="search" class="form-control" name="nomeCliente" autofocus size="30" style="margin-right: 11%;"
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
                        ?>"><br><br>

                    <div id="adicionaClienteVenda">
                            <a href="ConsultaClientes.php?buscaCliente=+"><img src="/img/search.png">Buscar Cliente</a>
                    </div><br><br>  
                
            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto" class="form-control" size="10"> <br><br> 
            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" class="form-control" size="10" placeholder="%"><br><br>
            <label for="totalComDesconto" id="totalComDesconto">Total com Desconto: R$</label>

            <input id="totalComDesconto" name="totalComDesconto" class="form-control"  size="10" 
                value="<?php $n1 = filter_input(INPUT_POST, 'totalSemDesconto' );  $n2 = filter_input(INPUT_POST, 'desconto' );
                    $n3 = $n1-$n2; echo number_format($n3, 2, ',', '.');?>"> <!--  echo number_format($n3, 2, ',', '.'); = convertendo para moeda local --> 
                        <br><br><br> 

            <button class="btn btn-outline-danger" id="btnFecharVenda" name="fecharVenda" onclick="" style="display: inline;">Fechar Venda</button>
            <button class="btn btn-outline-danger" id="btnCncelarVenda" name="cancelarVenda" onclick="" style="display: inline; margin-left: 10%;">Cancelar</button>
        </div>
    </div>
</div>
    </form>
    </section>
</body>

</html>