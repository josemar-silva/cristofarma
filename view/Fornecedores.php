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
        <?php
    if (isset($_GET['id_fornecedor_update'])) {
        $id_fornecedor_up = addslashes($_GET['id_fornecedor_update']);
        $dadosRetorno = $fornecedor->selectPessoaJuridica($id_fornecedor_up);
        //header("location: Clientes.php");
    }
    ?>
        <form id="cadatroFormecedor" method="POST">
            <legend>CADASTRO DE FORNECEDORES</legend><br>
            <label id="nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35"  value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['nome'];
                                                                        } ?>"><br>
            <label id="cnpj">CNPJ:</label>
            <input id="cnpj" type="text" name="cnpj" size="20"  value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['cnpj'];
                                                                        } ?>"><br>
            <label id="telefoneFixo">Telefone:</label>
            <input id="telefoneFixo" type="tel" name="telefoneFixo" size="15" minlength="11"  value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['telefone_fixo'];
                                                                        } ?>"><br>
            <label id="telefoneCelular">Celular:</label>
            <input id="telefoneCelular" type="tel" name="telefoneCelular" size="15" minlength="11"  value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['telefone_celular'];
                                                                        } ?>"><br>
            <label id="email">E-mail:</label>
            <input id="email" type="email" name="email" size="30"  value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['email'];
                                                                        } ?>"><br>
            <label id="endereco">Endereço:</label>
            <input id="endereco" type="text" name="endereco" size="30"  value="<?php if (isset($dadosRetorno)) {
                                                                            echo $dadosRetorno['endereco'];
                                                                        } ?>">
            <a href="FormEndereco.php">Editar</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" value="<?php if (isset($dadosRetorno)) {
                                                                                                            echo "Atualizar";
                                                                                                        } else {
                                                                                                            echo "Cadastar";
                                                                                                        } ?>">
        </form>
        <table id="cadastro">
            <tr>
                <th>Nome do Cliente</th>
                <th>Endereço de e-mail</th>
                <th>Telefone Fixo</th>
                <th>Telefone Celular</th>
                <th colspan="2">Endereço</th>
            </tr>
            <?php
            $dados = $fornecedor->selectAllFornecedor(); // variavel local recebendo os dados selecionados pelo metodo buscarDados()

            if (count($dados) > 0) { // chacando se a variavel nao está vazia
                for ($i = 0; $i < count($dados); $i++) { // for () + foreach para trabalhar com leitura de uma matriz
                    echo "<tr>"; # HTML dentro de PHP USAR 'echo "<TAG>"
                    foreach ($dados[$i] as $k => $v) { // for () + foreach para trabalhar com leitura de uma matriz
                        if ($k != "id_pessoa") { #negar a coluna ID, nao selecionar a coluna informada
                            echo "<td>.$v.</td>";
                        }
                    }
            ?>
            <td>
                <a href="Fornecedores.php?id_fornecedor_update=<?php echo $dados[$i]['id_pessoa']; ?>">Editar</a>
                <a href="Fornecedores.php?id_fornecedor=<?php echo $dados[$i]['id_pessoa']; ?>">Excluir</a>
            </td>
            <?php
                    echo "</tr>";
                }
            }
            ?>

            <?php
            if (isset($_GET['id_fornecedor'])) {
                $id = addslashes($_GET['id_fornecedor']);
                $fornecedor->deleteFornecedor($id);
                header("location: Fornecedores.php");
            }
            ?>
        </table>
    </section>
</body>

</html>