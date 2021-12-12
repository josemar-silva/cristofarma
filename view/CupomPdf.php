<?php
    // referenciar o DomPDF com namespace
    require_once '../model/Conexao.php';
    require_once '../vendor/autoload.php';
    require_once '../model/Pessoa.php';
    require_once '../model/Venda.php';
    require_once '../model/Produto.php';
    require_once '../model/ItemVenda.php';
    require_once '../model/Cupom.php';

    $produto = new Produto();
    $itemVenda = new ItemVenda();
    $pessoa = new Pessoa();
    $venda = new Venda();
    $estoque = new Estoque();
    $cupom = new Cupom();
    $conexao = new Conexao();

    $id_venda = $_GET['id_venda_cupom'];
  
    $venda_cupom = $venda->selectVendaId($_GET['id_venda_cupom']);
    $codigo_venda_cupom = $venda_cupom[0]['codigo_venda'];
    $produto_item_venda = $itemVenda->selectItemVendaLikeId($venda_cupom[0]['id_venda']);
       
    $cupom_venda_cupom = $cupom->selecCupomByIdVenda($id_venda);
    $data_venda_cupom = $venda_cupom[0]['data_venda'];

    $cabecalho ='<h2 style="text-align: center;"> CUPOM FISCAL </h2>
    <h4 style="text-align: center; margin-top: -15px"> DROGARIA CRISTOFARMA PLUS</h4>
    <h6 style="text-align: center; margin-top: -15px"> Drogaria Cristofarma Plus Comercial de Medicamentos - EIRELI / CNPJ: 27.922.519/0001-83 </h6>
    <h6 style="text-align: center; margin-top: -20px;"> Tele-Entregas: (62) 3242-7373 / (62) 99279-1340  /  (62) 98437-1551 </h6>
    <h6 style="text-align: center; margin-top: -20px; border-bottom: dashed 1px black;"> Endereço: Rua Jassitata Quadra: 07 Lote 31 Sala 05 
      Bairro Cardoso I <br> Aparecida de Goiânia - GO, 74933-211<br><br></h6>';

    $html = '';
    $id_venda_html = '<h5 style="margin-top: -15px"> VENDA Nº '.$codigo_venda_cupom.'<span style="float: right;">DATA VENDA: '.$data_venda_cupom.'</span>'.'</h5>';

    $resumo_venda_html = '<div id="resumo_venda"><h6 style=" text-align: right; margin-right: 4%">'.'<div style="float: left;"> PAGAMENTO: '.$venda_cupom[0]['tipo_pagamento'].'</div>'.
                            '<div> TOTAL ITENS: '.$venda_cupom[0]['total_item_venda'].'</div>'.
                            '<div style="float: left; margin-left: -24%"> CLIENTE: '.$cupom_venda_cupom[0]['cliente'].'</div>'.
                              '<div>TOTAL VENDA: R$ '.$venda_cupom[0]['valor_venda_sem_desconto'].'</div>'.
                                '<div> DESCONTO: R$ '.$venda_cupom[0]['desconto'].'</div>'.
                                  '<div> TOTAL A PAGAR: R$ '.$venda_cupom[0]['valor_venda_com_desconto'].'</div>'.'<br>'.
                                    '<div> VALOR RECEBIDO: R$ '.$cupom_venda_cupom[0]['valor_recebido'].'</div>'.
                                      '<div> TROCO: R$ '.$cupom_venda_cupom[0]['troco'].'</div>'.'</h6></div>';                  

    for ($i = 0; $i < count($produto_item_venda); $i++) 
    {
        $produto_descricao_cupom = $produto->selectProduto($produto_item_venda[$i]['produto_id_produto']);

        $html .= '<div id="detalhamento_venda">'.'<div style=" font-size: 12px; width: 3%; text-align: right; display: inline-block; margin-left: 0%;">'.$produto_item_venda[$i]['produto_id_produto'].'</div>'.
                    '<div style="font-size: 12px; display: inline-block; margin-left: 5%; width: 50%; ">'.$produto_descricao_cupom['nome_produto'].'</div>'.
                        '<div style=" font-size: 12px; width: 10%; text-align: right; display: inline-block; margin-left: 5%;">'.$produto_descricao_cupom['preco_venda'].'</div>'.
                            '<div style="font-size: 12px; width: 5%; text-align: right; display: inline-block; margin-left: 5%;">'.$produto_item_venda[$i]['quantidade_item'].'x'.'</div>'.
                              '<div style=" font-size: 12px; width: 10%; text-align: right; display: inline-block; margin-left: 3%;">'.$produto_item_venda[$i]['valor_total_item'].'</div >'.'</div>';
    }

        // carregar o DomPDF
    use Dompdf\Dompdf;

    $donpdf = new Dompdf();
    
        // carregar o HTML
        $donpdf->loadHtml(''.$cabecalho.''.$id_venda_html.''.$html.''.$resumo_venda_html.'');

        // definir tamanho do papel (A4, A3, A2...) e modo paisagem (landscape) ou retrato (portrait)
        $donpdf->setPaper('A5', 'portrait');

    //renderizar o HTML
    $donpdf->render();

    //exibir a pagina ("Attachment" => true) ou baixar direto o arquivo PDF ("Attachment" => false)
    $donpdf->stream("cupom.pdf", ["Attachment" => 0]);
?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="../css/bootstrap/formularios/bootstrap.css">

  <title> Cupom Fiscal </title>
</head>

<body>
  <header>

  </header>
          <section>

          </section>
</body>
    </html>
<footer>

</footer>