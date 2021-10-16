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
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
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
            <div id="dateTimeVenda" style="display: block; margin-left: 35%;">
                <label>Data/Hora:</label>
                <input id="dataVenda" name="dataVenda" value="<?php date_default_timezone_set('America/Sao_Paulo');
                    echo date('d/m/Y H:i:s'); ?>" 
                style="color: blue; text-align: center; font-size: 15pt; border: none; display: inline;" size="15" ></input>
            </div>
            
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
            <input id="quantidadeItemVenda" style="border: none; text-align: center;" size="2" value="<?php echo'1';?>">
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
                <a id="removeProdutoVenda" href="#" style="display: inline-block; background-color: red; Border: solid red 1px; 
                    width: 20px; height: 20px; text-decoration: none; text-align: center; color: white; font-size: 10pt; 
                        font-weight: bolder; border-radius: 3px;"> X </a>
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
        <div id="adicionaPrudutoVenda" style="padding: 10px;">
                <a href="ConsultaProdutos.php?buscaProdutos=+"> Adcionar Produto</a>
        </div>

        <div id="selectPagamentoVendedor" style="float: right; padding: 10px;">  
        <label id="labelTipoPagamento" style="font-size: 13pt"> Tipo de Pagamento:</label> 
            <select id="tipoPagamento" name="tipoPagamento" style="font-size: 13pt; padding: 3px;"> 
                <option value="" selected> </option>
                <option value="a vista" >À Vista</option>
                <option value="debito">Débito</option>
                <option value="credito">Crédito</option>
        </select><br/><br/>
                    <!-- ==================== BUSCAR VENDEDOR =====================-->
                    
        <label id="labelVendedorSelecionado" style="font-size: 13pt;">   &nbsp; Vendedor:</label>
            <select id="vendedor" name="vendedor" style="font-size: 13pt; padding: 3px; margin-right: 10px;">
                <option value="" selected> </option>
                    <?php $dados = $pessoa->selectAllPessoaFuncionarioVendedor();
                        if(count($dados) > 0) 
                        {
                            for ($i=0; $i < count($dados) ; $i++) 
                            { 
                                echo "<option>"; 
                                foreach ($dados[$i] as $key => $value) 
                                {
                                    if ($key == "nome" ) // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        echo  $value. "</option>";
                                    }
                                }
                            }
                        } 
                    ?> 
        </select><br/>

        </div>
        <div id="dadosClienteVenda">
        <legend style="border: solid 1px #8b0210; background-color:  #8b0211; color: white; padding: 2px; ">DADOS DA VENDA</legend><br>
            
        <label id="labelNomeCliente">Nome:</label>
        <input id="nomeCliente" type="search" class="form-control" name="nomeCliente" size="50" 
            value="<?php if (isset($_GET['id_pessoa_get_up'])) 
            {
                    $id_pessoa_get_up = addslashes($_GET['id_pessoa_get_up']); 
                        $retornoConsulta = $pessoa->selectPessoaCliente($id_pessoa_get_up); 
	                        if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];
                }
            } 
                ?>"> <br>

        <label id="labelCpf">CPF:</label><br>
        <input id="cpfCliente" type="text" name="cpfCliente" class="form-control" size="25" 
            value="<?php if (isset($_GET['id_pessoa_get_up'])) 
            {
                    $id_pessoa_get_up = addslashes($_GET['id_pessoa_get_up']); 
                        $retornoConsulta = $pessoa->selectPessoaCliente($id_pessoa_get_up); 
	                        if(isset($retornoConsulta)){echo $retornoConsulta[0]['cpf_cnpj'];
                }
            } 
                ?>">

            <div id="adicionaClienteVenda">
                    <a href="ConsultaClientes.php?buscaCliente=+" style="font-size: 12px; margin-left: 5px;
                    border: dotted 1px; width: 50px; height: 30px; float: right; 
                    margin-right: 170px; display: block;">Buscar</a>
            </div> 
        </div>

        <div id="saidaValorVenda">            
            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto" class="form-control" size="10">
            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" class="form-control" size="10" placeholder="%">
            <label for="totalComDesconto" id="totalComDesconto">Total com Desconto: R$</label>
            <input id="totalComDesconto" name="totalComDesconto" class="form-control" size="10">
        <button class="btn btn-outline-danger" id="btnFecharVenda" name="fecharVenda" onclick="" 
            style="display: inline;">Fechar Venda</button>
        </div>  

    </section>
</body>

</html>