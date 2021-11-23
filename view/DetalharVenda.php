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
    <a href="../index.php">Sair</a>
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

      <legend style="color: white; float: left; font-size: 13pt; margin-top: -2%; color: blue;"> VENDA Nº <input id="saidaIdVendaFecharCaixa" size="8" value="<?php echo $codigo_venda_return; ?>" style=" color: red; text-align: center; margin-top: -30%; border: none; 
           text-decoration: none; font-size: 15pt;" disabled>

        <!-- CABEÇALHO CUPOM VENDA -->
        <div style="height: 46em; width: 75%; margin-left: auto; margin-right: auto; background-color: #191970;">
          <div id="descricaoVendaCaixa" class="scroll" style="width: 100%; height: 42em; margin-left: auto; margin-right: auto; ">
            <?php
            // DETALHAR VENDA SELECIONADA

            if (isset($vendaReturn) && !empty($vendaReturn)) {

              $itemVendaReturn = $itemVenda->selectItemVendaLikeId($id_venda);

            ?><br>
              <table style="width: 96%; text-align: right; color: white; margin-top: -2%; margin-left: 2%;">
              <?php

              echo '<tr>';
              echo '<th style="text-align: left; background-color: #8b0210; color: yellow; border: solid 1px #8b0210; "> CÓDIGO </th>';
              echo '<th  style="text-align: left; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> DESCRIÇÃO DO PRODUTO</th>';
              echo '<th  style="text-align: right; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> VALOR UNID </th>';
              echo '<th style="text-align: right; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> QTD </th>';
              echo '<th style="text-align: right; background-color: #8b0210; color: yellow; border: solid 1px 8b0210;"> VALOR TOTAL';
              echo '</th>';

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
              }
            }
              ?>
              </table>

          </div>

          <div id="resumoVenda" style=" color: white; font-size: 15pt; font-family: Arial, Helvetica, sans-serif; float: right; 
    margin-right: 3%; margin-top: 1%;">

            <?php
            if (isset($vendaReturn) && !empty($vendaReturn)) {
              echo 'Total Itens:&nbsp;' . $total_item_venda_return . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
              echo 'Valor sem Desconto: R$ &nbsp;' . $vendaReturn[0]['valor_venda_sem_desconto'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
              echo 'Desconto: R$ &nbsp;' . $vendaReturn[0]['desconto'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
              echo 'Total a Pagar: R$ &nbsp;' . $valor_venda_return;
            }
            ?>

          </div>
        </div>
    </form>
  </section>

  <?php
  $status = $vendaReturn[0]['status_venda'];

  if ($status == 'fechado') {
  ?>
    <a class="btn btn-outline-danger" id="btnGerarNotaFiscal" name="gerarCumpom" href="CupomPdf.php?id_venda_cupom=<?php echo $id_venda; ?>" target="_blank" style="margin-left: 45%; margin-top: 0%; color: white;">Emitir Cupom Fiscal</a>
  <?php
  }
  ?>
</body>

</html>