<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Pesquisar Fornecedores</title>
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
    <?php
     echo "<table>";
     echo "<tr>";
     echo "<th> ID </th>";
     echo "<th> NOME FORNECEDOR </th>";
     echo "<th> CPF/CNPJ </th>";
     echo "<th> EMAIL </th>";
     echo "<th> TELEFONE FIXO </th>";
     echo "<th> TELEFONE CELULAR </th>";
     echo "<th> ENDEREÇO </th>";
     echo "</tr>";
     echo "</table>";
    ?>
    </section>
</body>

</html>