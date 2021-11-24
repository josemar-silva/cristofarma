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
    
    </header>
    <div id="divSair"  >
        <a href="../index.php">Sair</a>
    </div>
    <section id="principalSaidaRelatorio">
        <div id="saidaRelatorio">
            <legend>
                <legend>RELATÓRIO DE VENDAS (<?php echo trim(filter_input(INPUT_POST, 'tipoRelatorio').')')?></legend><br>
            </legend>

<div id="divRelatorioVendasEstoque">
<table id="tableRelatorioVendasEstoque" class="table table-hover">

<?php    

require_once '../model/Pessoa.php';
require_once '../model/Venda.php';
require_once '../model/Produto.php';

$vendaRelatorio = new Venda();
$pessoa = new Pessoa();

$tipoRelatorio = filter_input(INPUT_POST, 'tipoRelatorio');

echo '<thead>';
    echo '<tr>';
        echo '<th> CÓDIGO VENDA </th>';
        echo '<th> DATA VENDA</th>';
        echo '<th> NOME DO CLIENTE </th>';
        echo '<th> VENDEDOR </th>';
        echo '<th> VALOR SEM DESCONTO </th>';
        echo '<th> DESCONTO </th>';
        echo '<th> VALOR COM DESCONTO </th>';
        echo '<th> TOTAL ITENS </th>';
        echo '<th> PAGAMENTO </th>';
        echo '<th> STATUS </th>';
        echo '<th>AÇÃO</th>';
    echo '</tr>';
echo '</thead>';
                                        // CONSULTA VENDA POR DATA INICIO E DATA FIM
echo '<tbody>';
if (isset($_POST['btnGerarRelatorioGerencial']) && $tipoRelatorio == 'data')
{
    if (isset($_POST['getDataInicial']) && isset($_POST['getDataFinal']) && !empty($_POST['getDataInicial'])  && !empty($_POST['getDataFinal']))
    {   
        // FORMATANDO STRING EM DATE //

        $di = strtotime($_POST['getDataInicial']);
        $data_ini = date('d/m/Y', $di);
        
        $df = strtotime($_POST['getDataFinal']);
        $data_fim = date('d/m/Y', $df);
        
        $returnVendas = $vendaRelatorio->selectVendaData($data_ini, $data_fim);
       
        if(count($returnVendas) > 0)  
    {
       for ($i=0; $i < count($returnVendas) ; $i++) 
        { 
             echo "<tr>";
             
                foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'codigo_venda') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'data_venda')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'nome') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_vendedor')
                    {
                        ?>
                            <td> <?php $p = $pessoa->selectPessoaFuncionarioVendedor($value); echo $p[0]['nome'];?> </td>
                        <?php   
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_sem_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'desconto')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_com_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'total_item_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'tipo_pagamento')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'status_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                }           $vendaDestalhar = $returnVendas[$i]['id_venda'];
                        ?>  
                            <td> 
                                <a id="detalharVendaReatorio" href="DetalharVenda.php?id_venda_up=<?php echo $vendaDestalhar; ?>" style="font-size: 12px;">Detalhar</a>
                            </td>
                        <?php

                echo "</tr>";
        } 
    }
    echo '</tbody>';
    }
} 
                                                // CONSULTA VENDA POR NOME CLIENTE 'LIKE'

if (isset($_POST['btnGerarRelatorioGerencial']) && $tipoRelatorio == 'cliente' && !empty($_POST['nomeDoCliente']))
{

    $returnVendas =  $vendaRelatorio->selectVendaClienteLike($nomeCliente = "%".trim($_POST['nomeDoCliente'])."%");

     if(count($returnVendas) > 0)  
    {
       for ($i=0; $i < count($returnVendas) ; $i++) 
        { 
             echo "<tr>";

                foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'codigo_venda') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'data_venda')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'nome') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_vendedor')
                    {                   
                        ?>
                            <td> <?php $p = $pessoa->selectPessoaFuncionarioVendedor($value); echo $p[0]['nome'];?> </td>
                        <?php   
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_sem_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'desconto')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_com_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'total_item_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'tipo_pagamento')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'status_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } 
                        $vendaDestalhar = $returnVendas[$i]['id_venda'];
            ?>  
                <td> 
                    <a id="detalharVendaReatorio" href="DetalharVenda.php?id_venda_up=<?php echo $vendaDestalhar;?>" style="font-size: 12px;">Detalhar</a>
                </td>
            <?php

                echo "</tr>"; // fecha linha dos dados selecionados
        } 
    }
}
                                                // CONSULTA VENDA POR TIPO DE PAGAMENTO

if (isset($_POST['btnGerarRelatorioGerencial']) && isset($_POST['tipoRelatorio']))
{
    $returnVendas =  $vendaRelatorio->selectVendaAllLikePagamento($tipoRelatorio);

    if(count($returnVendas) > 0)  
    {
       for ($i=0; $i < count($returnVendas) ; $i++) 
        { 
             echo "<tr>";

                foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'codigo_venda') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'data_venda')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_cliente') 
                    {
                        ?>                    
                            <td> <?php $p = $pessoa->selectPessoaCliente($value); echo $p[0]['nome'];?> </td>
                        <?php 
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_vendedor')
                    {
                        ?>
                            <td> <?php $p = $pessoa->selectPessoaFuncionarioVendedor($value); echo $p[0]['nome'];?> </td>
                        <?php   
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_sem_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'desconto')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_com_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'total_item_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'tipo_pagamento')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'status_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                }
                    $vendaDestalhar = $returnVendas[$i]['id_venda'];
            ?>  
                <td> 
                    <a id="detalharVendaReatorio" href="DetalharVenda.php?id_venda_up=<?php echo $vendaDestalhar;?>" style="font-size: 12px;">Detalhar</a>
                </td>
            <?php

                echo "</tr>"; // fecha linha dos dados selecionados
        } 
    }
}
                                                // CONSULTA VENDA POR NOME VENDEDOR 'LIKE'

if (isset($_POST['btnGerarRelatorioGerencial']) && $tipoRelatorio == 'vendedor' && !empty($_POST['nomeDoVendedor']))
{

    $returnVendas =  $vendaRelatorio->consultaVendaLikeVendedor($nomeVendedor = "%".trim($_POST['nomeDoVendedor'])."%");

    if(count($returnVendas) > 0)  
    {
       for ($i=0; $i < count($returnVendas) ; $i++) 
        { 
             echo "<tr>";

                foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'codigo_venda') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'data_venda')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_cliente') 
                    {
                        ?>
                            <td> <?php $p = $pessoa->selectPessoaCliente($value); echo $p[0]['nome'];?> </td>
                        <?php
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_vendedor')
                    {               
                        ?>           
                            <td> <?php $p = $pessoa->selectPessoaFuncionarioVendedor($value); echo $p[0]['nome'];?> </td>
                        <?php   
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_sem_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'desconto')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_com_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'total_item_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'tipo_pagamento')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'status_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                }                
                    $vendaDestalhar = $returnVendas[$i]['id_venda'];
                    $status = $returnVendas[$i]['status_venda'];
                ?>  
                        <td> 
                            <a id="detalharVendaReatorio" href="DetalharVenda.php?id_venda_up=<?php echo $vendaDestalhar;?>" 
                                        style="font-size: 12px;">Detalhar</a>
                        </td>
                <?php

                echo "</tr>"; // fecha linha dos dados selecionados
        } 
    }
}
                                            // RELATORIO GERAL DE VENDAS

if (isset($_POST['btnGerarRelatorioGerencial']) && $tipoRelatorio == 'vendaGeral')
{

    $returnVendas =  $vendaRelatorio->selectAllVenda();

    if(count($returnVendas) > 0)  
    {
       for ($i=0; $i < count($returnVendas) ; $i++) 
        { 
             echo "<tr>";

                foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'codigo_venda') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'data_venda')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_cliente') 
                    {

                    ?>
                
                        <td> <?php $p = $pessoa->selectPessoaCliente($value); echo $p[0]['nome'];?> </td>

                    <?php

                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {   
                    if ($key == 'pessoa_id_pessoa_vendedor')
                    {
                    
                    ?>
                
                        <td> <?php $p = $pessoa->selectPessoaFuncionarioVendedor($value); echo $p[0]['nome'];?> </td>

                    <?php   

                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_sem_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'desconto')  
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'valor_venda_com_desconto') 
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'total_item_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'tipo_pagamento')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                } foreach ($returnVendas[$i] as $key => $value) 
                {
                    if ($key == 'status_venda')  // IMPRIMIR VALOR SOMENTE SE...
                    {
                        echo "<td>" .$value. "</td>";
                    }
                }                
                    $vendaDestalhar = $returnVendas[$i]['id_venda'];
                    $status = $returnVendas[$i]['status_venda'];
                ?>  
                        <td> 
                            <a id="detalharVendaReatorio" href="DetalharVenda.php?id_venda_up=<?php echo $vendaDestalhar;?>" 
                                        style="font-size: 12px;">Detalhar</a>
                        </td>
                <?php

                echo "</tr>"; // fecha linha dos dados selecionados
        } 
    }
       
}

if (isset($_POST['fecharRelatorio'])) {

    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=RelatorioVendas.php"/>';
}
           
?>

</table>
            </div>
           
        </div>

        <a type="submit" href="RelatorioVendas.php" class="btn btn-outline-danger" id="fecharRelatorio" type="submit" name="fecharRelatorio" 
            style="margin-left: 43%; margin-top: 1%;">Fechar Relatório</a>
    
    </section>
</body>

</html>