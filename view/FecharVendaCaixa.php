<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">

    <title>Caixa</title>
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
    <section id="principalCaaixa">

    <div id="vendaDetalhada">
        

    <div id="divSair"  >
        <a href="index.php">Sair</a>
    </div>

    <div id="divDetalharVenda">

    <?php
            require_once '../model/Produto.php';
            require_once '../model/PrudutoVenda.php';
            require_once '../model/Pessoa.php';
            require_once '../model/Venda.php';
            require_once '../model/Estoque.php';

            $produto = new Produto();
            $produtoVenda = new ProdutoVenda();
            $pessoa = new Pessoa();
            $venda = new Venda();
            $estoque = new Estoque();

            if (isset($_GET['id_get_venda_up'])) {
                $idVenda = $_GET['id_get_venda_up'];
                
                $return = $venda->selectVendaAbertaLikeId($idVenda);
                $res = $return[0]['id_venda'];
            }

         ?>

    <legend><br>VENDA Nº  <input id="saidaIdVendaFecharCaixa" size="8" value="<?php echo $res;?>" 
            style="color: blue; text-align: center; margin-top: -20%; border: none; text-decoration: none;" disabled></legend>

     <div class="scroll">
            <div  id="descricaoVendaCaixa">
                                
                <p id="descItens"> adfasfsadsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fadfasfsadsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fsadfasfsadsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fsfasfsadsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fsadfafgfsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fsadfasfsadsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fsadfasfsadsafsdfasdfadadsafsdfasdfad.</p>
                <p id="descItens"> fsadfasfsfssafsdfasdfadadsafsdfasdfad.</p>


                <p id="descPagamento"> .ffsdfsdsafsdfasdfadfsdafasdfsadfsadf</p>

                <p id="descVendedor"> fsdfsdafsdafdsafsdfasdfadfsadfasdfsda</p>

                <p id="descCliente"> fsdafsdfsdafsadfsdfasdfadfasdfasdfasdf</p> 

           </div>
     </div>
    </div>

    <?php 
        
        
    ?>
    
        <form id="fecharVendaCaixa" name="fecharVenda" action="" method="POST"> 
            <legend style="margin-bottom: 10%; font-size: 25pt; font-weight: bolder; color: blue;">FINALIZAR VENDA</legend>

            <label>Total a Pagar:</label><br>
            <input id="valorPagar" class="form-control" name="totalApagar" size="6" placeholder="R$" placeholder="R$" 
                value="<?php if(isset($return)){echo $return[0]['valor_venda_com_desconto'];}?>" ><br><br><br>

            <label>Valor Recebido:</label><br>
            <input id="valorRecebido" class="form-control" name="valorRecebido" type="text" size="6" placeholder="R$" 
                value="<?php                 
                            if (isset($_POST['valorRecebido'])) 
                            { 
                                $valorDigitado = filter_input(INPUT_POST, 'valorRecebido'); 

                                echo number_format($valorDigitado, 2, ',','.');
  
                                $valorVenda = (float) addslashes($_POST['totalApagar']);

                                $valorRecebido = (float) addslashes($_POST['valorRecebido']);

                                $troco = calculaTroco($valorVenda, $valorRecebido);
                            } 
                                                    
            function calculaTroco($valorVenda, $valorRecebido)
            {
                $troco = $valorRecebido - $valorVenda;
                                
                return $troco;
            }
                    ?>"><br><br><br>

            <label>Troco:</label><br>
            <input id="troco" class="form-control" name="troco" size="6" placeholder="R$" 
                value="<?php if (isset($valorDigitado)) {
                    echo number_format($troco, 2, ',','.');
                }?>" disabled><br><br>

            <button class="btn btn-outline-danger" id="btnFinalizar" name="finalizar" onclick="" style="display: inline; margin-left: 8%; margin-top: 15%;">Finalizar</button>
            <button class="btn btn-outline-danger" id="btnCancelar" name="cancelar" onclick=""  style="display: inline; margin-left: 18%; margin-top: 15%;">Cancelar</button>
        </form>
    </div>
    </section>
</body>

</html>