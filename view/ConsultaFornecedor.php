<?php
    require_once 'Pessoa.php';
    $pessoa = new Pessoa();
?>

<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Pesquisar Clientes</title>
</head>

<body>
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
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
        </ul>
    </nav>
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    </header>

    <?php

        if (isset($_GET['pesquisa'])) 
        {
            $id_up = addslashes($_GET['pesquisa']); 
            $retornoConsulta = $pessoa->selectAllPessoaFornecedor(); #retorno da consulta armazenado na variavel $retornoConsulta
        
        }
    ?>
    <section >
    
    <form action="ConsultaClientes.php" method="GET">
        
        <label>Pesquisa:</label>
        <input type="search" id="pesquisa" class="form-control" name="pesquisa" value="" size=" 70" placeholder="Digte aqui para buscar" >

        <button class="btn btn-outline-danger" id="btnBuscar" onclick="" style="width: 10%; padding: 2px;">Buscar</button><br><br>
    </form>

    <table class="table table-hover">
        <tr>
            <th> CÓDIGO FORNECEDOR </th>
            <th> NOME DO FORNECEDOR</th>
            <th> CPF/CNPJ</th>
            <th> EMAIL </th>
            <th> TELEFONE FIXO </th>
            <th> TELEFONE CELULAR </th>
            <th> ENDEREÇO DO FORNECEDOR</th>
            <th>  </th>
        </tr>
        <?php

            $dados = $pessoa->selectAllPessoaFornecedor();

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
                        if ($key != "matricula" && $key != "senha" && $key != "funcao" && $key != "tipo_pessoa") // ignorar coluna
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
                    ?>
                        <td> 
                            <a href="AtualizaFornecedor.php?id_get_up=<?php echo $dados[$i]['id_pessoa'];?>">Editar</a>
                            <a href="ConsultaFornecedor.php?id_get_del=<?php echo $dados[$i]['id_pessoa'];?>">Excluir</a> 
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

<?php

    if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
    {
        $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
        $pessoa->deletePessoa($id_up); 
        header("location: ConsultaFornecedor.php"); #atualizar a pagina ao executar a exclusão
    }
?>