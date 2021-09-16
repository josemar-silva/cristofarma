<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Gerenciar Cadastros</title>
</head>

<body>
    <?php

    require_once 'Pessoa.php';
    require_once 'Conexao.php';

    $pessoa =  new Pessoa();

    $tipo = filter_input(INPUT_POST, 'tipoPessoa'); #filtrar valor que um inpult recebeu
    if ($tipo = 'cliente' || $tipo = 'fornecedor'){
        # inserir codigo para bloquear input "FUNCAO, MATRICULA E SENHA"
    }

    if (isset($_POST['nome'])) # evitar codigos maliciosos
    {
        $nome = addslashes($_POST['nome']); # verificando se existe dados dentro do parametro/variavel
        $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
        $tipo_pessoa = addslashes($_POST['tipoCadastro']);
        $email = addslashes($_POST['email']); 
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']); 
        $matricula = addslashes($_POST['matricula']);
        $senha = addslashes($_POST['senha']);
        $funcao = addslashes($_POST['listaFuncao']);

        if (!empty($nome) && !empty($email) && !empty($tipo))  // validar se há ao menos um dado a ser cadastrado
        
        {
            if (!$pessoa->createPessoa($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
            $telefoneCelular, $matricula, $senha, $funcao)) {
                echo "Este cadastro já existe!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }

    ?>
    <header>
    <ul class="nav nav-tabs">
 
            <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Pesquisar.php">PESQUISAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Vendas.php">VENDAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Caixa.php">CAIXA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="CadastrarProdutos.php">PRODUTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cadastros.php">CADASTROS</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="NotaFiscal.php">NOTA FISCAL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Relatorios.php">RELATÓRIOS</a>
            </li>
    </ul>
    </header>
    <section id="principal">
        <form id="cadastro" method="POST">

            <legend>CADASTROS</legend><br>

            <label id="txtTipoCadastro">Tipo de cadastro:</label>
            <select id="tipoCadastro" name="tipoCadastro">
                <option value="" selected>NULL</option>
                <option value="cliente">Cliente</option>
                <option value="fornecedor">Fornecedor</option>
                <option value="funcionario">Funcionário</option>
            </select><br/><br>

            <label for="nome" id="nome">Nome:</label><br>
            <input id="nome" type="text" name="nome" size="40" value=""><br>

            <label for="cpfAndCnpj" id="cpf">CPF/CNPJ:</label><br>
            <input id="cpfAndCnpj" type="text" name="cpf_cnpj" size="20" value=""><br>

            <label for="email" id="email">E-mail:</label><br>
            <input id="email" type="email" name="email" size="30" value=""><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone Fixo:</label><br>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="15" value=""><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone Celular:</label><br>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="15" value=""><br>

            <label id="matricula">Matrícula:</label><br>
            <input id="matricula" type="text" name="matricula" size="10" value=""><br>

            <label for="senha">Senha:</label><br>
            <input id="senha" type="password" name="senha" size="10" value=""><br><br>

            <label id="funcao">Função:</label>
            <select id="listaFuncao" name="listaFuncao">
                <option value="" selected>NULL</option>
                <option value="gerente">Gerente</option>
                <option value="vendedor">Vendedor</option>
                <option value="operador de caixa">Operador de Caixa</option>
            </select><br/><br>

            <label for="endereco" id="endereco">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="40" value="" disabled>
            <a href="CadastrarEndereco.php">Editar</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" 
                value="<?php echo "Cadastrar"; ?>">
        </form>
    </section>
    </section>
</body>

</html>