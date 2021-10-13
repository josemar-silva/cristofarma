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
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    </header>
    <section id="principalRelatoriVendas">
        <div id="relatorioGerencialVendas" style="margin-left: 5%;">
            <legend>
                <legend>RELATÓRIO DE VENDAS</legend>
            </legend>
            <label for="dataInicial">Data Inicio:</label> &nbsp; 
            <input type="date" id="getDataInicial" class="form-control"> 
            <label for="dataFinal">Data Fim:</label> &nbsp;
            <input type="date" id="getDataFinal" class="form-control"><br><br>
            <input type="radio" id="vendedor" name="tipoRelatorio" value="vendedor">&nbsp; &nbsp;
            <label for="vendedor">Vendedor:</label>
            <input type="text" id="nomeDoVendedor" class="form-control" size="40" placeholder="Nome do vendedor">
            <input type="radio" id="cliente" name="tipoRelatorio" value="cliente">&nbsp; &nbsp;
            <label for="cliente">Cliente:</label>
            <input type="search" id="nomeDoCliente" class="form-control" size="40" placeholder="Nome/CPF/CNPJ do cliente">
            <input type="radio" id="produto" name="tipoRelatorio" value="produto">&nbsp; &nbsp;
            <label for="produto">Produto:</label>
            <input type="search" id="nomeDoProduto" class="form-control" size="40" placeholder="Nome do produto"><br><br>
            <input type="radio" id="relatorioVendaAVvista" name="tipoRelatorioPagamento" value="Venda a Vista">&nbsp; &nbsp;
            <label for="relatorioVendaAVvista">Venda à Vista</label>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
            <input type="radio" id="relatorioVendaDebito" name="tipoRelatorioPagamento" value="Cartao de Debito">&nbsp; &nbsp;
            <label for="relatorioVendaDebito">Venda a Débito</label>&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
            <input type="radio" id="relatorioVendaCredito" name="tipoRelatorioPagamento" value="Cartao de Credito">&nbsp; &nbsp;
            <label for="relatorioVendaCredito">Venda a Crédito</label><br><br>

            <button class="btn btn-outline-danger" id="btnGerarRelatorioGerencial">Gerar Relatório</button>
        </div>
    </section>
</body>

</html>