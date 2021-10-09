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
            <li><a href="Pesquisar.php">PESQUISAR</a>
                <ul>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="#">Fornecedores</a></li>
                    <li><a href="#">Funcionários</a></li>
                    <li><a href="#">Produtos</a></li>                    
                </ul>
            </li>
            <li><a href="Vendas.php">VENDAS</a></li>
            <li><a href="Caixa.php">CAIXA</a></li>
            <li><a href="CadastrarProdutos.php">PRODUTOS</a>
                 <ul>
                    <li><a href="#">Estoque</a></li>                                        
                </ul>
            </li>
            <li><a href="Cadastros.php">CADASTROS</a></li>
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
        </ul>
    </nav>
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