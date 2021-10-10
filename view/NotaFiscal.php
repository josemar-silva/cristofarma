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
            <li><a href="Pesquisar.php">PESQUISAR</a>
                <ul>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="#">Fornecedores</a></li>
                    <li><a href="#">Funcionários</a></li>
                    <li><a href="#">Produtos</a></li>                    
                </ul>
            </li>
            <li><a href="Vendas.php">VENDAS</a></li>
            <li><a href="Caixa.php">CAIXA</a></li>
            <li><a href="#">PRODUTOS</a>
                 <ul>
                    <li><a href="CadastrarProdutos.php">Cadastro de Produtos</a></li>
                    <li><a href="#">Estoque de Produtos</a></li>                                        
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
            <input type="radio" id="numVenda" name="tipoRelatorio" value="numeroVenda" checked>
            <label for="numVenda">Nº Venda</label>
            <input type="radio" id="numeroCpf" name="tipoRelatorio" value="numeroCpf">
            <label for="numCpf">Nº CPF</label><br><br>
            <input type="text" size="60" id="" placeholder="Digite aqui para pesquisar">

            <button class="btn btn-outline-danger" type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Buscar</button>
            <button class="btn btn-outline-danger"type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Emitir NotaFiscal</button>

        </fom><br>
    </section>
</body>

</html>