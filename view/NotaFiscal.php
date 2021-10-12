<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
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
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
        </ul>
    </nav>
    </header>
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    <section id="principal">
        <form id="notaFiscal" style="margin-left: 5%;">
            <Legend>NOTA FISCAL</Legend><br>
            <input type="radio" id="numVenda" name="tipoRelatorio" value="numeroVenda" checked> &nbsp; &nbsp;
            <label for="numVenda">Nº Venda</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            <input type="radio" id="numeroCpf" name="tipoRelatorio" value="numeroCpf"> &nbsp; &nbsp;
            <label for="numCpf">Nº CPF</label><br><br>
            <input type="text" class="form-control" size="60" id="" placeholder="Digite aqui para pesquisar">

            <button class="btn btn-outline-danger" type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Buscar</button>
            <button class="btn btn-outline-danger"type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Emitir NotaFiscal</button>

        </fom><br>
    </section>
</body>

</html>