<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">    
    <link rel="stylesheet" href="../css/estilo.css">


    <title>Relatórios</title>
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
    <div id="divSair">
        <a href="index.php">Sair</a>
    </div>

    </header>

    <section id="principalRelatoriVendas">
        <form id="relatorioGerencialVendas" style="margin-left: 5%;" action="RelatorioSaida.php" method="POST">
            <legend>
                <legend>RELATÓRIO DE VENDAS</legend>
            </legend>
            <div style="margin-bottom: 7%;">

            <input type="radio" id="tipoRelatorio" name="tipoRelatorio" value="data">&nbsp; &nbsp;
            <label for="cliente">Pesqusa por Data:</label><br>
                <label for="dataInicial" >Data Inicio:</label> &nbsp; 
                <input type="date" id="getDataInicial" name="getDataInicial" class="form-control" style="display: inline;" > &nbsp; &nbsp;&nbsp; &nbsp;
                <label for="dataFinal">Data Fim:</label> &nbsp;
                <input type="date" id="getDataFinal" name="getDataFinal" class="form-control" style="display: inline;"><br>
            </div>
        <div style="margin-bottom: 7%;">
            <input type="radio" id="tipoRelatorio" name="tipoRelatorio" value="cliente">&nbsp; &nbsp;
            <label for="cliente">Pesqusa por Cliente:</label><br>
            <label for="nomeDoCliente"> Cliente:</label>&nbsp; &nbsp;
            <input type="search" id="nomeDoCliente" name="nomeDoCliente" class="form-control" size="40" placeholder="Nome do cliente" style="display: inline;"><br><br><br><br><br><br>

            <label>Pesqusa por Tipo Pagamento:</label><br><br>
            
            <input type="radio" id="relatorioVendaAvista" name="tipoRelatorio" value="a vista">&nbsp; &nbsp;
            <label for="relatorioVendaAvista">Venda à Vista</label>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

            <input type="radio" id="relatorioVendaDebito" name="tipoRelatorio" value="debito">&nbsp; &nbsp;
            <label for="relatorioVendaDebito">Venda a Débito</label>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;

            <input type="radio" id="relatorioVendaCredito" name="tipoRelatorio" value="credito">&nbsp; &nbsp;
            <label for="relatorioVendaCredito">Venda a Crédito</label>
        </div>

        <div style="margin-bottom: 4%;">
            <input type="radio" id="vendedor" name="tipoRelatorio" value="vendedor">&nbsp; &nbsp;
            <label for="vendedor">Pesqusar por Vendedor:</label>&nbsp; &nbsp;
            <input type="text" id="nomeDoVendedor" name="nomeDoVendedor" class="form-control" size="40" placeholder="Nome do vendedor" style="display: inline;"><br>
        </div>

            <button class="btn btn-outline-danger" id="btnGerarRelatorioGerencial" name="btnGerarRelatorioGerencial" onclick="" style="margin-left: 40%;">Gerar Relatório</button>
</form>
    </section>
</body>

</html>