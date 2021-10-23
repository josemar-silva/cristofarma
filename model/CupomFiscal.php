<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Nota Fiscal</title>
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
    <div id="divSair" >
        <a href="index.php">Sair</a>
    </div>

    <section id="principalNotaFiscal">
        <form id="notaFiscal" style="margin-left: 1%;">
            <Legend>CUPOM FISCAL</Legend><br>
            <input type="radio" id="numVenda" name="tipoRelatorio" value="numeroVenda" checked style="margin-left: 20%;"> &nbsp; &nbsp;
            <label for="numVenda">Nº Venda</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <input type="radio" id="numeroCpf" name="tipoRelatorio" value="numeroCpf"> &nbsp; &nbsp;
            <label for="numCpf">Nº CPF</label>&nbsp; &nbsp;
            <input type="text" class="form-control" size="60" id="" placeholder="Digite aqui para pesquisar">

            <button class="btn btn-outline-danger" type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal" style="margin-left: 3%;">Buscar</button><br><br>

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
                            echo '<th> CODIGO </th>';
                            echo '<th> DESCRIÇÃO DO PRODUTO </th>';
                            echo '<th> QTD </th>';
                            echo '<th> LABORATÓRIO </th>';
                            echo '<th> PREÇO </th>';                            
                        echo '</tr>';
                ?>
        </table>

            <button class="btn btn-outline-danger"type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal" style="margin-left: 40%;">Emitir Cupom Fiscal</button>

        </fom><br>
    </section>
</body>

</html>