<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <title>Detalhar Venda</title>
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
  <div id="divSair">
    <a href="DetalharVenda.php?sair=<?php echo 1;?>">Sair</a>
  </div>

  <section id="detalharVenda" style="height: 610px;; border: none;">
    <form id="detalharVenda" style="margin-left: 1%; margin-right: 1%;" action="" method="POST">

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

      if (isset($_GET['id_venda_up'])) {
        $id_venda = $_GET['id_venda_up'];

        $vendaReturn = $venda->selectVendaId($id_venda);

        $venda_id = $vendaReturn[0]['id_venda'];

        $codigo_venda_return = $vendaReturn[0]['codigo_venda'];
        $valor_venda_sem_desconto = $vendaReturn[0]['valor_venda_sem_desconto'];
        $valor_venda_return = $vendaReturn[0]['valor_venda_com_desconto'];
        $total_item_venda_return = $vendaReturn[0]['total_item_venda'];
      }
  ?><br>
                                                <!-- CANCELAR VENDA (ABERTA/FECHADA) E ESTORNA PRODUTOS AO ESTOQUE  -->
<?php 
      if (isset($_POST['cancelarVenda'])) {
        $venda->estornarVenda($id_venda);

        $item_venda_estorno = $itemVenda->selectAllItemVendaLikeId($venda_id);
        
        for ($i = 0; $i < count($item_venda_estorno); $i++) {

            $id_produto_estorno = $item_venda_estorno[$i]['produto_id_produto'];
            $qtd_produto_estorno = $item_venda_estorno[$i]['quantidade_item'];

            $estoque->estoqueAdicionar($id_produto_estorno, $qtd_produto_estorno);

        }
        
        echo '<script> alert("Venda cancelada/estornada com sucesso!")</script>';
      }
    ?> 

      <legend style="color: white; float: left; font-size: 12pt; margin-top: -2%; color: blue;"> VENDA Nº <input id="saidaIdVendaFecharCaixa" size="8" value="<?php echo $codigo_venda_return; ?>" style=" color: red; text-align: center; margin-top: -30%; border: none; 
           text-decoration: none; font-size: 13pt;" disabled>

        <!-- CABEÇALHO CUPOM VENDA -->
        <div style="height: 46em; width: 85%; margin-left: auto; margin-right: auto; background-color: #191970;">
          <div id="descricaoVendaCaixa" class="scroll" style="width: 100%; height: 42em; margin-left: auto; margin-right: auto; ">
            <?php
            // DETALHAR VENDA SELECIONADA

            if (isset($vendaReturn) && !empty($vendaReturn)) {

              $itemVendaReturn = $itemVenda->selectItemVendaLikeId($id_venda);

            ?><br>
              <table style="width: 96%; text-align: right; color: white; margin-top: -2%; margin-left: 2%;">
              <?php
          echo '<thead>';
              echo '<tr>';
              echo '<th style="text-align: left; background-color: #8b0210; color: yellow; border: solid 1px #8b0210; "> CÓDIGO </th>';
              echo '<th  style="text-align: left; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> DESCRIÇÃO DO PRODUTO</th>';
              echo '<th  style="text-align: right; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> VALOR UNID </th>';
              echo '<th style="text-align: right; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> QTD </th>';
              echo '<th style="text-align: right; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> VALOR TOTAL';
              echo '</th>';
          echo '</thead>';

          echo '<tbody>';
              for ($i = 0; $i < count($itemVendaReturn); $i++) {
                echo '<tr>';

                foreach ($itemVendaReturn[$i] as $key => $value) {
                  if ($key == "produto_id_produto") // ignorar coluna
                  {
                    $dados = $produto->selectProduto($value);
                    echo "<td style='text-align: left;'>" . $dados['id_produto'] . "</td>";

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
                echo '</tbody>';
              }
            }
              ?>
              </table>
          </div>

          <div id="resumoVenda">

          <?php
            if (isset($vendaReturn) && !empty($vendaReturn)) {
              echo '<span style=" color: white; font-size: 13pt; font-family: Arial, Helvetica, sans-serif; float: right; 
              margin-right: 3%; margin-top: 1%"> Total a Pagar: R$ &nbsp;' . $valor_venda_return.'</span>';

              echo '<span style=" color: white; font-size: 13pt; font-family: Arial, Helvetica, sans-serif; float: right; 
                margin-right: 3%;  margin-top: 1%"> Desconto: R$ &nbsp;' . $vendaReturn[0]['desconto'].'</span>';

              echo '<span style=" color: white; font-size: 13pt; font-family: Arial, Helvetica, sans-serif; float: right; 
                margin-right: 3%;  margin-top: 1%"> Valor sem Desconto: R$ &nbsp;' . $vendaReturn[0]['valor_venda_sem_desconto'].'</span>';

              echo '<span style=" color: white; font-size: 13pt; font-family: Arial, Helvetica, sans-serif; float: right; 
                margin-right: 3%;  margin-top: 1%"> Total Itens:&nbsp;'.$total_item_venda_return.'</span>';   
                
              echo '<span style=" color: yellow; font-size: 13pt; font-family: Arial, Helvetica, sans-serif; float: left ; 
                margin-left: 3%;  margin-top: 1%"> Situação:&nbsp;'.$vendaReturn[0]['status_venda'].'</span>';   
            }
          ?>
          </div>
        </div>

    <?php
        $status = $vendaReturn[0]['status_venda'];

    if ($status == 'fechado') {
    ?>
        <a class="btn btn-outline-danger" id="btnGerarNotaFiscal" name="gerarCumpom" href="CupomPdf.php?id_venda_cupom=<?php echo $id_venda; ?>" 
        target="_blank" style="margin-left: 3%; margin-right: 5%; margin-top: 1%; color: white;">Emitir Cupom Fiscal</a>
        <input class="btn btn-outline-danger" type="submit"  id="cancelarVenda" name="cancelarVenda" value="Cancelar Venda" onclick="" style="margin-top: 1%;">

    <?php

    } else {
    ?>
        <input class="btn btn-outline-danger" type="submit"  id="cancelarVenda" name="cancelarVenda" value="Estornar Venda" onclick="" style="margin-left: 7%; margin-right: 5%; margin-top: 1%;">

    <?php
    
    }
  ?>
    </form>
  </section>
</body>

</html>