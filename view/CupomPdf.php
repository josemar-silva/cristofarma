<?php

// referenciar o DomPDF com namespace
require_once '../vendor/autoload.php';

// carregar o DomPDF
use Dompdf\Dompdf;

$donpdf = new Dompdf();

<<<<<<< HEAD
    // carregar o HTML
    $donpdf->loadHtml('<p id="cabecalho" font-size: 8px> DROGARIA CRISTOFARMA PLUS</p>
                       <p> Tele-Entregas: (62) 3242-7373 / (62) 99279-1340  / WhatsApp: (62) 98437-1551 </p>
                       <p> Rua Jassitata, Quadra: 07 Lote 31 Sala 05 - Bairro Cardoso I, Aparecida de Goiânia - GO </p>');

    // definir tamanho do papel (A4, A3, A2...) e modo paidagem (lasdscape) ou retrato (portrait)
    $donpdf->setPaper('A5', 'lasdscape');
=======
// carregar o HTML
$donpdf->loadHtml('<p id="cabecalho" font-size: 8px> DROGARIA CRISTOFARMA PLUS</p>
                        <p> Tele-Entregas: (62) 3242-7373 / (62) 99279-1340  / WhatsApp: (62) 98437-1551 </p>
                        <p> Rua Jassitata, Quadra: 07 Lote 31 Sala 05 - Bairro Cardoso I, Aparecida de Goiânia - GO </p>');

// definir tamanho do papel (A4, A3, A2...) e modo paidagem (lasdscape) ou retrato (portrait)
$donpdf->setPaper('A7', 'lasdscape');
>>>>>>> aeeee11cc7aea39362bb1ad2c340d0b838dacab7

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