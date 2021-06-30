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
        <form id="cadastro" method="POST">

            <legend>CADASTRO DE CLIENTES</legend><br>

            <input type="radio" name="tipoPessoa" value="pj" id="pessoaJuridica">
            <label for="pj">Pessoa Juridica</label>&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="tipoPessoa" value="pf" id="pessoaFisica">
            <label for="pf">Pessoa Fisica</label><br><br>

            <!--<script>
                var radio = document.getElementById('tipoPessoa');

                if (radio == "pf") {
                    document.getElementById("pessoaJuridica").disabled = true;
                } else {
                    document.getElementById("pessoaFisica").disabled = true;
                }
            </script>-->


            <label for="nome" id="nome">Nome:</label><br>
            <input id="nome" type="text" name="nome" size="40" value=""><br>

            <label for="cpf" id="cpf">CPF:</label><br>
            <input id="cpf" type="text" name="cpf" size="20" value=""><br>
            <label id="cnpj">CNPJ:</label><br>
            <input id="cnpj" type="text" name="cnpj" size="20" value=""><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone:</label><br>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="15" value=""><br>

            <label for="telefoneCelular" id="lebelCelularCliente">Celular:</label><br>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="15" value=""><br>

            <label for="email" id="email">E-mail:</label><br>
            <input id="email" type="email" name="email" size="30" value=""><br>

            <label for="endereco" id="endereco">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="40" value="">
            <a href="CadastrarEndereco.php">+</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                value="<?php echo "Cadastar"; ?>">
        </form>

        <aside id="buscaCliente">
            <legend>PESQUISAR CLIENTES</legend><br>
            <label for="buscarCliente">Buscar Clientes:</label><br>
            <input id="buscarCliente" type="text" name="buscarCliente" size="70" placeholder="Nome do cliente">
            <a href="procurarCliente" href="">+</a><br><br>
        </aside>

    </section>
    </section>
</body>

</html>