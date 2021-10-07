<?php
    require_once 'Produto.php';
    $produto = new Produto();
?>
<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Pesquisar Produtos</title>
</head>
<body>
    <header>

    </header>
    <?php
        if (isset($_GET['id_get_up']))   # select produto pela id enviada no metodo _GET
        {
            $id_up = addslashes($_GET['id_get_up']); 
            $retornoConsulta = $produto->selectProduto($id_up); #retorno da consulta armazenado na variavel $retornoConsulta
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
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    <section id="principal">

    <!---------------------- BUSCA %like% = 'quem contem'... ----------------------->

        <table>            
            <?php 
                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th> CÓDIGO PRODUTO </th>';
                    echo '<th> NOME DO PRODUTO </th>';
                    echo '<th> PREÇO CUSTO </th>';
                    echo '<th> PREÇO VENDA </th>';
                    echo '<th> CÓDIGO DE BARRAS </th>';
                    echo '<th> FORNECEDOR </th>';
                    echo '</tr>';

                    $dados = $produto->selectAllProduto();

                    //echo"<pre>"; // organizar o array (matriz de array)
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
                                <td> 
                                    <a href="AtualizaProduto.php?id_get_up=<?php echo $dados[$i]['id_produto'];?>">Editar</a>
                                    <a href="ConsultaProdutos.php?id_get_del=<?php echo $dados[$i]['id_produto'];?>">Excluir</a> 
                                    <!-- usar "echo $dados[$i]['id_pessoa']; "pegar ID desejado no array e passar como 'string' para o metodo $_GET-->
                                </td>
                            <?php
                                echo "</tr>"; // fecha linha dos dados selecionados
                        }
                    } 
            ?>
        </table>
    </section>
</body>

</html>
    <?php // FUNÇAO PARA DELETER PRODUTO PELA ID

        if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
        {
            $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
            $produto->deleteProduto($id_up); 
            header("location: ConsultaProdutos.php"); #atualizar a pagina ao executar a exclusão
        }
    ?>