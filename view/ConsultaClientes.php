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

    <?php

        if (isset($_GET['id_get_up'])) // VERIFICA SE CLICOU EM EDITAR
        {
            $id_up = addslashes($_GET['id_get_up']); 
            $retornoConsulta = $pessoa->selectAllPessoa($id_up); #retorno da consulta armazenado na variavel $retornoConsulta
        
        }
    ?>
    <label>Buscar:</label>
    <input type="search" id="pesquisaCliente" name="pesquisaCliente" value="" size=" 60"><br><br>

    <section >
    <table class="table table-hover">
        <tr>
            <th> CÓDIGO CLIENTE </th>
            <th> NOME DO CLIENTE</th>
            <th> CPF/CNPJ</th>
            <th> TIPO PESSOA</th>
            <th> EMAIL </th>
            <th> TELEFONE FIXO </th>
            <th> TELEFONE CELULAR </th>
            <th> ENDEREÇO DO CLIENTE</th>

            <th>  </th>
        </tr>
        <?php

            $dados = $pessoa->selectAllPessoaCliente();
        
            #echo"<pre>"; // organizar o array (matriz de array)
            #var_dump($dados); // imprimir na tela o resultado do array
            #echo"</pre>"; // organizar o array (matriz de array)

            if(count($dados) > 0) 
            {
                for ($i=0; $i < count($dados) ; $i++) 
                { 
                    echo "<tr>"; // abre a linha dos dados selecionados

                    foreach ($dados[$i] as $key => $value) 
                    {
                        if ($key != "matricula" && "senha" && "funcao" && "tipo_pessoa") // ignorar coluna
                        {
                            echo "<td>" .$value. "</td>";
                        }
                    }
        ?>
                        <td> 
                            <a href="AtualizaCliente.php?id_get_up=<?php echo $dados[$i]['id_pessoa'];?>">Editar</a>
                            <a href="ConsultaClientes.php?id_get_del=<?php echo $dados[$i]['id_pessoa'];?>">Excluir</a> 
                            <!-- usar "echo $dados[$i]['id_pessoa']; "pegar ID desejado no array e passar como 'string' para o metodo $_GET-->
                        </td>
        <?php
                        echo "</tr>"; // fecha linha dos dados selecionados
                }
            }
        ?>
    </table>
            <p><a href="Pesquisar.php" class=" btn-primary"><<< Voltar</a>
    </section>

    <?php

    #deletar dado selecionado pelo numero da ID passado como parametro 
    if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
    {
        $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
        $pessoa->deletePessoa($id_up); 
        header("location: ConsultaClientes.php"); #atualizar a pagina ao executar a exclusão
    }
    ?>
</body>
</html>

