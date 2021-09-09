<?php
    require_once 'Produto.php';
    $produto = new Produto();
?>

<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Pesquisar Produtos</title>
</head>

<body>
    <header>

    </header>

    <?php
        # select produto pela id enviada no metodo _GET
        if (isset($_GET['id_get_up'])) 
        {
            $id_up = addslashes($_GET['id_get_up']); 
            $retornoConsulta = $produto->selectProduto($id_up); #retorno da consulta armazenado na variavel $retornoConsulta

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
        <table>
            <tr>
                <th> ID </th>
                <th> NOME DO PRODUTO </th>
                <th> PREÇO CUSTO </th>
                <th> PREÇO VENDA </th>
                <th> CÓDIGO DE BARRAS </th>
                <th> FORNECEDOR </th>
                <th> CÓDIGO FORNECEDOR </th>

            </tr>
                <?php

                $dados = $produto->selectAllProduto();

                //echo"<pre>"; // organizar o array (matriz de array)
                //var_dump($dados); // imprimir na tela o resultado do array
                //echo"</pre>"; // organizar o array (matriz de array)

                if(count($dados) > 0) 
                {
                    for ($i=0; $i < count($dados) ; $i++) 
                    { 
                        echo "<tr>"; // abre a linha dos dados selecionados
                        foreach ($dados[$i] as $key => $value) 
                        {
                            //if ($key != "id_pessoa" ) // ignorar coluna ID
                            {
                                echo "<td>" .$value. "</td>";
                            }
                        }
                        ?>
                            <td> 
                                <a href="CadastrarProdutos.php?id_get_up<?php echo $dados[$i]['id_produto'];?>">Editar</a>
                                <a href="ConsultaProdutos.php?id_get_del=<?php echo $dados[$i]['id_produto'];?>">Excluir</a> 
                                <!-- usar "echo $dados[$i]['id_pessoa']; "pegar ID desejado no array e passar como 'string' para o metodo $_GET-->
                            </td>
                        <?php
                            echo "</tr>"; // fecha linha dos dados selecionados
                    }
                }
            ?>
        </table>;

        <p><a href="Pesquisar.php"><<< voltar</a>
    </section>
</body>

</html>
    <?php

        if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
        {
            $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
            $produto->deleteProduto($id_up); 
            header("location: ConsultaProdutos.php"); #atualizar a pagina ao executar a exclusão
        }
    ?>