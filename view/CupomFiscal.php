<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Nota Fiscal</title>
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
            <li><a href="CupomFiscal.php">CUPOM FISCAL</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>
    </header>
    <div id="divSair" >
        <a href="index.php">Sair</a>
    </div>

    <section id="principalNotaFiscal" style="height: 610px;; border: none;">
        <form id="notaFiscal" style="margin-left: 1%; margin-right: 1%;" action="" method="POST">
            <Legend>CUPOM FISCAL</Legend><br>
            <input type="radio" id="numVenda" name="tipoRelatorioCupom" value="numeroVenda" style="margin-left: 20%;"> &nbsp; &nbsp;
            <label for="numVenda">Nº Venda</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            <input type="radio" id="numeroCpf" name="tipoRelatorioCupom" value="numeroCpf"> &nbsp; &nbsp;
            <label for="numCpf">Nº CPF</label>&nbsp; &nbsp;
            <input type="search" class="form-control" size="30" id="buscarDadosCupom" name="buscarDadosCupom" autofocus placeholder="Digite aqui para pesquisar">

            <button class="btn btn-outline-danger" type="submit" id="btnBuscarVendaEmissao" name="btnBuscarVendaEmissao" onclick="" style="margin-left: 3%;">Buscar</button><br><br>   

    <table id="" class="table table-hover">
<?php    

    require_once '../model/Pessoa.php';
    require_once '../model/Venda.php';
    require_once '../model/Produto.php';

    $vendaRelatorio = new Venda();
    $pessoa = new Pessoa();

    $tipoRelatorio = filter_input(INPUT_POST, 'tipoRelatorioCupom');


        echo '<tr>';
            echo '<th> ID VENDA </th>';
            echo '<th> DATA VENDA</th>';
            echo '<th> NOME DO CLIENTE </th>';
            echo '<th> VENDEDOR </th>';
            echo '<th> VALOR SEM DESCONTO </th>';
            echo '<th> DESCONTO </th>';
            echo '<th> VALOR COM DESCONTO </th>';
            echo '<th> TOTAL ITENS </th>';
            echo '<th> PAGAMENTO </th>';
            echo '<th> STATUS </th>';
            echo '<th> CHECKED </th>';

        echo '</tr>';

                                            // CONSULTA VENDA POR DATA INICIO E DATA FIM

    if (empty($_POST['buscarDadosCupom']))
    {

            $returnVendas = $vendaRelatorio->selectAllVendaFechada();
        
            if(count($returnVendas) > 0)  
        {
            for ($i=0; $i < count($returnVendas) ; $i++) 
            { 
                echo "<tr>";

                    foreach ($returnVendas[$i] as $key => $value) 
                    {
                        if ($key == 'id_venda') 
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

                    ?>

                   <td>
                    <input type="radio" id="checkerCupom" name="checkedCumpom" value="<?php echo $returnVendas[$i]['id_venda']?>">
                   </td>

                    <?php

                    echo "</tr>"; 
            } 
        }

    } else {

        if (isset($_POST['tipoRelatorioCupom']) && $tipoRelatorio == 'numeroVenda') 
        {
            
            $returnVendas = $vendaRelatorio->selectVendaIdRelatorio($idVendaLike = "%".trim($_POST['buscarDadosCupom'])."%");
        
            if(count($returnVendas) > 0)  
        {
            for ($i=0; $i < count($returnVendas) ; $i++) 
            { 
                echo "<tr>";

                    foreach ($returnVendas[$i] as $key => $value) 
                    {
                        if ($key == 'id_venda') 
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

                    ?>

                   <td>
                    <input type="radio" id="checkerCupom" name="checkedCumpom" value="emitirCupomVenda" checked>
                   </td>

                    <?php

                    echo "</tr>"; 
            } 
        }
        } else {
            if (isset($_POST['tipoRelatorioCupom']) && $tipoRelatorio == 'numeroCpf') {
            
                $buscaCpf = filter_input(INPUT_POST, 'buscarDadosCupom');
                
                $returnVendas = $vendaRelatorio->selectVendaLikeCpf($buscaCpf);
            
                if(count($returnVendas) > 0)  
            {
                for ($i=0; $i < count($returnVendas) ; $i++) 
                { 
                    echo "<tr>";
    
                        foreach ($returnVendas[$i] as $key => $value) 
                        {
                            if ($key == 'id_venda') 
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
    
                        ?>
    
                       <td>
                        <input type="radio" id="checkerCupom" name="checkedCumpom" value="emitirCupomVenda" checked>
                       </td>
    
                        <?php
    
                        echo "</tr>"; 
                } 
            }
            }
        }
    }
                    ?>
        </table>
        </form>
    </section>
    <button class="btn btn-outline-danger"type="submit" id="btnGerarNotaFiscal" name="gerarCumpom" style="margin-left: 40%; margin-top: 1%;">Emitir Cupom Fiscal</button>

</body>

</html>