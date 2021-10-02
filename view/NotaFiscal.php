<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Nota Fiscal</title>
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
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    </header>
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