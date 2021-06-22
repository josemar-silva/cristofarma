<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Vendas</title>
</head>

<body>
    <header>

    </header>
    <section id="menu">
        <p><a href="index.php">HOME</a></p>
        <p><a href="Vendas.php">VENDAS</a></p>
        <p><a href="Caixa.php">CAIXA</a></p>
        <p><a href="Produtos.php">PRODUTOS</a></p>
        <p><a href="Fornecedores.php">FORNECEDOR</a></p>
        <p><a href="Clientes.php">CLIENTES</a></p>
        <p><a href="Usuarios.php">USUÁRIOS</a></p>
        <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
        <p><a href="Relatorios.php">RELATÓRIO</a></p>
    </section>
    <section id="principal">
        <div id="itensSelecionados">
            <legend>REALIZAR ORÇAMENTO</legend><br>
            <input id="buscarItem" type="text" name="buscarItem" size="50" placeholder="Digite aqui para pesquisar o produto">
            <button type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Buscar</button>
            <label id="quantidade">Quantidade:</label>
            <input id="quantidade" type="text" name="quantidade" size="5" min="1" placeholder="Qtd">
            <label id="desconto">Desconto (%):</label>
            <input id="getDesdescontoconto" type="text" name="desconto" size="5" placeholder="%">
            <button type="submit" id="btnAdicionarItenVenda" name="adicionarItemVenda">Adicionar</button>
            <button type="submit" id="btnRemoverItemVenda" name="removerItemVenda">Remover</button>
        </div><br>
        <table id="produto">
            <tr>
                <th>Código Produto</th>
                <th>Descrição/Nome do Produto</th>
                <th>Fornecedor</th>
                <th>Valor R$</th>
                <th>Qtd Estoque</th>
            </tr>
        </table>
        <fieldset id="vendaCliente">
            <legend>Cliente:</legend>
            <label id="Cpf">CPF:</label>
            <input id="Cpf" type="text" name="cpf" size="20">
            <a href="Clientes.html" id="linkNovoCliente">Buscar Cliente</a>
            <br>
            <label id="Nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35"><br>
            <label id="endereco">Endereço:</label>
            <input id="endereco" type="text" name="endereco" size="35"><br>
            <div id="saidaDados">
                <h3>Total sem Desconto: R$</h3>
                <output id="totalSemDesconto" name="totalSemDesconto"></output><br>
                <p>
                <h2>Total com Desconto: R$</h2>
                <output id="TotalComDesconto" name="totalComDesconto"></output><br>
                </p>
            </div>

        </fieldset>
    </section>
    <section id="btn">
        <button id="btnGerarVenda" name="gerarVenda">Gerar Venda</button>
    </section>
</body>

</html>