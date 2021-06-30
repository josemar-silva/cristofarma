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
            <legend>CADASTRO DE USUÁRIOS</legend><br>
            <label id="nome">Nome:</label><br>
            <input id="nome" type="text" name="nome" size="40" value=""><br>
            <label id="cpf">CPF:</label><br>
            <input id="cpf" type="text" name="cpf" size="20" value=""><br>
            <label id="email">E-mail:</label><br>
            <input id="email" type="email" name="email" size="30" value=""><br>
            <label id="telefoneFixo">Telefone:</label><br>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="15" value=""><br>
            <label id="telefoneCelular">Celular:</label><br>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="15" value=""><br>
            <label id="matricula">Matrícula:</label><br>
            <input id="matricula" type="text" name="matricula" size="10" value=""><br>
            <label for="senha">Senha:</label><br>
            <input id="senha" type="password" name="senha" size="10" value=""><br>
            <label id="funcao">Função:</label>
            <select id="listFuncao" name="listaFuncao">
                <option value="Gerente">Gerente</option>
                <option value="Vendedor" selected>Vendedor</option>
                <option value="Operador de Caixa">Operador de Caixa</option>
            </select><br />
            <label id="labelEnderecoUsuario">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="40" value="">
            <a href="CadastrarEndereco.php">+</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                value="<?php echo "Cadastar"; ?>">
        </form>
        <aside id="buscaUsuario">
            <legend>PESQUISAR USUÁRIOS</legend><br>
            <label for="buscarCliente">Buscar Usuário:</label><br>
            <input id="buscarUsuario" type="text" name="buscarUsuario" size="70" placeholder="Nome do usuário">
            <a href="procurarUsuario" href="">+</a>
        </aside>
    </section>
</body>

</html>