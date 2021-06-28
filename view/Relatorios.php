<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Relatórios</title>
</head>

<body>
    <header>

    </header>
    <section id="menu">
        <p><a href="index.php">HOME</a></p>
        <p><a href="Pesquisar.php">CONSULTAS</a></p>
        <p><a href="Vendas.php">VENDAS</a></p>
        <p><a href="Caixa.php">CAIXA</a></p>
        <p><a href="CadastrarProdutos.php">PRODUTOS</a></p>
        <p><a href="CadastrarFornecedores.php">FORNECEDOR</a></p>
        <p><a href="CadastrarClientes.php">CLIENTES</a></p>
        <p><a href="CadastrarUsuarios.php">USUÁRIOS</a></p>
        <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
        <p><a href="Relatorios.php">RELATÓRIO</a></p>
    </section>
    <section id="principal">
        <div id="relatorioGerencialVendas">
            <legend>
                <legend>RELATÓRIO DE VENDAS</legend><br>
            </legend>
            <label for="dataInicial">Data Inicio:</label>
            <input type="date" id="getDataInicial">
            <label for="dataFinal">Data Fim:</label>
            <input type="date" id="getDataFinal"> <br>
            <input type="radio" id="vendedor" name="tipoRelatorio" value="vendedor">
            <label for="vendedor">Vendedor</label>
            <input type="text" id="nomeDoVendedor" size="40" placeholder="Nome do vendedor"><br>
            <input type="radio" id="cliente" name="tipoRelatorio" value="cliente">
            <label for="cliente">Cliente</label>
            <input type="search" id="nomeDoCliente" size="40" placeholder="CPF/CNPJ do cliente"><br>
            <input type="radio" id="produto" name="tipoRelatorio" value="produto">
            <label for="produto">Produto:</label>
            <input type="search" id="nomeDoProduto" size="40" placeholder="Nome do produto"><br>
            <input type="radio" id="relatorioVendaAVvista" name="tipoRelatorio" value="Venda a Vista">
            <label for="relatorioVendaAVvista">Venda à Vista</label><br>
            <input type="radio" id="relatorioVendaDebito" name="tipoRelatorio" value="Cartao de Debito">
            <label for="relatorioVendaDebito">Venda a Débito</label><br>
            <input type="radio" id="relatorioVendaCredito" name="tipoRelatorio" value="Cartao de Credito">
            <label for="relatorioVendaCredito">Venda a Crédito</label><br>
            <input type="radio" id="estoque" name="tipoRelatorio" value="Eestoque">
            <label for="estoque">Relatório de Estoque</label><br>
            <button id="btnGerarRelatorioGerencial">Gerar Relatório</button>
        </div>
    </section>
</body>

</html>