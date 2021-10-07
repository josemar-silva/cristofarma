<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Consultas</title>
</head>

<body>
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
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    <section id="principal">
        <legend> </legend><br>
        <div id="consultas">

    <form action="Pesquisar.php" method="GET">
        <div id="selecionaTipoConsulta" style="margin-left: 31%;">
            <input type="radio" id="consultaClienteRadio" name="tipoConsulta" value="cliente" style="margin-right: 10px;" style="margin-right: 10px;">
            <label for="consultaClienteRadio" style="margin-right: 40px;">Clientes</label>

            <input type="radio" id="consultaFornecedorRadio" name="tipoConsulta" value="fornecedor" style="margin-right: 10px;">
            <label for="consultaFornecedorRadio" style="margin-right: 40px;">Fornecedores</label>

            <input type="radio" id="consultaFuncionarioRadio" name="tipoConsulta" value="funcionario" style="margin-right: 10px;">
            <label for="consultaFuncionarioRadio" style="margin-right: 40px;">Funcionários</label>

            <input type="radio" id="consultaProdutoRadio" name="tipoConsulta" value="produto" style="margin-right: 10px;">
            <label for="consultaProdutoRadio" style="margin-right: 40px">Produtos</label> <br><br>
        </div>

        <label style="margin-left: 25%;">Pesquisa:</label>
        <input type="search" id="pesquisa" name="pesquisa" value="" size=" 50" placeholder="Digte aqui para buscar" >

        <button class="btn btn-outline-danger" id="btnBuscar" onclick="" style="width: 10%; padding: 2px;">Buscar</button><br><br>
    </form>

    <?php

    require_once 'Produto.php';
    require_once 'Pessoa.php';
    $produto = new Produto();
    $pessoa = new Pessoa();
    
            $tipoConsulta = filter_input(INPUT_GET, 'tipoConsulta'); #filtrar valor que um inpult recebeu
            if (isset($_GET['tipoConsulta']) && $tipoConsulta == 'produto'){

            ?>       <!-- ============ MANTER INPUT RADIO SELECIONADO ==================== -->

                <script>
                        var tipo = document.getElementById("consultaProdutoRadio");
                        tipo.checked = true;
                </script>

            <?php

                if (isset($_GET['pesquisa']))
                { 
                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th> CÓDIGO PRODUTO </th>';
                    echo '<th> NOME DO PRODUTO </th>';
                    echo '<th> PREÇO CUSTO </th>';
                    echo '<th> PREÇO VENDA </th>';
                    echo '<th> CÓDIGO DE BARRAS </th>';
                    echo '<th> FORNECEDOR </th>';
                    echo '<th>  </th>';
                    echo '</tr>';

                    $dados = $produto->consultaProdutoLike($consultaLike = "%".trim($_GET['pesquisa'])."%");

                    //echo"<pre>"; // organizar o array (matriz de arra)
                    //var_dump($dados); // imprimir na tela o resultado do array
                    //echo"</pre>"; // organizar o array (matriz de array)
    
                    if(count($dados) > 0)  // LERO OS DADOS E ESCREVER NO FORM
                    {
                        for ($i=0; $i < count($dados) ; $i++) 
                        { 
                            echo "<tr>"; // abre a linha dos dados selecionados
                            foreach ($dados[$i] as $key => $value) 
                            {
                                if ($key != "pessoa_id_pessoa" ) // ignorar coluna ID
                                {
                                    echo "<td>" .$value. "</td>";
                                }
                            }
                            ?>
                            <?php
                                echo "</tr>"; // fecha linha dos dados selecionados
                        }
                    } 
                } 
            ?>
    <?php
    } elseif ($tipoConsulta == 'cliente') {
        if (isset($_GET['pesquisa']))

        ?>       <!-- ============ MANTER INPUT RADIO SELECIONADO ==================== -->
                    <script>
                            var tipo = document.getElementById("consultaClienteRadio");
                            tipo.checked = true;
                    </script>
        <?php
                { 
                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th> CÓDIGO CLIENTE </th>';
                    echo '<th> NOME DO CLIENTE </th>';
                    echo '<th> CPF/CNPJ </th>';
                    echo '<th> TIPO PESSOA </th>';
                    echo '<th> E-MAIL </th>';
                    echo '<th> TELEFONE FIXO </th>';
                    echo '<th> TELEFONE CELULAR </th>';
                    echo '<th>  </th>';
                    echo '<th>  </th>';
                    echo '<th> ENDEREÇO DO CLIENTE </th>';
                    echo '</tr>';

                    $dados = $pessoa->consultaClienteFornecedorLike($consultaLike = "%".trim($_GET['pesquisa'])."%", $tipoConsulta);
    
                    if(count($dados) > 0) 
            {
                for ($i=0; $i < count($dados) ; $i++) 
                { 
                    echo "<tr>"; // abre a linha dos dados selecionados

                    foreach ($dados[$i] as $key => $value) 
                    {
                        if ($key != "matricula" && "senha" && "funcao") // ignorar coluna

                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
        ?>
        <?php
                        echo "</tr>"; // fecha linha dos dados selecionados
                        }
                    } 
                }
            ?>
        </table>
<?php 
    } elseif ($tipoConsulta == 'fornecedor') {
        if (isset($_GET['pesquisa']))
        ?>       <!-- ============ MANTER INPUT RADIO SELECIONADO ==================== -->

                    <script>
                            var tipo = document.getElementById("consultaFornecedorRadio");
                            tipo.checked = true;
                    </script>
        <?php
                { 
                    echo '<table class="table table-bordered">';
                    echo '<th> CÓDIGO FORNECEDOR </th>';
                    echo '<th> NOME DO FORNECEDOR </th>';
                    echo '<th> CPF/CNPJ </th>';
                    echo '<th> TIPO PESSOA </th>';
                    echo '<th> E-MAIL </th>';
                    echo '<th>  FIXO </th>';
                    echo '<th> CELULAR </th>';
                    echo '<th> ENDEREÇO FORNECEDOR </th>';                    
                    $dados = $pessoa->consultaClienteFornecedorLike($consultaLike = "%".trim($_GET['pesquisa'])."%", $tipoConsulta);

                    if(count($dados) > 0) 
            {
                for ($i=0; $i < count($dados) ; $i++) 
                { 
                    echo "<tr>"; // abre a linha dos dados selecionados

                    foreach ($dados[$i] as $key => $value) 
                    {
                        if ($key != "matricula" && "senha" && "funcao") // ignorar coluna
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
        ?>
        <?php
                        echo "</tr>"; // fecha linha dos dados selecionados
                        }
                    } 
                }
            ?>
        </table>
    <?php
    } elseif ($tipoConsulta == 'funcionario'){
        if (isset($_GET['pesquisa']))

        ?>       <!-- ============ MANTER INPUT RADIO SELECIONADO ==================== -->

                    <script>
                            var tipo = document.getElementById("consultaFuncionarioRadio");
                            tipo.checked = true;
                    </script>
        <?php
                { 
                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th> CÓDIGO FUNCIONARIO </th>';
                    echo '<th> NOME DO FUNCIONARIO </th>';
                    echo '<th> CPF/CNPJ </th>';
                    echo '<th> TIPO PESSOA </th>';
                    echo '<th> E-MAIL </th>';
                    echo '<th> TELEFONE FIXO </th>';
                    echo '<th> TELEFONE CELULAR </th>';
                    echo '<th> MATRÍCULA </th>';
                    echo '<th> FUNÇÃO </th>';
                    echo '<th> ENDEREÇO DO FUNCIONARIO </th>';
                    echo '</tr>';

                    $dados = $pessoa->consultaClienteFornecedorLike($consultaLike = "%".trim($_GET['pesquisa'])."%", $tipoConsulta);

                    if(count($dados) > 0) 
                    {
                        for ($i=0; $i < count($dados) ; $i++) 
                        { 
                            echo "<tr>"; // abre a linha dos dados selecionados
                            foreach ($dados[$i] as $key => $value) 
                            {
                                if ($key != "senha" )// ignorar coluna
                                {
                                    echo "<td>" .$value. "</td>";
                                }
                            }
                            ?>
                            <?php
                                echo "</tr>"; // fecha linha dos dados selecionados
                        }
                    } 
                }
        ?>
        </table>
    <?php   
    } else {
        ?> 
        <div style="margin-left: 35%;"><h2>Selecione o tipo de pesquisa!<h2></div>;
<?php
    }
?>          
    </section>
</body>

</html>