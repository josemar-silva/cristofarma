<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <?php
        require_once 'Produto.php';
        require_once 'PrudutoVenda.php';
        require_once 'Pessoa.php';
        require_once 'Venda.php';
        require_once 'Estoque.php';

        $produto = new Produto();
        $produtoVenda = new ProdutoVenda();
        $pessoa = new Pessoa();
        $venda = new Venda();
        $estoque = new Estoque();

        if (isset($_POST['fecharVenda'])) {

            $vendaStatus = 'aberto';

            $pessoa_id_pessoa_vendedor = addslashes($_POST['idVendedorSelecionado']); 
            $pessoa_id_pessoa_cliente = addslashes($_POST['idClienteVenda']);
            $data_venda = addslashes($_POST['dataVenda']);
            $tipo_pagamento = addslashes($_POST['tipoPagamento']);
            $status_venda = $vendaStatus; 
            $valor_venda_sem_desconto = addslashes($_POST['totalSemDesconto']);
            $desconto = addslashes($_POST['desconto']);
            $valor_venda_com_desconto  = addslashes($_POST['totalComDesconto']);
            $total_item_venda = '1';

            $venda->createVenda($pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_cliente, $data_venda, $tipo_pagamento, $status_venda,
            $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto,$total_item_venda);
        }

        if (isset($_POST['cancelarVenda'])) {

            $data_venda = addslashes($_POST['dataVenda']);
            $pessoa_id_pessoa_cliente = addslashes($_POST['idClienteVenda']);

            $venda->deleteVenda($data_venda, $pessoa_id_pessoa_cliente);
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
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    <section id="principalVendas">
    <legend>REALIZAR VENDA/ORÇAMENTO</legend>

<div id="itensAdicionados">
<div class="scroll">
    <table>
        <?php

            if (isset($_GET['id_get_up'])) {

                echo '<tr>';
                echo '<table class="table table-hover">';
                    echo '<th> CODIGO </th>';
                    echo '<th> DESCRIÇÃO DO PRODUTO </th>';
                    echo '<th> QTD </th>';
                    echo '<th> LABORATÓRIO </th>';
                    echo '<th> PREÇO </th>';
                    echo '<th> AÇÃO </th>';                           
                echo '</tr>';

        $dados = $produto->selectProduto($_GET['id_get_up']);
        if(count($dados) > 0)  
        {
           for ($i=0; $i < count($dados) ; $i++) 
            { 
                 echo "<tr>"; // abre a linha dos dados selecionados
                    foreach ($dados[$i] as $key => $value) 
                    {
                        if ($key == 'id_produto')  // IMPRIMIR VALOR SOMENTE SE...
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    } foreach ($dados[$i] as $key => $value) 
                    {
                        if ($key == 'nome_produto')  
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    } 
    ?>
        <td>
            <input id="quantidadeItemVenda" style="border: none; text-align: center; " size="2" value="<?php echo'1';?>">
        </td>                     
     <?php                              
                    foreach ($dados[$i] as $key => $value) 
                    {   
                        if ($key == 'produto_fornecedor')  // IMPRIMIR VALOR SOMENTE SE...
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    } foreach ($dados[$i] as $key => $value) 
                    {
                        if ($key == 'preco_custo')  // IMPRIMIR VALOR SOMENTE SE...
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
    ?>
            <td>
                <a id="removeProdutoVenda" href="#"> Excluir </a>
            </td>
                 <?php
                    echo "</tr>"; // fecha linha dos dados selecionados
            } 
        }   
    }
    ?>       
    </table>
    </div>
</div>

    <div id="adicionaPrudutoVenda" style="padding: 10px;" >
                <a href="ConsultaProdutos.php?buscaProdutos=+"><img src="/img/search.png">Adcionar Produto</a>
    </div>

    <form id="upVendas" action="Vendas.php" method="POST">

        <div id="divDataHoraVenda">   
            <label>Data/Hora:</label>
            <input id="dataVenda" name="dataVenda" value="<?php date_default_timezone_set('America/Sao_Paulo');
                echo date('d/m/Y H:i:s'); ?>" 
                    style="color: blue; text-align: center; font-size: 15pt; border: none; display: inline;" 
                    size="15" ></input>
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
    <div id="divDabosVenda" style="width: 30%; float: right;  height: 540px; font-size: 13pt;">
    <legend style="border: solid 1px #8b0210; background-color: #8b0211; color: white;">DADOS DA VENDA</legend>
        
                           <!-- ==================== BUSCAR VENDEDOR =====================-->

        <div id="vendedorSelecionado">      
                <label for="idClienteVenda" >ID Vendedor:</label>
                    <input type="text" id="idVendedorSelecionado" name="idVendedorSelecionado" class="form-control" size="5" style="margin-right: 54%;"
                        value="<?php if (isset($_GET['id_pessoa_vendedor_get_up']))
                            {
                                    $id_pessoa_get_up = addslashes($_GET['id_pessoa_vendedor_get_up']); 
                                        $retornoConsulta = $pessoa->selectPessoaFuncionario($id_pessoa_get_up); 
                                            if(isset($retornoConsulta)){echo $retornoConsulta[0]['id_pessoa'];
                                }
                            }
                            
                                ?>"><br><br>

                <label id="labelVendedorSelecionado" >Nome:</label>
                    <input type="text" id="vendedor" name="vendedor" class="form-control" size="30" style="margin-right: 11%;"
                            value="<?php if (isset($_GET['id_pessoa_vendedor_get_up'])) 
                            {
                                    $id_pessoa_get_up = addslashes($_GET['id_pessoa_vendedor_get_up']); 
                                        $retornoConsulta = $pessoa->selectPessoaFuncionario($id_pessoa_get_up); 
                                            if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];
                                }
                            }
                                ?>"><br><br>
        
                    <div id="adicionaVendedorVenda" style="padding: 10px;">
                        <a href="ConsultaFuncionarios.php?buscaFuncionario=+"><img src="/img/search.png">Adcionar Vendedor</a>
                    </div><br><br>

             <!-- =========================== BUSCAR CLIENTE ===============================-->

             <label for="idClienteVenda" style="">ID Cliente:</label>
                <input id="idClienteVenda" type="text" name="idClienteVenda" class="form-control" size="5" style="margin-right: 54%;"
                    value="<?php if (isset($_GET['id_pessoa_get_up'])) 
                    {
                            $id_pessoa_get_up = addslashes($_GET['id_pessoa_get_up']); 
                                $retornoConsulta = $pessoa->selectPessoaCliente($id_pessoa_get_up); 
                                    if(isset($retornoConsulta)){echo $retornoConsulta[0]['id_pessoa'];
                        }
                    } 
                        ?>"><br><br>
            
                <label id="labelNomeCliente">Nome:</label>
                <input id="nomeCliente" type="search" class="form-control" name="nomeCliente" size="30" style="margin-right: 11%;"
                    value="<?php if (isset($_GET['id_pessoa_get_up'])) 
                    {
                            $id_pessoa_get_up = addslashes($_GET['id_pessoa_get_up']); 
                                $retornoConsulta = $pessoa->selectPessoaCliente($id_pessoa_get_up); 
                                    if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];
                        }
                    } 
                        ?>"><br><br>

                <label id="labelCpf">CPF:</label>
                <input id="cpfCliente" type="text" name="cpfCliente" class="form-control" size="16" style="margin-right: 35%;"
                    value="<?php if (isset($_GET['id_pessoa_get_up'])) 
                    {
                            $id_pessoa_get_up = addslashes($_GET['id_pessoa_get_up']); 
                                $retornoConsulta = $pessoa->selectPessoaCliente($id_pessoa_get_up); 
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
            <input id="totalComDesconto" name="totalComDesconto" class="form-control" size="10"><br><br><br>
            
            <button class="btn btn-outline-danger" id="btnFecharVenda" name="fecharVenda" onclick="" 
                style="display: inline;">Fechar Venda</button>
            <button class="btn btn-outline-danger" id="btnCncelarVenda" name="cancelarVenda" onclick=""
                style="display: inline; ">Cancelar</button>
        </div>
    </div>
</div>
    </form>
    </section>
</body>

</html>