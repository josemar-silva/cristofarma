<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Caixa</title>
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
        <legend>PESQUISAR</legend><br>
        <div id="pesquisar" name="pesquisar">
            <input type="radio" name="pesquisar" value="produto">
            <label for="produto">Produto</label>
            <input type="radio" name="pesquisar" value="cliente">
            <label for="clientes">Ciente</label>
            <input type="radio" name="pesquisar" value="fornecedor">
            <label for="fonecedor">Fornecedor</label>

            <input type="text" id="buscar" size="70">
            <a href="">+</a>
        </div>
    </section>
</body>

</html>