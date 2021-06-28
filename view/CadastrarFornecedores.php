<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Fornecedores</title>
</head>

<body>
    <header>

    </header>
    <?php

    require_once 'PessoaJuridica.php';
    require_once 'Fornecedor.php';
    require_once 'Pessoa.php';
    require_once 'PessoaFisica.php';


    $fornecedor = new Fornecedor();

    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']);
        $endereco = addslashes($_POST['endereco']);
        $cnpj = addslashes($_POST['cnpj']);
        if (!empty($nome) && !empty($email))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!$fornecedor->createFornecedor($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cnpj)) {
                echo "Email já está cadastrado!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
    ?>
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

        <form id="cadatroFormecedor" method="POST">
            <legend>CADASTRO DE FORNECEDORES</legend><br>
            <label id="nome">Nome:</label><br>
            <input id="nome" type="text" name="nome" size="40" value=""><br>
            <label id="cnpj">CNPJ:</label><br>
            <input id="cnpj" type="text" name="cnpj" size="20" value=""><br>
            <label id="telefoneFixo">Telefone:</label><br>
            <input id="telefoneFixo" type="tel" name="telefoneFixo" size="15" value=""><br>
            <label id="telefoneCelular">Celular:</label><br>
            <input id="telefoneCelular" type="tel" name="telefoneCelular" size="15" value=""><br>
            <label id="email">E-mail:</label><br>
            <input id="email" type="email" name="email" size="30" value=""><br>
            <label id="endereco">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="40" value="">
            <a href="CadastrarEndereco.php">+</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                value="<?php echo "Cadastar"; ?>">
        </form>
        <aside id="buscaFornecedor">
            <legend>PESQUISAR FORNECEDORES</legend><br>
            <label for="buscarCliente">Buscar Fornecedores:</label><br>
            <input id="buscarFornecedor" type="text" name="buscarFornecedor" size="70" placeholder="Nome do fornecedor">
            <a href="procurarFornecedor" href="">+</a>
        </aside>

    </section>
</body>

</html>