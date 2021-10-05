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
    <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>

    </header>
    <section id="principalCaaixa">

    <div id="listaVendas">

    </div>  

        <form id="fecharVenda" name="fecharVenda">
            <legend>FINALIZAR VENDA</legend><br><br>

            <label>Total da Venda R$    : </label>
            <input id="valorVenda" name="valorDaVenda" size="6"></input><br>

            <label>Desconto R$: </label>
            <input id="valorDesconto" name="ValorDoDesconto" size="6"><br>

            <label>Total a Pagar R$:</label>
            <input id="valorPagar" size="6  "></input><br>

            <label>Valor Recebido R$:</label>
            <input id="valorRecebido" name="valorRecebido" type="text" size="6" placeholder="R$"><br><br><br>

            <label>Troco R$:</label>
            <input id="troco" size="6"><br>

            <button class="btn btn-outline-danger" id="btnCancelar" name="cancelar" >Cancelar</button>
            <button class="btn btn-outline-danger" id="btnFinalizar" name="finalizar">Finalizar</button>
        </form>
       
    </section>
</body>

</html>