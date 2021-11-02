<!doctype html>
<html lang="pt">
<script language=javascript type="text/javascript"></script>

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <?php
        
        require_once '../model/Produto.php';
        require_once '../model/PrudutoVenda.php';
        require_once '../model/Pessoa.php';
        require_once '../model/Venda.php';
        require_once '../model/Estoque.php';
        require_once '../model/Conexao.php';

        $produto = new Produto();
        $produtoVenda = new ProdutoVenda();
        $pessoa = new Pessoa();
        $venda = new Venda();
        $estoque = new Estoque();
        

        if (isset($_POST['fecharVenda'])) 
        {

            if (!empty($_POST['idClienteVenda']) && !empty($_POST['vendedor'])&& !empty($_POST['tipoPagamento'])) 
            {

                $vendaStatus = 'aberto';

                $id_venda = addslashes($_POST['codigoVenda']);
                $pessoa_id_pessoa_vendedor =  addslashes($_POST['vendedor']); 
                $pessoa_id_pessoa_cliente =  addslashes($_POST['idClienteVenda']);
                $data_venda = addslashes($_POST['dataVenda']);
                $tipo_pagamento = addslashes($_POST['tipoPagamento']);
                $status_venda = $vendaStatus;
                $valor_venda_sem_desconto =  addslashes($_POST['totalSemDesconto']);
                $desconto =  addslashes($_POST['desconto']);
                $valor_venda_com_desconto =  addslashes($_POST['totalComDesconto']);
                $total_item_venda = 1; // CASTING garante que valor será do tipo INTEIRO

                if (!$venda->createVenda($id_venda, $pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_cliente, $data_venda, $tipo_pagamento, $status_venda,
                $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $total_item_venda)) 
                {
                    echo '<script> alert("Não foi possível concluir essa venda!")</script>';
                        
                } else {

                    if (isset($_SESSION['itens'])) {
                        $produtoVenda->createProdutoVenda($codigo_gerado_venda, $idItem); 
                    } else {
                        echo 'Não foi possivel comcluir ProdutoVenda.';
                    }
                     
                    echo '<script> alert("Venda finalizada Com sucesso!")</script>';
                    session_destroy(); // encerrar a seção e destroi as variaves existentes nela
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>'; // REFRESH para atualizar a página
                }
            }

        } 
    ?>
    <title>Vendas</title>
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
    <div id="divSair"    >
        <a href="index.php">Sair</a>
    </div>
<form method="POST">
    <div id="divCodigoVenda">

<label style="font-weight: bolder; font-size: 15px; margin-left: 1%;">Código da Venda:</label>
    <?php 
        date_default_timezone_set('America/Sao_Paulo');
        $ano = date('Y');
        $mes = date('m');
        $dia = date('d');
        $countVendasDia = count($venda->selectAllVenda());
        $codigo_gerado_venda = $ano.$mes.$dia.$countVendasDia; /* GERANDO CODIGO DA VENDA */
        
    ?>
        <input id="codigoVenda" name="codigoVenda" value=" <?php echo $codigo_gerado_venda; ?>" 
        style="color: blue; text-align: center; font-size: 15pt; border: none; display: inline; margin-top: -10%;" size="10" ></input>
</div>

    <div id="itensAdicionados">

    <section id="principalVendas">
    <legend style="margin-left: -1%">REALIZAR VENDA/ORÇAMENTO</legend>

<div class="scroll">

    <table>
        <tr>
            <table class="table table-hover">
                <th> CODIGO PRODUTO </th>
                <th> DESCRIÇÃO DO PRODUTO </th>
                <th> LABORATÓRIO </th>
                <th> PREÇO UNID</th>
                <th> QTD </th>
                <th> R$ TOTAL </th>
                <th> AÇÃO </th>                       
        </tr>
    <?php  
                                        // ADIDIONANDO ITENS AO CARRINHO DE COMPRAS //

        session_start(); // trabalhar com informaçoes persistentes, sem perder os dados ao trocar de pagina ou arquivo //

        if (isset($_GET['id_produto_up_venda']) && !empty(['id_produto_up_venda']))
        { 
            $id_Produto = (int) $_GET['id_produto_up_venda'];

            echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>';

            if (!isset($_SESSION['itens'][$id_Produto])) 
            {             
                    $_SESSION['itens'][$id_Produto] = 1; // criar $_SESSION com valor 1, caso não exista ainda
                
            } else {

                    $_SESSION['itens'][$id_Produto] += 1; // se a $_SESSION já existe é somado 1 ao seu valor que representa sua quantidade
            } 
        }   
                                // EXIBINDO DADOS DOS ITENS NO CARRINHO DE COMPRAS //

        if (isset($_SESSION['itens'])) {

            if (count($_SESSION['itens']) == 0) {

                global $verificaSecao;
                $verificaSecao = true;
               
            } else {
                foreach ($_SESSION['itens'] as $protutos => $quantidade)
                {
                    $idItem = (int) $protutos;
                   
                    $dados = $produto->selectProduto($idItem); 
                        echo '<tr>
                                <td>'.$dados['id_produto'].'</td>'
                                    .'<td>'.$dados['nome_produto'].'</td>'
                                        .'<td>'.$dados['produto_fornecedor'].'</td>'
                                            .'<td>'.$valor = $dados["preco_venda"].'</td>'.'<td>'
                                                .$quantidade.'</td>'
                                                    .'<td>'.$quantidade = $dados["preco_venda"].'</td>' 
    ?> 
        <td><a id="removeProdutoVenda" href="Vendas.php?removeProdutoVenda=<?php echo $dados['id_produto'];?>"> X </a></td> 
    <?php
                    echo '</tr>';                                      
                }
            }
        }
                                        // EXCLUINDO OS ITENS DO CARRINHO DE COMPRAS //

            if (isset($_GET['removeProdutoVenda'])) 
            {
                $id_remove_produto = (int) $_GET['removeProdutoVenda'];

                unset($_SESSION['itens'][$id_remove_produto]);
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>'; // REFRESH para atualizar a página
            }

                                     // LIMPAR DAOS VARIAVIIS E CARRINHO AO FECHAR OU CANCELAR  VENDA 

            if (isset($_POST['cancelarVenda']) && isset($_SESSION['itens'])) {
                
                session_destroy(); // encerrar a seção e destroi as variaves existentes nela
                echo '<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=Vendas.php"/>'; // REFRESH para atualizar a página
            }
    ?>                      
       </table>
    </div>
</div>

    <div id="adicionaPrudutoVenda" style="padding: 10px;" >
                <a id="adicionar-produto" href="ConsultaProdutos.php?buscaProdutos=+"><img src="/img/search.png">Adcionar Produto</a>
    </div>

        <div id="divDataHoraVenda">   
            <label>Data:</label>
            <input id="dataVenda" name="dataVenda" value="<?php date_default_timezone_set('America/Sao_Paulo');
                echo date('d/m/Y'); ?>" 
                    style="color: blue; text-align: center; font-size: 20pt; border: none; display: inline;" 
                    size="10" ></input>
        </div>
            <div id="divPagamentoTipo">           
                <label id="labelTipoPagamento"> Tipo de Pagamento:</label>    
                <select id="tipoPagamento" name="tipoPagamento" class="form-control"> 
                    <option value="" selected> </option> 
                    <option value="a vista" >À Vista</option>
                    <option value="debito">Débito</option>
                    <option value="credito">Crédito</option>
                </select>
            </div><br>
    <div id="divDabosVenda" style="width: 30%; float: right; margin-right: 0.5%; height: 540px; font-size: 13pt;">
    <legend style="border: solid 1px #8b0210; background-color: #8b0211; color: white;">DADOS DA VENDA</legend><br>
        
                    <!-- ==================== BUSCAR VENDEDOR =====================-->

        <div id="vendedorSelecionado">      
                <label id="labelVendedorSelecionado">Vendedor:</label>
                                <select id="vendedor" name="vendedor" class="form-control" style="display: inline; margin-left: 8%;">
                                    <option value=""  > Não Informado </option>
                                        <?php $dados = $pessoa->selectAllPessoaFuncionarioVendedor();
                                            if(count($dados) > 0)
                                            {
                                                for ($i=0; $i < count($dados) ; $i++) 
                                                { 
                                                    foreach ($dados[$i] as $key => $value) 
                                                    {
                                                        if ($key == "id_pessoa" ) // IMPRIMIR VALOR SOMENTE SE...
                                                        {
                                                            ?> 
                                                                <option value="<?php echo  $value; ?>" required> 
                                                                    <?php 
                                                        }
                                                    }
                                                    foreach ($dados[$i] as $key => $value) 
                                                    {
                                                        if ($key == "nome" ) // IMPRIMIR VALOR SOMENTE SE...
                                                        {
                                                            ?> 
                                                                    <?php echo  $value; ?> </option> <?php
                                                        }
                                                    }
                                                }
                                            } 
                                        ?> 
                            </select><br/><br/><br/><br>

                           <!-- =========================== BUSCAR CLIENTE ===============================-->

        <label for="idClienteVenda" st>ID Cliente:</label>
            <input id="idClienteVenda" type="text" name="idClienteVenda" class="form-control" size="5" style="margin-right: 54%;"
                value="<?php if (isset($_GET['id_cliente_up_venda']) && !empty(['id_cliente_up_venda'])) 
                {
                        $id_cliente_get_up = addslashes($_GET['id_cliente_up_venda']); 
                            $retornoConsulta = $pessoa->selectPessoaCliente($id_cliente_get_up); 
                                if(isset($retornoConsulta)){echo $retornoConsulta[0]['id_pessoa'];
                    }
                } 
                    ?>"><br><br>
          
            <label id="labelNomeCliente">Nome:</label>
            <input id="nomeCliente" type="search" class="form-control" name="nomeCliente" autofocus size="30" style="margin-right: 11%;"
                value="<?php if (isset($_GET['id_cliente_up_venda']) && 'id_cliente_up_venda' !== NULL) 
                {
                        $id_cliente_get_up = addslashes($_GET['id_cliente_up_venda']); 
                            $retornoConsulta = $pessoa->selectPessoaCliente($id_cliente_get_up); 
                                if(isset($retornoConsulta)){echo $retornoConsulta[0]['nome'];
                    }
                } 
                    ?>"><br><br>

            <label id="labelCpf">CPF:</label>
            <input id="cpfCliente" type="text" name="cpfCliente" class="form-control" size="16" style="margin-right: 35%;"
                value="<?php if (isset($_GET['id_cliente_up_venda']) && !empty(['id_cliente_up_venda'])) 
                {
                        $id_cliente_get_up = addslashes($_GET['id_cliente_up_venda']); 
                            $retornoConsulta = $pessoa->selectPessoaCliente($id_cliente_get_up); 
                                if(isset($retornoConsulta)){echo $retornoConsulta[0]['cpf_cnpj'];
                    }
                }
                    ?>"><br><br>

                <div id="adicionaClienteVenda">
                        <a href="ConsultaClientes.php?buscaCliente=+"><img src="/img/search.png">Buscar Cliente</a>
                </div><br><br>  
                
            <label id="total" for="totalSemDesconto"> Total: R$</label>
            <input id="totalSemDesconto" name="totalSemDesconto" class="form-control" size="10"> <br><br> 
            <label id="desconto" for="desconto"> Desconto: R$</label>
            <input id="desconto" type="text" name="desconto" class="form-control" size="10" placeholder="%"><br><br>
            <label for="totalComDesconto" id="totalComDesconto">Total com Desconto: R$</label>

            <input id="totalComDesconto" name="totalComDesconto" class="form-control"  size="10" value=""><br><br><br> 

                    <!--======================== FUNCAO JAVASCRIPT COMFIRMAÇÃO ALERT ==============================-->

                        <script language=javascript>
                            
                            function confirmacao(){
                                if (confirm("Venda não finalizada, Deseja cancelar essa venda??"))
                                    alert("Venda cancelada com sucesso!.");
                                }
                        </script>

                    <!-- ======================================================================================== -->

            <button class="btn btn-outline-danger" id="btnFecharVenda" name="fecharVenda" onclick="" style="display: inline;">Fechar Venda</button>
            <button class="btn btn-outline-danger" id="btnCncelarVenda" name="cancelarVenda" onclick=" return confirmacao();" style="display: inline; margin-left: 10%;">Cancelar</button>
        </div>
    </div>
</div>
    </form>
    </section>
</body>

</html>