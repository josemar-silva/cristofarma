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
    require_once 'Endereco.php.php';
    //require_once 'ConsultaClientes.php';

    $pessoa =  new Pessoa();

    $tipo = filter_input(INPUT_POST, 'tipoPessoa');

    if (isset($_POST['nome'])) # evitar codigos maliciosos
    {
        $nome = addslashes($_POST['nome']); # verificando se existe dados dentro do parametro/variavel
        $email = addslashes($_POST['email']);
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']); # verificando se existe dados dentro do parametro/variavel
        $endereco = addslashes($_POST['endereco']);
        $cpfAndCnpj = addslashes($_POST['cpfAndCnpj']); # verificando se existe dados dentro do parametro/variavel
        #$cnpj = addslashes($_POST['cnpj']);

        if (!empty($nome) && !empty($email))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!empty($tipo)) {

                if ($tipo == 'pf') {
                    if (!$pessoaFisica->createPessoaFisica($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cpfAndCnpj)) {
                        echo "Email já está cadastrado!";
                    }
                } else {
                    if (!$pessoaJuridica->createPessoaJuridica($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cpfAndCnpj)) {
                        echo "Email já está cadastrado!";
                    }
                }
            } else {
                echo "Selecione o tipo de pessoa a ser cadastrada";
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
            <input id="nome" type="text" name="nome" size="40" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta['nome'];}?>"><br>

            <label for="cpfAndCnpj" id="cpf">CPF/CNPJ:</label><br>
            <input id="cpfAndCnpj" type="text" name="cpfAndCnpj" size="20" value=""><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone:</label><br>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="15" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta['telefone_fixo'];}?>"><br>

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

            <label for="telefoneCelular" id="lebelCelularCliente">Celular:</label><br>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="15" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta['telefone_celular'];}?>"><br>

            <label for="email" id="email">E-mail:</label><br>
            <input id="email" type="email" name="email" size="30" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta['email'];}?>"><br>

            <label for="endereco" id="endereco">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="40" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta['endereco'];}?>">
            <a href="CadastrarEndereco.php">+</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" 
                value="<?php echo "Cadastrar"; ?>">
        </form>
    </section>
    </section>
</body>

</html>