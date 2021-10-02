<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

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
    <section id="principalVendas" style="padding: 10px;">
    <legend>REALIZAR VENDA/ORÇAMENTO</legend><br>

         <div id="adicionaRemove">
            <label id="quantidade">Quantidade:</label>
            <input id="quantidade" type="text" name="quantidade" size="5" min="1" placeholder="Qtd">
            <label id="desconto">Desconto (%):</label>
            <input id="getDesdescontoconto" type="text" name="desconto" size="5" placeholder="%">
            <button type="submit" id="btnAdicionarItenVenda" name="adicionarItemVenda">Adicionar</button>
            <button type="submit" id="btnRemoverItemVenda" name="removerItemVenda">Remover</button><br>
        </div>
        <div id="itensSelecionados" style="float: left;">
            <input id="buscarItem" type="search" name="buscarItem" size="60"
                placeholder="Digite aqui para pesquisar o produto">
            <button type="submit" id="btnGerarNotaFiscal" name="gerarNotaFiscal">Buscar</button><br><br>
        <div id="clienteVenda">
            <legend>Dados da Venda:</legend>
            <label id="Nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35"><br>
            <label id="Cpf">CPF:</label>
            <input id="Cpf" type="text" name="cpf" size="20">
            <a href="" id="linkNovoCliente">++</a><br>
        </div><br><br>
        <div id="saidaDados">
            <label id=""> Total sem Desconto: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto"  size="10"><br>
            <label>Total com Desconto: R$</label>
            <input id="TotalComDesconto" name="totalComDesconto" size="10">
        </div>
        </div><br>

        <div id="itensAdicionados">
            
        </div>
        
    </section>
</body>

</html>