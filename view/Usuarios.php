<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Usuário</title>
</head>
<?php

require_once 'Funcionario.php';
require_once 'Pessoa.php';
require_once 'PessoaFisica.php';


$funcionario = new Funcionario();

if (isset($_POST['nome'])) {
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);
    $telefoneFixo = addslashes($_POST['telefoneFixo']);
    $telefoneCelular = addslashes($_POST['telefoneCelular']);
    $endereco = addslashes($_POST['endereco']);
    $cpf = addslashes($_POST['cpf']);
    $matricula = addslashes($_POST['matricula']);
    $senha = addslashes($_POST['senha']);
    if (!empty($nome) && !empty($email))  // validar se há ao menos um dado a ser cadastrado
    {
        if (!$funcionario->createFuncionario($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cpf, $matricula, $senha)) {
            echo "Email já está cadastrado!";
        }
    } else {
        echo "Preencha todos os campos!";
    }
}
?>

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

        <form action="cadastroUsuario">
            <legend>CADASTRO DE USUÁRIOS</legend><br>
            <label id="nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35" value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['nome'];
                                                                        } ?>"><br>
            <label id="cpf">CPF:</label>
            <input id="cpf" type="text" name="cpf" size="20" value="<?php if (isset($dadosRetorno)) {
                                                                        echo $dadosRetorno['cpf'];
                                                                    } ?>"><br>
            <label id="email">E-mail:</label>
            <input id="email" type="email" name="email" size="30" value="<?php if (isset($dadosRetorno)) {
                                                                                echo $dadosRetorno['email'];
                                                                            } ?>"><br>
            <label id="telefoneFixo">Telefone:</label>
            <input id="telefoneFixo" type="tel" name="telefoneFixo" size="15" minlength="11" value="<?php if (isset($dadosRetorno)) {
                                                                                                        echo $dadosRetorno['telefoneFixo'];
                                                                                                    } ?>"><br>
            <label id="telefoneCelular">Celular:</label>
            <input id="telefoneCelular" type="tel" name="telefoneCelular" size="15" minlength="11" value="<?php if (isset($dadosRetorno)) {
                                                                                                                echo $dadosRetorno['telefoneCelular'];
                                                                                                            } ?>"><br>
            <label id="labelEnderecoUsuario">Endereço:</label>
            <input id="endereco" type="text" name="endereco" size="30" value="<?php if (isset($dadosRetorno)) {
                                                                                    echo $dadosRetorno['endereco'];
                                                                                } ?>">
            <a href="FormEndereco.php">Editar</a><br>

            <label id="matricula">Matrícula:</label>
            <input id="matricula" type="text" name="matricula" size="10" value="<?php if (isset($dadosRetorno)) {
                                                                                    echo $dadosRetorno['matricula'];
                                                                                } ?>">
            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="senha" size="10" value="<?php if (isset($dadosRetorno)) {
                                                                                echo $dadosRetorno['senha'];
                                                                            } ?>"><br>
            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes">
        </form>
    </section>
</body>

</html>