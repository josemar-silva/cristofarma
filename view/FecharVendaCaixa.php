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


            <div id="divSair">
                <a href="FecharVendaCaixa.php?sair=<?php echo 1;?>">Sair</a>
            </div>

            <div id="divDetalharVenda" style="background-color: #191970; border: none;">

                <?php
                require_once '../model/Produto.php';
                require_once '../model/Venda.php';
                require_once '../model/Cupom.php';


                $produto = new Produto();
                $itemVenda = new ItemVenda();
                $pessoa = new Pessoa();
                $venda = new Venda();
                $estoque = new Estoque();
                $cupom = new Cupom();

                $usuarioLogado = $pessoa->login();

                // BUSCAR TODAS AS VENDAS COM STATUS ABERTO

                if (isset($_GET['id_get_venda_up'])) {
                    $codigo_venda = $_GET['id_get_venda_up'];

                    $ListVendaReturn = $venda->selectVendaAbertaLikeId($codigo_venda);

                    $id_venda = $ListVendaReturn[0]['id_venda'];

                    $codigo_venda_return = $ListVendaReturn[0]['codigo_venda'];
                    $valor_venda_return = $ListVendaReturn[0]['valor_venda_com_desconto'];
                    $total_item_venda_return = $ListVendaReturn[0]['total_item_venda'];
                }
                ?>

                <legend style="color: white; font-weight: bold; margin-top: 1%;"> VENDA Nº <input id="saidaIdVendaFecharCaixa" size="8" value="<?php echo $codigo_venda_return; ?>" style="background-color: #191970; color: yellow ; text-align: center; margin-top: -30%; border: none; 
            text-decoration: none; font-weight: bold; font-size: 15pt;"><br>

                    <div>
                        <div id="descricaoVendaCaixa" class="scroll">
                            <?php
                            // DETALHAR VENDA SELECIONADA

                            if (isset($ListVendaReturn) && !empty($ListVendaReturn)) {

                                $itemVendaReturn = $itemVenda->selectItemVendaLikeId($id_venda);

                                $complemento = 0;
                            ?><br>
                                <table style="width: 95%; text-align: right; color: white; margin-top: -2%; margin-left: 2%; font-weight: normal; font-family: Times New 'Times New Roman', Times, serif" >
                                <?php
                                for ($i = 0; $i < count($itemVendaReturn); $i++) {
                                    echo "<tr>";

                                    foreach ($itemVendaReturn[$i] as $key => $value) {
                                        if ($key == "produto_id_produto") // ignorar coluna
                                        {
                                            $dados = $produto->selectProduto($value);
                                            echo "<td style='text-align: left;'>" . $complemento . $dados['id_produto'] . "</td>";

                                            echo "<td style='text-align: left;'>" . $dados['nome_produto'] . "</td>";
                                        }
                                    }
                                    foreach ($itemVendaReturn[$i] as $key => $value) {
                                        if ($key == "valor_total_item") // ignorar coluna
                                        {
                                            echo "<td>" . $dados['preco_venda'] . "</td>";
                                        }
                                    }

                                    foreach ($itemVendaReturn[$i] as $key => $value) {
                                        if ($key == "quantidade_item") // ignorar coluna
                                        {
                                            echo "<td>" . $value . '&nbsp unid' . "</td>";
                                        }
                                    }

                                    foreach ($itemVendaReturn[$i] as $key => $value) {
                                        if ($key == "valor_total_item") // ignorar coluna
                                        {
                                            echo "<td>" . $value . "</td>";
                                            echo "<td>" . "</td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                            }
                                ?>
                                </table>

                        </div>

                        <div id="resumoVenda" style=" color: white; font-size: 18pt; font-family: Arial, Helvetica, sans-serif; float: right; margin-right: 3%; margin-top: 1.5%;">

                            <?php
                            if (isset($ListVendaReturn) && !empty($ListVendaReturn)) {
                                echo 'Total Itens:&nbsp;' . $total_item_venda_return . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                                echo 'Valor Total: R$ &nbsp;' . $valor_venda_return;
                            }
                            ?>

                        </div>
                    </div>
            </div>
            <?php

            if (isset($_POST['valorRecebido'])) {

                $valorDigitado = filter_input(INPUT_POST, 'valorRecebido');

                $valorVenda = (float) addslashes($_POST['totalApagar']);
                $valorRecebido = (float) $valorDigitado;

                $troco = $venda->calculoFecharVendaCaixa($valorRecebido, $valorVenda);

                $_SESSION['valorRecebido']['valorDigitado'] = $valorRecebido;
                $_SESSION['totalApagar']['valorDigitado'] = $valorVenda;
                $_SESSION['troco']['valorDigitado'] = $troco;
            }

            ?>

        <form id="fecharVendaCaixa" name="fecharVenda" action="" method="POST">       
        
                <legend style="margin-bottom: 10%; font-size: 25pt; font-weight: bolder; color: blue;">FINALIZAR VENDA</legend>

                <label>Total a Pagar:</label><br>
                <input id="valorPagar" class="form-control" name="totalApagar" size="6" placeholder="R$" placeholder="R$" value="<?php if (isset($ListVendaReturn)) {
                                                                                                                                        echo number_format($valor_venda_return, 2, '.', '.');
                                                                                                                                    } ?>"><br><br><br>

                <label>Valor Recebido:</label><br>
                <input id="valorRecebido" class="form-control" name="valorRecebido" type="text" size="6" placeholder="R$" value="<?php
                                                                                                                                    if (isset($_SESSION['valorRecebido']['valorDigitado'])) {
                                                                                                                                        echo number_format($_SESSION['valorRecebido']['valorDigitado'], 2, '.', '.');
                                                                                                                                    }
                                                                                                                                    ?>"><br><br><br>

                <label>Troco:</label><br>
                <input id="troco" class="form-control" name="troco" size="6" placeholder="R$" value="<?php if (isset($_SESSION['valorRecebido']['valorDigitado'])) {
                                                                                                            echo number_format($_SESSION['troco']['valorDigitado'], 2, '.', '.');
                                                                                                        } ?>" disabled><br><br>
            
            <!-- <button type="submit"  class="btn btn-outline-danger" id="receber" name="receber" onclick="" style="display: inline; margin-left: 30%; margin-top: 20%; font-size: 22pt;">Receber</button> -->
            <input type="submit" class="btn btn-outline-danger" id="receber" name="receber" onclick="" style="display: inline; margin-right: 20%; color: white; margin-top: 20%; font-size: 22pt;" 
                value="<?php if (isset($_SESSION['valorRecebido']['valorDigitado'])) { echo 'Receber Venda';} else { echo 'Calcular Troco';}?>"> 
                
        </form>
            <?php
            if (isset($_POST['receber'])) {

                $receber = filter_input(INPUT_POST, 'receber'); 
            }

            // CONFIRMAR RECEBIMENTO E MUDAR STATUS VENDA PARA "FECHADO" / GERAR RECIBO

            if (isset($receber) && $receber == 'Receber Venda') {
                if ($valorRecebido >= $valorVenda) {

                    $idVenda = $_GET['id_get_venda_up'];
                    $vendaRes = $venda->selectVendaAbertaLikeId($idVenda);

                    $codigoVenda = $vendaRes[0]['codigo_venda'];

                    $idCliente = $vendaRes[0]['pessoa_id_pessoa_cliente'];
                    $clienteReturn = $pessoa->selectPessoaCliente($idCliente);
                    $cliente_cupom = $clienteReturn[0]['nome'];

                    $cupom->createCupomFiscal($codigoVenda, $valorVenda, $valorRecebido, $troco, $cliente_cupom);
                    $venda->fecharVenda($codigoVenda);

                    unset($_SESSION['valorRecebido']);
                    unset($_SESSION['totalApagar']);
                    unset($_SESSION['troco']);

                    echo '<script> alert("Venda recebida com sucesso!")</script>';
                    echo '<META HTTP-EQUIV="REFRESH" CONTENT="2;URL=Caixa.php"/>'; // REFRESH para atualizar a página
                } else {

                    echo '<script> alert("Valor recebido é menor que o valor da venda! Verifique novamente!")</script>';
                }
            }
            ?>
        </div>
    </section>
</body>

</html>