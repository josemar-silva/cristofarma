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
    <ul class="nav nav-tabs">
 
            <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Pesquisar.php">PESQUISAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Vendas.php">VENDAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Caixa.php">CAIXA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="CadastrarProdutos.php">PRODUTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cadastros.php">CADASTROS</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="NotaFiscal.php">NOTA FISCAL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Relatorios.php">RELATÓRIOS</a>
            </li>
    </ul>
    </header>
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    <section id="principalVendas" style="border: solid 1px red; height: 650px;">
    <legend>REALIZAR VENDA/ORÇAMENTO</legend><br>

        <div id="itensAdicionados">
            <div id="divNumeroVenda" style="display: block; margin-left: 30%;">
                <label>Nº da Venda:</label>
                <input id="numeroVenda" name="numeroVenda" value="<?php echo '000000123456789'?>" 
                style="color: blue; text-align: center; font-size: 15pt; border: none;" size="15" ></input>
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
        <div id="rmoveProdutoVenda">
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
            <input id="nome" type="search" name="nome" size="50"><br>
            <label id="Cpf">CPF:</label>
            <input id="Cpf" type="text" name="cpf" size="25"><br>
            <label for="endereco" id="endereco">Endereço:</label>
            <input id="endereco" type="text" name="endereco" size="60">  
        </div>

        <div id="saidaValorVenda">            
            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto"  size="10"><br>
            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" size="10" placeholder="%"><br>
            <label for="TotalComDesconto" id="TotalComDesconto">Total com Desconto: R$</label>
            <input id="TotalComDesconto" name="totalComDesconto" size="10"><br>
        </div>  
    </section>
</body>

</html>