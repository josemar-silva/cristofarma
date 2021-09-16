<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Vendas</title>
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
        <div id="itensSelecionados">
            <legend>REALIZAR VENDA/ORÇAMENTO</legend><br>
            <input id="buscarItem" type="text" name="buscarItem" size="60"
                placeholder="Digite aqui para pesquisar o produto">
            <button type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Buscar</button><br><br>
            <label id="quantidade">Quantidade:</label>
            <input id="quantidade" type="text" name="quantidade" size="5" min="1" placeholder="Qtd">
            <label id="desconto">Desconto (%):</label>
            <input id="getDesdescontoconto" type="text" name="desconto" size="5" placeholder="%">
            <button type="submit" id="btnAdicionarItenVenda" name="adicionarItemVenda">Adicionar</button>
            <button type="submit" id="btnRemoverItemVenda" name="removerItemVenda">Remover</button>
        </div><br>
        <fieldset id="clienteVenda">
            <legend>Dados da Venda:</legend>
            <label id="Nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35"><br>
            <label id="Cpf">CPF:</label>
            <input id="Cpf" type="text" name="cpf" size="20">
            <a href="" id="linkNovoCliente">+</a><br>
            <div id="saidaDados">
                <h4>Total sem Desconto: R$</h4>
                <output id="totalSemDesconto" name="totalSemDesconto"></output><br>
                <p>
                <h3>Total com Desconto: R$</h3>
                <output id="TotalComDesconto" name="totalComDesconto"></output>
                </p>
            </div>
        </fieldset>
    </section>
</body>

</html>