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
<nav class="dp-menu">
        <ul>
            <li><a href="home.php">HOME</a></li>
            <li><a href="Pesquisar.php">PESQUISAR</a>
                <ul>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="#">Fornecedores</a></li>
                    <li><a href="#">Funcionários</a></li>
                    <li><a href="#">Produtos</a></li>                    
                </ul>
            </li>
            <li><a href="Vendas.php">VENDAS</a></li>
            <li><a href="Caixa.php">CAIXA</a></li>
            <li><a href="#">PRODUTOS</a>
                 <ul>
                    <li><a href="CadastrarProdutos.php">Cadastro de Produtos</a></li>
                    <li><a href="#">Estoque de Produtos</a></li>                                        
                </ul>
            </li>
            <li><a href="Cadastros.php">CADASTROS</a></li>
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
        </ul>
    </nav>
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