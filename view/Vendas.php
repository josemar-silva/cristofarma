<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

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
            <div id="divNumeroVenda" style="display: block; margin-left: 35%;">
                <label>Nº da Venda:</label>
                <input id="numeroVenda" name="numeroVenda" value="<?php echo '000000123456789'?>" 
                style="color: blue; text-align: center; font-size: 15pt; border: none; display: inline;" size="15" ></input>
            </div>
        <table>            
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

                    echo '<table class="table table-hover">';
                        echo '<tr>';
                            echo '<th> QTD </th>';
                            echo '<th> DESCRIÇÃO DO PRODUTO </th>';
                            echo '<th> FORNECEDOR </th>';
                            echo '<th> PREÇO </th>';
                        echo '</tr>';
                ?>
        </table>
        </div>

        <div id="adicionaPrudutoVenda">
                <a href="ConsultaProdutos.php"> Adcionar Produto</a>
        </div>
        <div id="removeProdutoVenda">
                <a href="#"> Remover Produto</a>
        </div>

        <div id="dadosClienteVenda">
        <legend style="border: solid 1px #8b0210; background-color:  #8b0211; color: white; padding: 2px;">DADOS DA VENDA</legend><br>
            <div id="adicionaClienteVendaNome">
                    <a href="ConsultaClientes.php" style="font-size: 12px; margin-left: 10px;
                    border: dotted 1px; width: 50px; height: 30px; float: right; 
                    margin-right: 170px;">Procurar</a>
            </div>
                <div id="adicionaClienteVendaCpf">
                        <a href="ConsultaClientes.php" style="font-size: 12px; margin-left: 10px;
                        border: dotted 1px; width: 50px; height: 30px; float: right; 
                        margin-right: 170px;">Procurar</a>
                </div>

            <label id="Nome">Nome:</label>
            <input id="nome" type="search" class="form-control" name="nome" size="50">
            <label id="Cpf">CPF:</label>
            <input id="Cpf" type="text" name="cpf" class="form-control" size="25">
            <label for="endereco" id="endereco">Endereço:</label>
            <input id="endereco" type="text" name="endereco" class="form-control" size="60">  
        </div>

        <div id="saidaValorVenda">            
            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto" class="form-control" size="10">
            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" class="form-control" size="10" placeholder="%">
            <label for="TotalComDesconto" id="TotalComDesconto">Total com Desconto: R$</label>
            <input id="TotalComDesconto" name="totalComDesconto" class="form-control" size="10">
        </div>  
    </section>
</body>

</html>