<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Caixa</title>
</head>

<body>
    <header>

    </header>
    <section id="menu">
        <p><a href="index.php">HOME</a></p>
        <p><a href="Vendas.php">VENDAS</a></p>
        <p><a href="Caixa.php">CAIXA</a></p>
        <p><a href="Produtos.php">PRODUTOS</a></p>
        <p><a href="Fornecedores.php">FORNECEDOR</a></p>
        <p><a href="Clientes.php">CLIENTES</a></p>
        <p><a href="Usuarios.php">USUÁRIOS</a></p>
        <p><a href="NotaFiscal.php">NOTA FISCAL</a></p>
        <p><a href="Relatorios.php">RELATÓRIO</a></p>
    </section>
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