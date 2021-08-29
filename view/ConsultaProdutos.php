<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Pesquisar Produtos</title>
</head>

<body>
    <header>

    </header>
    <section id="menu">
        <p><a href="home.php">HOME</a></p>
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
        <?php
            echo "<table>";
            echo "<tr>";
            echo "<th> ID </th>";
            echo "<th> DESCRIÇÃO PRODUTO </th>";
            echo "<th> FORNECEDOR </th>";
            echo "<th> PREÇO CUSTO </th>";
            echo "<th> PREÇO VENDA </th>";
            echo "<th> CÓDIGO DE BARRAS </th>";
            echo "</tr>";
            echo "</table>";
        ?>
        <p><a href="Pesquisar.php"><<< voltar</a>
    </section>
</body>

</html>