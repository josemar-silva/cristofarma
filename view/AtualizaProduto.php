<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <title>Atualizar Produtos</title>

</head>

<body>
    <?php

    require_once 'Conexao.php';
    require_once 'Pessoa.php';
    require_once 'Produto.php';

    $produto = new Produto();

    if (isset($_GET['id_get_up']) && !empty($_GET['id_get_up'])) {

        if (isset($_POST['descricaoProduto'])) {
            
            $id_up = addslashes($_GET['id_get_up']);  
            $produto_nome = addslashes($_POST['descricaoProduto']);
            $produto_preco_custo = addslashes($_POST['precoCusto']);
            $produto_preco_venda = addslashes($_POST['precoVenda']);
            $produto_codigo_barras = addslashes($_POST['codigoDeBarras']);
            $produto_fornecedor = addslashes($_POST['fornecedor']);
    
            if (!empty($produto_nome) && !empty($produto_codigo_barras))  // validar se há ao menos um dado a ser cadastrado
            {
                if ($produto->updateProduto($id_up, $produto_nome, $produto_preco_custo, $produto_preco_venda, 
                $produto_codigo_barras, $produto_fornecedor));

                    header('location: AtualizaProduto.php');
                
            } else {
                echo "Preencha todos os campos!";
            } 
                echo '<script> alert("Cadastro atualizado com sucesso!")</script>';
        }
    } else {
        if (isset($_POST['descricaoProduto'])) {
            $produto_nome = addslashes($_POST['descricaoProduto']);
            $produto_preco_custo = addslashes($_POST['precoCusto']);
            $produto_preco_venda = addslashes($_POST['precoVenda']);
            $produto_codigo_barras = addslashes($_POST['codigoDeBarras']);
            $produto_fornecedor = addslashes($_POST['fornecedor']);
    
            if (!empty($produto_nome) && !empty($produto_codigo_barras))  // validar se há ao menos um dado a ser cadastrado
            {
                if (!$produto->createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, 
                $produto_codigo_barras, $produto_fornecedor)) {
                    echo "Produto já está cadastrado!";
                }
            } else {
                echo "Preencha todos os campos!";
            } 
                echo '<script> alert("Produto cadastrado com sucesso!")</script>';
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
                $retornoConsulta = $produto->selectProduto($id_up); #retorno da consulta armazenado na variavel $retornoConsulta
            }
        ?>
            <form id="cadastro" method="POST">
                <legend>CADASTRO DE PRODUTOS</legend><br>

                <label id="descricaoProduto">Descrição:</label><br>
                <input id="descricaoProduto" type="text" name="descricaoProduto" size="60" 
                    value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome_produto'];}?>"> <br>

                <label id="codigoDeBarras">Código de Barras:</label><br>
                <input id="codigoDeBarras" type="text" name="codigoDeBarras" size="60" 
                    value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['codigo_barras'];}?>"><br>

                <label id="fornecedor">Fornecedor:</label><br> 
                <input id="fornecedor" type="text" name="fornecedor" size="60" 
                    value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['produto_fornecedor'];}?>"><br>

                <label id="precoCusto">Preço de Custo:</label><br>
                <input id="precoCusto" type="text" name="precoCusto" size="60" 
                    value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['preco_custo'];}?>"> <br><br>

                <label id="precoVenda">Preço de Venda:</label><br>
                <input id="precoVenda" type="text" name="precoVenda" size="60"
                     value="<?php if(isset($retornoConsulta)){echo $retornoConsulta[0]['preco_venda'];}?>"> <br>

                <input id="btnCadastrar" type="submit" id="btnCadastrar" name="btnGravarClientes"
                    value="<?php if (isset($_GET['id_get_up'])){echo 'Atualizar';} else {echo 'Cadastrar';}?>">
            </form>
        </section>
</body>

</html>