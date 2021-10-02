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
    <section id="principal" style="margin-left: 5%;">

        <for id="fecharVenda" name="fecharVenda">
            <legend>FINALIZAR VENDA</legend>

            <p>Total da Venda: </p>

            <input id="valorVenda" name="valorDaVenda" size="10"></input>

            <p>Desconto: </p>

            <input id="valorDesconto" name="ValorDoDesconto" size="10"></input>

            <p>Total a Pagar:</p>

            <input id="valorPagar" size="10"></input>

            <p>Valor Recebido:</p>

            <input id="valorRecebido" name="valorRecebido" type="text" size="10" placeholder="R$"><br>

            <h4>Troco: R$</h4><br>

            <button class="btn btn-outline-danger" id="btnCancelar" name="cancelar" >Cancelar</button>
            <button class="btn btn-outline-danger" id="btnFinalizar" name="finalizar">Finalizar</button>
        </form>
    </section>
</body>

</html>