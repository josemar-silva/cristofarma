<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Relatórios</title>
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
    <div id="divSair">
        <a href="../index.php">Sair</a>
    </div>

    </header>
    <section id="principalEstoque">
        <div id="relatorioGerencialVendas" style="margin-left: 5%;">
                <legend style="text-align: left;">RELATÓRIO GERAL DE ESTOQUE</legend><br>
            
            <input type="radio" id="estoque" name="tipoRelatorioEstoque" value="estoque" checked>&nbsp; &nbsp;
            <label for="estoque" style="font-size: 13pt;">Relatório de Estoque</label><br><br>

<form action="" method="POST">

            <?php 
                require_once '../model/ItemVenda.php';
                require_once '../model/Conexao.php';
                
                $itemVenda = new ItemVenda();

                if (isset($_POST['btnGerarRelatorioGerencial'])) {
                  
                    $itemVenda = new ItemVenda();

                    $dados = $itemVenda->selectQuantidadeValor('202111060','14');
                 
                    $cv = '202111060';
                    $cp = '14';
                    $q = $dados['quantidade_item']+1;
                    $v = $dados['valor_total_item'];
                    $vf = $v+$v;
                    $itemVenda->updateItemVenda($cv, $cp, $q, $vf);

                }

                
            ?>

<button class="btn btn-outline-danger" id="btnGerarRelatorioGerencial" name="btnGerarRelatorioGerencial" onclick="" style="margin-left: 40%;">Gerar Relatório</button>
</form>        
</div>
    </section>
</body>

</html>