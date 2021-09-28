<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <title>Gerenciar Cadastros</title>
</head>

<body>
    <?php

    require_once 'Pessoa.php';
    require_once 'Conexao.php';  

    $pessoa =  new Pessoa();

    $tipo = filter_input(INPUT_POST, 'tipoCadastro'); #filtrar valor que um inpult recebeu
    if ($tipo != 'funcionario'){
        if (isset($_POST['nome'])) // CLICOU NO BOTAO CADASTRAR OU EDITAR
    {   
        //--------------------------EDITAR-------------------------------
        if (isset($_GET['id_get_up']) && !empty($_GET['id_get_up'])) 
        {

        $id_upd = addslashes($_GET['id_get_up']);   
        $nome = addslashes($_POST['nome']); # verificando se existe dados dentro do parametro/variavel
        $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
        $tipo_pessoa = addslashes($_POST['tipoCadastro']);
        $email = addslashes($_POST['email']); 
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']); 
        $endereco = addslashes($_POST['endereco']);

        if (!empty($nome) && !empty($email) && !empty($tipo))  // validar se há ao menos um dado a ser cadastrado
        
        {
            $pessoa->updatePessoaClienteFornecedor($id_upd, $nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
            $telefoneCelular, $endereco);

            header('location: Cadastros.php');
            
        } else {
            echo "Preencha todos os campos!";
        }
            echo '<script> alert("Cadastro atualizado com sucesso!")</script>';
        } else 
        //--------------------------CADASTRAR-----------------------------
        {
        
        $nome = addslashes($_POST['nome']); # verificando se existe dados dentro do parametro/variavel
        $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
        $tipo_pessoa = addslashes($_POST['tipoCadastro']);
        $email = addslashes($_POST['email']); 
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']); 
        $endereco = addslashes($_POST['endereco']);

        if (!empty($nome) && !empty($email) && !empty($tipo))  // validar se há ao menos um dado a ser cadastrado
        
        {
            if (!$pessoa->createPessoa($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
            $telefoneCelular, $endereco)) {
                echo "Este cadastro já existe!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
            echo '<script> alert("Cadastro realizado com sucesso!")</script>';
        }
    }
    } else {
    
    if (isset($_GET['id_get_up']) && !empty($_GET['id_get_up'])) 
        {

        $id_upd = addslashes($_GET['id_get_up']);   
        $nome = addslashes($_POST['nome']); # verificando se existe dados dentro do parametro/variavel
        $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
        $tipo_pessoa = addslashes($_POST['tipoCadastro']);
        $email = addslashes($_POST['email']); 
        $telefoneFixo = addslashes($_POST['telefoneFixo']);
        $telefoneCelular = addslashes($_POST['telefoneCelular']);
        $matricula = addslashes($_POST['matricula']);
        $senha = addslashes($_POST['senha']);
        $funcao = addslashes($_POST['listaFuncao']);
        $endereco = addslashes($_POST['endereco']);

        if (!empty($nome) && !empty($email) && !empty($tipo))  // validar se há ao menos um dado a ser cadastrado
        
        {
            $pessoa->updatePessoaFuncionario($id_upd, $nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
            $telefoneCelular, $matricula, $senha, $funcao, $endereco);

            //header("location: Cadastros.php");

        } else {
            echo "Preencha todos os campos!";
        }
            echo '<script> alert("Cadastro atualizado com sucesso!")</script>';
        } else 
        //--------------------------CADASTRAR-----------------------------
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
        $endereco = addslashes($_POST['endereco']);

        if (!empty($nome) && !empty($email) && !empty($tipo))  // validar se há ao menos um dado a ser cadastrado
        
        {
            if (!$pessoa->createPessoaFuncionario($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
            $telefoneCelular, $matricula, $senha, $endereco, $endereco)) {
                echo "Este cadastro já existe!";
            }
        } else {
            echo "Preencha todos os campos!";
        }
            echo '<script> alert("Cadastro realizado com sucesso!")</script>';
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

        <?php
        
        if (isset($_GET['id_get_up'])) // VERIFICA SE CLICOU EM EDITAR
        {
            $id_up = addslashes($_GET['id_get_up']); 
            $retornoConsulta = $pessoa->selectPessoaCliente($id_up); #retorno da consulta armazenado na variavel $retornoConsulta
            
        }
        
        ?>
        <form id="cadastro" method="POST">

            <legend>CADASTROS</legend>

            <input type="hidden" id="id_get" name="id_get" value="">

            <label id="txtTipoCadastro">Tipo de cadastro:</label> <span> <?php if(isset($retornoConsulta)){
                $retornoTipoPessoa = $retornoConsulta[0]['tipo_pessoa'];} ?></span>
            <select id="tipoCadastro" name="tipoCadastro" onchange="verifica(this.value)">
                <option value=""> </option>
                <option value="cliente" <?php if ($retornoTipoPessoa == 'cliente'){echo 'selected';}?>>Cliente</option>
                <option value="fornecedor" <?php if ($retornoTipoPessoa == 'fornecedor'){echo 'selected';}?>>Fornecedor</option>
                <option value="funcionario" <?php if ($retornoTipoPessoa == 'funcionario'){echo 'selected';}?>>Funcionário</option>
            </select><br/>

            <label for="nome" id="nome">Nome:</label><br>
            <input id="nome" type="text" name="nome" size="60" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];}?>"><br>

            <label for="cpfAndCnpj" id="cpf">CPF/CNPJ:</label><br>
            <input id="cpfAndCnpj" type="text" name="cpf_cnpj" size="60" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['cpf_cnpj'];}?>"><br>

            <label for="email" id="email">E-mail:</label><br>
            <input id="email" type="email" name="email" size="60" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['email'];}?>"><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone Fixo:</label><br>
            <input id="telefoneFixo" type="text" name="telefoneFixo" size="60" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['telefone_fixo'];}?>"><br>

            <label for="telefoneFixo" id="telefoneFixo">Telefone Celular:</label><br>
            <input id="telefoneCelular" type="text" name="telefoneCelular" size="60" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['telefone_celular'];}?>"><br>

            <label for="matricula">Matrícula:</label><br>
            <input id="matricula" type="text" name="matricula" size="60" value="<?php if(isset($retornoConsulta)){if (isset($retornoConsulta[0]['matricula'])){ echo $retornoConsulta[0]['matricula'];} else { echo '';}}?>" disabled><br>

            <label for="senha">Senha:</label><br>
            <input id="senha" type="password" name="senha" size="60" value="<?php if(isset($retornoConsulta)){if (isset($retornoConsulta[0]['senha'])){ echo $retornoConsulta[0]['senha'];} else { echo '';}}?>" disabled><br><br>

            <label id="funcao">Função:</label>
            <select id="listaFuncao" name="listaFuncao" disabled>
                <option value=""> </option>
                <option value="gerente" >Gerente</option>
                <option value="vendedor" >Vendedor</option>
                <option value="operador de caixa" >Operador de Caixa</option>
            </select><br/>

    <script>
	        function verifica(value){
	        var i = document.getElementById("tipoCadastro");

        if(value == "funcionario"){
            document.getElementById("matricula").disabled = false;
            document.getElementById("senha").disabled = false;
            document.getElementById("listaFuncao").disabled = false;

                        
        } else {
            document.getElementById("matricula").disabled = true;
            document.getElementById("senha").disabled = true;
            document.getElementById("listaFuncao").disabled = true;
        }
    };
    </script>
            <label for="endereco" id="endereco">Endereço:</label><br>
            <input id="endereco" type="text" name="endereco" size="60" value="<?php if(isset($retornoConsulta)){
                echo $retornoConsulta[0]['endereco'];}?>" >

            <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes" 
                value="<?php if (isset($_GET['id_get_up'])){echo 'Atualizar';} else {echo 'Cadastrar';}?>">
        </form>
    </section>
    <div id="retorno">

    </div>
</body>

</html>