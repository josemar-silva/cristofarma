<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Relatórios</title>
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