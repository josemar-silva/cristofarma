<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Nota Fiscal</title>
</head>

<body>
    <header>

    </header>
    <section id="menu">
        <p><a href="index.php">HOME</a></p>
        <p><a href="Vendas.php">VENDAS</a></p>
        <p><a href="Caixa.php">CAIXA</a></p>
        <p><a href="Produtos.php">PRODUTOS</a></p>
        <p><a href="Fonecedor.php">FORNECEDOR</a></p>
        <p><a href="Clientes.php">CLIENTES</a></p>
        <p><a href="Usuarios.php">USUÁRIOS</a></p>
        <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
        <p><a href="Relatorios.php">RELATÓRIO</a></p>
    </section>
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