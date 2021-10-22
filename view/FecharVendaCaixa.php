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
            <li><a href="CupomFiscal.php">CUPOM FISCAL</a></li>
            <li><a href="#">RELATÓRIOS</a>
                <ul>
                    <li><a href="RelatorioVendas.php">Relatório de Vendas</a></li>
                    <li><a href="RelatorioEstoque.php">Relatório Geral de Estoque</a></li>                                        
                </ul>
        </ul>
    </nav>

    </header>
    <section id="principalCaaixa">

    <div id="vendaDetalhada">
        <legend style="border: red 1px solid; width: 90%;">VENDA Nº</legend>

        <div id="divSair" style="width: 2%; border: red 1px solid; height:30px; float: right; margin-top: -2.5%; margin-right: 2%;" >
        <a href="index.php" style="">Sair</a>
    </div>

     <div class="scroll">
        <table>            
            <?php
                    require_once 'Produto.php';
                    require_once 'PrudutoVenda.php';
                    require_once 'Pessoa.php';
                    require_once 'Venda.php';
                    require_once 'Estoque.php';

                    $produto = new Produto();
                    $produtoVenda = new ProdutoVenda();
                    $pessoa = new Pessoa();
                    $venda = new Venda();
                    $estoque = new Estoque();

       
        
                ?>
        </table>
     </div>
    </div>  

        <form id="fecharVendaCaixa" name="fecharVenda">
            <legend>FINALIZAR VENDA</legend>

            <label>Total da Venda: </label><br>
            <input id="valorVenda" class="form-control" name="valorDaVenda" size="6" placeholder="R$"><br><br><br>

            <label>Total a Pagar:</label><br>
            <input id="valorPagar" class="form-control" name="totalApagar" size="6" placeholder="R$" placeholder="R$"><br><br><br>

            <label>Valor Recebido:</label><br>
            <input id="valorRecebido" class="form-control" name="valorRecebido" type="text" size="6" placeholder="R$"><br><br><br>

            <label>Troco:</label><br>
            <input id="troco" class="form-control" name="troco" size="6" placeholder="R$"><br><br>

            <button class="btn btn-outline-danger" id="btnCancelar" name="cancelar" onclick="" style="display: inline; margin-left: 20%;">Cancelar</button>
            <button class="btn btn-outline-danger" id="btnFinalizar" name="finalizar" onclick="" style="display: inline;">Finalizar</button>
        </form>
       
    </section>
</body>

</html>