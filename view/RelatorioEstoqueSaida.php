<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Relatórios</title>
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
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    <div id="divSair">
        <a href="../index.php">Sair</a>
    </div>

    </header>
<?php
    require_once '../model/Produto.php';
    require_once '../model/Pessoa.php';
    require_once '../model/Estoque.php';

    $produto = new Produto();
    $pessoa = new Pessoa();
    $estoque = new Estoque();
?>

    <section id="principalEstoque"><br>
        <div>
            <legend>RELATÓRIO GERAL DE ESTOQUE</legend><br>
        <div class="tableFixHead" style="width: 70%; height: 41em; margin-left: auto; margin-right: auto; border: #8b0210 solid 1px;">
            <table class="table table-striped table-hover" >
                <thead>
                    <tr>
                        <th style="width: 20%;"> CÓDIGO DE BARRAS </th>
                        <th style="width: 10%;"> CÓDIGO </th>
                        <th> DESCRIÇÃO DO PRODUTO </th>
                        <th style="width: 20%;"> LABORATÓRIO </th>
                        <th style="width: 10%;"> QTD </th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        
                        $dados = $produto->selectAllProduto();

                        if (count($dados) > 0)  
                        {
                            for ($i = 0; $i < count($dados); $i++) {
                                echo "<tr   >"; 
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "codigo_barras") 
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "id_produto") 
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "nome_produto") 
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "pessoa_id_pessoa") 
                                    {
                                        $id_up = $value;
                                        $return = $pessoa->selectPessoaFornecedor($id_up);
                                        $result = $return[0]['nome'];

                                        echo "<td>" . $result . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "id_produto") 
                                    {   
                                        $id_up = $value;
                                        $returnEstoque = $estoque->selectQuantidadeEstoque($id_up);

                                        if ($returnEstoque != null) {
                                            echo '<td>'.$returnEstoque['quantidade_estoque'].'</td>';
                                        } else {
                                            echo "<td>"; echo '0'; echo "</td>";
                                        }
                                    }
                                }
                    ?>
                                
                    <?php
                                echo "</tr>";
                            }
                        } 
                    ?>
                </tbody>
            </table>

            
    </section>
    <a type="submit" href="RelatorioEstoque.php" class="btn btn-outline-danger" id="fecharRelatorio" type="submit" name="fecharRelatorio" 
            style="margin-left: 43%; margin-top: 1%;">Fechar Relatório</a>
</body>

</html>