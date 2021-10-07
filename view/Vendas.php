<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <title>Vendas</title>
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

    <section id="principalVendas" style="padding: 10px;">
    <legend>REALIZAR VENDA/ORÇAMENTO</legend><br>

        <div id="itensAdicionados">

        <table>            
            <?php
                    require_once 'Produto.php';
                    $p =new Produto();

                    echo '<table class="table table-hover">';
                    echo '<tr>';
                    echo '<th> NOME DO PRODUTO </th>';
                    echo '<th> PREÇO CUSTO </th>';
                    echo '<th> PREÇO VENDA </th>';
                    echo '<th> CÓDIGO DE BARRAS </th>';
                    echo '<th> FORNECEDOR </th>';
                    echo '<th>  </th>';
                    echo '</tr>';

                    $dados = $p->selectAllProduto();

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
                                if ($key != "id_produto" && $key != "pessoa_id_pessoa") // ignorar coluna ID
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

        </div>

        <div id="itensSelecionados" style="float: left;">
            <input id="buscarItem" type="search" name="buscarItem" size="60" placeholder="Digite aqui para pesquisar o produto">
            <button type="submit" id="btnBuscarProdutoVendas" name="btnBuscarProdutoVendas">Buscar</button>
        </div>

        <div id="clienteVenda">
            <legend>Dados da Venda:</legend>
            <label id="Nome">Nome:</label>
            <input id="nome" type="search" name="nome" size="50"><br>
            <label id="Cpf">CPF:</label>
            <input id="Cpf" type="text" name="cpf" size="25"><br>        
            <a class="btn btn-outline-danger" href="ConsultaClientes.php" id="btnBuscarCliente" 
            type="submit" style="font-size: 12pt;" >Buscar</a><br><br>
        </div>

        <div id="saidaDados">
            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto"  size="10"><br>
            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" size="10" placeholder="%"><br>
            <label for="TotalComDesconto" id="TotalComDesconto">Total com Desconto: R$</label>
            <input id="TotalComDesconto" name="totalComDesconto" size="10"><br>
            <button class="btn btn-outline-danger" type="submit" id="btnFinalizarVenda" name="btnFinalizarVenda" 
                style="display: inline; font-size: 12pt;">Finalizar Venda</button>
        </div>
        
    </section>
</body>

</html>