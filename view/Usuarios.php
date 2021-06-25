<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Usuário</title>
</head>
<?php

require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'PessoaJuridica.php';
require_once 'PessoaFisica.php';
require_once 'Funcionario.php';

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
        <form id="cadastroUsuario" method="POST">
            <legend>CADASTRO DE USUÁRIOS</legend><br>
            <label id="nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35" value=""><br>
            <label id="cpf">CPF:</label>
            <input id="cpf" type="text" name="cpf" size="20" value=""><br>
            <label id="email">E-mail:</label>
            <input id="email" type="email" name="email" size="30" value=""><br>
            <label id="telefoneFixo">Telefone:</label>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="15" value=""><br>
            <label id="telefoneCelular">Celular:</label>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="15" value=""><br>
            <label id="labelEnderecoUsuario">Endereço:</label>
            <input id="endereco" type="text" name="endereco" size="30" value="">
            <a href="FormEndereco.php">Editar</a><br>

            <label id="matricula">Matrícula:</label>
            <input id="matricula" type="text" name="matricula" size="10" value="">
            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="senha" size="10" value=""><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" value="<?php echo "Cadastar"; ?>">
        </form>
    </section>
</body>

</html>