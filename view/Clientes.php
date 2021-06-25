<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Clientes</title>
</head>

<body>
    <header>

    </header>
    <?php

    require_once 'PessoaFisica.php';
    require_once 'PessoaJuridica.php';

    $pessoaFisica = new PessoaFisica();
    $pessoaJuridica =  new PessoaJuridica();

    $tipo = filter_input(INPUT_POST, 'tipoPessoa');

    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']);
        $endereco = addslashes($_POST['endereco']);
        $cpf = addslashes($_POST['cpf']);
        $cnpj = addslashes($_POST['cnpj']);

        if (!empty($nome) && !empty($email))  // validar se há ao menos um dado a ser cadastrado
        {
            if ($tipo == 'pf') {
                if (!$pessoaFisica->createPessoaFisica($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cpf)) {
                    echo "Email já está cadastrado!";
                }
            } else {
                if (!$pessoaJuridica->createPessoaJuridica($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cnpj)) {
                    echo "Email já está cadastrado!";
                }
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
    ?>
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
        <form id="cadastroClientes" method="POST">

            <legend>CADASTRO DE CLIENTES</legend><br>

            <input type="radio" name="tipoPessoa" value="pj" id="pessoaJuridica">
            <label for="pj">Pessoa Juridica</label><br>
            <input type="radio" name="tipoPessoa" value="pf" id="pessoaFisica">
            <label for="pf">Pessoa Fisica</label><br>

            <!--<script>
                var radio = document.getElementById('tipoPessoa');

                if (radio == "pf") {
                    document.getElementById("pessoaJuridica").disabled = true;
                } else {
                    document.getElementById("pessoaFisica").disabled = true;
                }
            </script>-->


            <label for="nome" id="nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35" value=""><br>

            <label for="cpf" id="cpf">CPF:</label>
            <input id="cpf" type="text" name="cpf" size="20" value=""><br>
            <label id="cnpj">CNPJ:</label>
            <input id="cnpj" type="text" name="cnpj" size="20" value=""><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone:</label>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="15" value=""><br>

            <label for="telefoneCelular" id="lebelCelularCliente">Celular:</label>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="15" value=""><br>

            <label for="email" id="email">E-mail:</label>
            <input id="email" type="email" name="email" size="30" value=""><br>

            <label for="endereco" id="endereco">Endereço:</label>
            <input id="endereco" type="text" name="endereco" size="30" value="">
            <a href="FormEndereco.php">Editar</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" value="<?php echo "Cadastar"; ?>">
        </form>

    </section>
    </section>
</body>

</html>