<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <title>Caixa</title>
</head>

<body>
    <header>
    <ul class="nav nav-tabs">
 
            <li class="nav-item">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Pesquisar.php">PESQUISAR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Vendas.php">VENDAS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Caixa.php">CAIXA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="CadastrarProdutos.php">PRODUTOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Cadastros.php">CADASTROS</a>
            </li>   
            <li class="nav-item">
                <a class="nav-link" href="NotaFiscal.php">NOTA FISCAL</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Relatorios.php">RELATÓRIOS</a>
            </li>
    </ul>
    </header>
    <section id="principal">
        <legend>VENDAS A RECEBER</legend><br>
        <fieldset id="fecharVenda" name="fecharVenda">
            <legend>FINALIZAR VENDA</legend>

            <p>Total da Venda: </p>

            <output id="valorVenda" name="valorDaVenda"></output>

            <p>Desconto: </p>

            <output id="valorDesconto" name="ValorDoDesconto"></output>

            <p>Total a Pagar:</p>

            <output id="valorPagar"></output>

            <p>Valor Recebido:</p>

            <input id="valorRecebido" name="valorRecebido" type="text" size="6" placeholder="R$"><br>

            <h4>Troco: R$</h4><br>

            <button id="btnCancelar" name="cancelar" onclick="window.location.href='Caixa.html'">Cancelar</button>
            <button id="btnFinalizar" name="finalizar">Finalizar</button>
        </fieldset>
    </section>
</body>

</html>