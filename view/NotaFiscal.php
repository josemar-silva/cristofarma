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
    </header>
    <section id="principal">
        <div id="notaFiscal">
            </fieldset>
            <Legend>NOTA FISCAL</Legend><br>
            <input type="radio" id="numVenda" name="tipoRelatorio" value="numeroVenda" checked>
            <label for="numVenda">Nº Venda</label>
            <input type="radio" id="numeroCpf" name="tipoRelatorio" value="numeroCpf">
            <label for="numCpf">Nº CPF</label>
            <input type="text" size="60" placeholder="Digite aqui para pesquisar">
            <button type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Buscar</button>

            <button type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Emitir NotaFiscal</button>

        </div><br>
    </section>
    </section>
</body>

</html>