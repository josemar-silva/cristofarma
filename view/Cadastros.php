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

    require_once '../model/Pessoa.php';
    require_once '../model/Conexao.php';  

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
            $telefoneCelular, $matricula, $senha, $funcao, $endereco);

            header('location: Cadastros.php');
            
        } else {
            echo '<script> alert("Preencha todos os campos!")</script>';
        }
            
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
            echo '<script> alert("Preencha todos os campos!")</script>';
        }
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
            $telefoneCelular, $matricula, $senha, $funcao, $endereco)) {
                echo "Este cadastro já existe!";
            }
        } else {
            echo '<script> alert("Preencha todos os campos!")</script>';
        }
            
        }
    }

    ?>
    <header>
    <nav class="dp-menu">
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="#">PESQUISAR</a>
                <ul>
                    <li><a href="ConsultaClientes.php">Clientes</a></li>
                    <li><a href="ConsultaFornecedor.php">Fornecedores</a></li>
                    <li><a href="ConsultaFuncionarios.php">Funcionários</a></li>
                    <li><a href="ConsultaProdutos.php">Produtos</a></li>                    
                </ul>
            </li>
            <li><a href="Vendas.php">VENDAS</a></li>
            <li><a href="Caixa.php">CAIXA</a></li>
            <li><a href="#">PRODUTOS</a>
                 <ul>
                    <li><a href="CadastrarProdutos.php">Cadastro de Produtos</a></li>
                    <li><a href="AlimentarEstoque.php">Estoque de Produtos</a></li>                                        
                </ul>
            </li>
            <li><a href="Cadastros.php">CADASTROS</a></li>
            <li><a href="CupomFiscal.php">CUPOM FISCAL</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    <div id="divSair" >
        <a href="index.php">Sair</a>
    </div>
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
                <label id="txtTipoCadastro">Tipo de cadastro:</label>
                <select id="tipoCadastro" name="tipoCadastro" class="form-control" autofocus required onchange="verifica(this.value)">
                    <option value="" selected> </option>
                    <option value="cliente" >Cliente</option>
                    <option value="fornecedor">Fornecedor</option>
                    <option value="funcionario">Funcionário</option>
                </select><br/>

            <label for="nome" id="nome">Nome:</label><br/>
            <input id="nome" type="text" class="form-control" name="nome" size="70" required value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];}?>"><br/><br/>

            <label for="cpfAndCnpj" id="cpf">CPF/CNPJ:</label><br/>
            <input id="cpfAndCnpj" class="form-control" type="text" name="cpf_cnpj" size="25" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['cpf_cnpj'];}?>"><br/><br/>

            <label for="email" id="email">E-mail:</label><br/>
            <input id="email" class="form-control" type="email" name="email" size="60" required value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['email'];}?>"><br/><br/>

            <label for="telefoneFixo" id="telefoneFixo">Telefone Fixo:</label>

            <label for="telefoneCelular" id="telefoneCelular" style="margin-left: 35%;">Telefone Celular:</label><br/>

            <input id="telefoneFixo" class="form-control" type="text" name="telefoneFixo" size="25" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['telefone_fixo'];}?>">&nbsp; &nbsp;

            <input id="telefoneCelular" class="form-control" type="text" name="telefoneCelular" size="25"  required style="margin-left: 15%;" value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['telefone_celular'];}?>"><br/><br/>

            <label id="funcao" style="display: inline;">Função:</label>
            <label for="matricula" style="margin-left: 25%;">Matrícula:</label>
            <label for="senha" style="margin-left: 27%;">Senha:</label><br/>

            <select id="listaFuncao" name="listaFuncao" class="form-control" required style="display: inline;" >
                <option value="" selected> </option>
                <option value="gerente">Gerente</option>
                <option value="vendedor">Vendedor</option>
                <option value="operador de caixa">Operador de Caixa</option>
            </select>

            <input id="matricula"  class="form-control"type="text" name="matricula" size="20" style="margin-left: 10%;" value="">&nbsp; 

            <input id="senha"  class="form-control"type="password" name="senha" size="20" style="margin-left: 10%;" value=""> <br/><br/>

            <label for="endereco" id="endereco">Endereço:</label><br>
            <input id="endereco" class="form-control"type="text" name="endereco" size="90" value="" > <br>

            <input  class="btn btn-outline-danger" id="btnCadastrar" type="submit" name="btnGravarClientes" style="margin-left: 40%; margin-top: 3%;"
                value="<?php if (isset($_GET['id_get_up'])){echo 'Atualizar';} else {echo 'Cadastrar';}?>">
        </form>

        <!-- ====== FUNCAO CHECA SE O TIPO DE CADASTRO PARA DEFINIR CAMPOS COMPATIVEIS COM O TIPO =======-->
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
        }
    </script>

    </section>
    <div id="retorno">

    </div>
</body>

</html>