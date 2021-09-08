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
    
    require_once 'Pessoa.php';

    $pessoa = new Pessoa();

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
        <p><a href="home.php">HOME</a></p>
            <p><a href="Pesquisar.php">CONSULTAS</a></p>
            <p><a href="Vendas.php">VENDAS</a></p>
            <p><a href="Caixa.php">CAIXA</a></p>
            <p><a href="CadastrarProdutos.php">PRODUTOS</a></p>
            <p><a href="Cadastros.php">CADASTROS</a></p>
            <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
            <p><a href="Relatorios.php">RELATÓRIO</a></p>
    </section>
    <section id="principal">
        <form id="formEndereco" method="POST">

            <legend>CADASTRO DE ENDEREÇO</legend><br>

            <label for="logradouro" id="logradouro">Rua/Logradouro:</label><br>
            <input id="logradouro" type="text" name="logradouro" size="40" value=""><br>

            <label for="quadra" id="quadra">Quadra:</label><br>
            <input id="quadra" type="text" name="quadra" size="10" value=""><br>

            <label id="lote" for="lote">Lote:</label><br>
            <input id="lote" type="text" name="lote" size="10" value=""><br>

            <label for="bairro" id="bairro">Bairro:</label><br>
            <input id="bairro" type="text" name="bairro" size="40" value=""><br>

            <label for="cidade" id="cidade">Cidade:</label><br>
            <input id="cidade" type="text" name="cidade" size="40" value=""><br>

            <label for="cep" id="cep">CEP:</label><br>
            <input id="cep" type="text" name="cep" size="15" value=""><br>

            <label for="complemento" id="complemento">Complemento:</label><br>
            <input id="complemento" type="text" name="complemento" size="40" value=""><br>



            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                value="<?php echo "Cadastrar"; ?>">
        </form>
    </section>
    </section>
</body>

</html>