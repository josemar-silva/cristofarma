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
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
    
    </nav>
    </header>
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    <section id="principalVendas" style="border: solid 1px red; height: 650px;">
    <legend>REALIZAR VENDA/ORÇAMENTO</legend><br>

        <div id="itensAdicionados">
            <div id="divNumeroVenda" style="display: binlock; margin-left: 35%;">
                <label>Nº da Venda:</label>
                <input id="numeroVenda" name="numeroVenda" value="<?php echo '000000123456789'?>" 
                style="color: blue; text-align: center; font-size: 15pt; border: none; display: inline;" size="15" ></input>
            </div>
        <table>            
            <?php
                    require_once 'Produto.php';
                    $p =new Produto();

                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th> PRODUTO </th>';
                    echo '<th> QTD </th>';
                    echo '<th> PREÇO </th>';
                    echo '<th> CÓDIGO DE BARRAS </th>';
                    echo '<th> FORNECEDOR </th>';
                    echo '</tr>';
                ?>
        </table>
        </div>

        <div id="adicionaPrudutoVenda">
                <a href="ConsultaProdutos.php" style="font-size: 12px; margin-left: 10px;">  Adcionar Produto</a>
        </div>
        <div id="removeProdutoVenda">
                <a href="" style="font-size: 12px; margin-left: 10px;"> Remover Produto</a>
        </div>

        <div id="dadosClienteVenda">
        <legend>Dados da Venda:</legend>
            <div id="adicionaClienteVenda">
                    <a href="ConsultaClientes.php" style="font-size: 12px; margin-left: 10px;
                    border: solid red 1px; width: 85px; height: 30px; float: right; 
                    margin-right: 170px;">Buscar Cliente</a>
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