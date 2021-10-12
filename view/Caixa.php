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
            <li><a href="NotaFiscal.php">NOTA FISCAL</a></li>
            <li><a href="Relatorios.php">RELATÓRIOS</a></li>
        </ul>
    </nav>
    <div id="divSair" style="width: 100%; border: blueviolet 1px solid; height:3    0px;">
        <a href="index.php" style="float: right; margin-right: 20px;">Sair</a>
    </div>

    </header>
    <section id="principalCaaixa">

    <div id="listaVendas">

    </div>  

        <form id="fecharVenda" name="fecharVenda">
            <legend>FINALIZAR VENDA</legend><br><br>

            <label>Total da Venda R$: </label>
            <input id="valorVenda" class="form-control" name="valorDaVenda" size="6">

            <label>Desconto R$: </label>
            <input id="valorDesconto" class="form-control" name="ValorDoDesconto" size="6">

            <label>Total a Pagar R$:</label>
            <input id="valorPagar" class="form-control" name="totalApagar" size="6">

            <label>Valor Recebido R$:</label>
            <input id="valorRecebido" class="form-control" name="valorRecebido" type="text" size="6" placeholder="R$">

            <label>Troco R$:</label>
            <input id="troco" class="form-control" name="troco" size="6">

            <button class="btn btn-outline-danger" id="btnCancelar" name="cancelar" >Cancelar</button>
            <button class="btn btn-outline-danger" id="btnFinalizar" name="finalizar">Finalizar</button>
        </form>
       
    </section>
</body>

</html>