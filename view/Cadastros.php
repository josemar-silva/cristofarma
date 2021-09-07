<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Cadastros</title>
</head>

<body>
    <header>

    </header>

    <?php

    require_once 'Pessoa.php';
    require_once 'Endereco.php';

    $pessoa =  new Pessoa();
    $endereco = new Endereco();

    $pessoa_tipo;
    $tipo = filter_input(INPUT_POST, 'tipoPessoa'); #filtrar valor que um inpult recebeu
        if ($tipo = 'cliente') {
           $pessoa_tipo = '1';
        } elseif ($tipo = 'fornecedor') {
            $pessoa_tipo = '2';
        } else {
            $pessoa_tipo = '3';
        }

    if (isset($_POST['nome'])) # evitar codigos maliciosos
    {
        $nome = addslashes($_POST['nome']); # verificando se existe dados dentro do parametro/variavel
        $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
        $tipo_pessoa = addslashes($_POST[$pessoa_tipo]);
        $email = addslashes($_POST['email']); 
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']); 
        $matricula = addslashes($_POST['matricula']);
        $senha = addslashes($_POST['senha']);
        $funcao = addslashes($_POST['listaFuncao']);

        if (!empty($nome) && !empty($email))  // validar se há ao menos um dado a ser cadastrado
        {
            if (!empty($tipo)) {

                    if (!$pessoa->createPessoa($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
                    $telefoneCelular, $matricula, $senha, $funcao)) {
                        if ($tipo = 'cliente') {
                            echo "Cliente já está cadastrado!";
                        } elseif ($tipo = 'fornecedor') {
                            echo "Fornecedor já está cadastrado!";
                        } else {
                            echo "Funcionário já está cadastrado!";
                        }
                    }
            else {
                echo "Selecione o tipo de pessoa a ser cadastrada";
            }
        }
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
        <form id="cadastro" method="POST">

            <legend>CADASTROS</legend><br>

            <input type="radio" name="tipoPessoa" value="pj" id="pessoaJuridica">
            <label for="cliente">Cliente</label>&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="radio" name="tipoPessoa" value="pf" id="pessoaFisica">
            <label for="fornecedor">Fornecedor</label>&nbsp;&nbsp;&nbsp;&nbsp;

            <input type="radio" name="tipoPessoa" value="pj" id="pessoaJuridica">
            <label for="funcionarios">Funcionários</label>&nbsp;&nbsp;&nbsp;&nbsp;<br><br>

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
            <input id="senha" type="password" name="senha" size="10" value=""><br>

            <label id="funcao">Função:</label>
            <select id="listaFuncao" name="listaFuncao">
                <option value="gerente">Gerente</option>
                <option value="vendedor" selected>Vendedor</option>
                <option value="operador de Caixa">Operador de Caixa</option>
            </select><br/>

            <label for="endereco" id="endereco">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="40" value="">
            <a href="CadastrarEndereco.php">+</a><br>

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" 
                value="<?php echo "Cadastrar"; ?>">
        </form>
    </section>
    </section>
</body>

</html>