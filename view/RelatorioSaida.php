<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Estoque</title>
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
    <div id="divSair"  >
        <a href="index.php">Sair</a>
    </div>
    <section id="principalSaidaRelatorio">
        <div id="saidaRelatorio">
            <legend>
                <legend>RESULTADO RELATÓRIO DE VENDAS</legend><br>
            </legend>

            <div id="divRelatorioVendasEstoque">
                <table id="tableRelatorioVendasEstoque">

<?php    

require_once '../model/Pessoa.php';
require_once '../model/Venda.php';
require_once '../model/Produto.php';

$vendaRelatorio = new Venda();

$tipoRelatporio = filter_input(INPUT_POST, 'tipoRelatorio');
$tipoPagamento = filter_input(INPUT_POST, 'tipoRelatorioPagamento');

                                        // CONSULTA VENDA POR DATA INICIO E DATA FIM

if (isset($_POST['btnGerarRelatorioGerencial']) & $tipoRelatporio == 'data')
{
    if (isset($_POST['getDataInicial']) && isset($_POST['getDataFinal']) && !empty($_POST['getDataInicial'])  && !empty($_POST['getDataFinal']))
    {
            
            $data_ini = addslashes($_POST['getDataInicial']);
            $data_fim = addslashes($_POST['getDataFinal']);

            $resVendaRelatorio = $vendaRelatorio->selectVendaData( $data_ini, $data_fim);

            echo"<pre>"; 
                var_dump($resVendaRelatorio);
            echo"</pre>";
    }
}
                                                // CONSULTA VENDA POR NOME CLIENTE 'LIKE'

if (isset($_POST['btnGerarRelatorioGerencial']) & $tipoRelatporio == 'cliente')
{

            $resVendaRelatorio =  $vendaRelatorio->selectVendaClienteLike($nomeCliente = "%".trim($_POST['nomeDoCliente'])."%");

            echo"<pre>"; 
                var_dump($resVendaRelatorio);
                echo $nomeCliente;
            echo"</pre>"; 
}

                                // CONSULTA VENDA POR NOME CLIENTE + DATA INICIO E DATA FIM

if (isset($_POST['btnGerarRelatorioGerencial']) & $tipoRelatporio == 'cliente')
{

    if (isset($_POST['getDataInicial']) && isset($_POST['getDataFinal']) && !empty($_POST['getDataInicial'])  && !empty($_POST['getDataFinal']))
    {
            
        $data_ini = addslashes($_POST['getDataInicial']);
        $data_fim = addslashes($_POST['getDataFinal']);

        $resVendaRelatorio =  $vendaRelatorio->selectVendaClienteLikeDataLike($nomeCliente = "%".trim($_POST['nomeDoCliente'])."%", $data_ini,  $data_fim);

            echo"<pre>"; 
                var_dump($resVendaRelatorio);
            echo"</pre>";
    }

}

                                                // CONSULTA VENDA POR TIPO DE PAGAMENTO

if (isset($_POST['btnGerarRelatorioGerencial']) & isset($_POST['tipoRelatorioPagamento']))
{
    $resVendaRelatorio =  $vendaRelatorio->selectVendaAllLikePagamento($tipoPagamento);

            echo"<pre>"; 
                var_dump($resVendaRelatorio);
            echo"</pre>";
}

                                                // CONSULTA VENDA POR NOME VENDEDOR 'LIKE'

if (isset($_POST['btnGerarRelatorioGerencial']) & $tipoRelatporio == 'vendedor')
{

            $resVendaRelatorio =  $vendaRelatorio->consultaVendaLikeVendedor($nomeVendedor = "%".trim($_POST['nomeDoVendedor'])."%");

            echo"<pre>"; 
                var_dump($resVendaRelatorio);
            echo"</pre>"; 
}

                                // CONSULTA VENDA POR NOME VENDEDOR + DATA INICIO E DATA FIM

if (isset($_POST['btnGerarRelatorioGerencial']) & $tipoRelatporio == 'vendedor')
{

    if (isset($_POST['getDataInicial']) && isset($_POST['getDataFinal']) && !empty($_POST['getDataInicial'])  && !empty($_POST['getDataFinal']))
    {
            
        $data_ini = addslashes($_POST['getDataInicial']);
        $data_fim = addslashes($_POST['getDataFinal']);

        $resVendaRelatorio =  $vendaRelatorio->selectVendaVendedorLikeDataLike($nomeVendedor = "%".trim($_POST['nomeDoVendedor'])."%", $data_ini,  $data_fim);

            echo"<pre>"; 
                var_dump($resVendaRelatorio);
            echo"</pre>";
    }

}

?>

                </table>
            </div>
           
        </div>

            <input  class="btn btn-outline-danger" id="fecharRelatorio" type="submit" name="fecharRelatorio" style="margin-left: 40%; margin-top: 1%;"
               onclick="window.URL('RelatorioVendas.php');" value="<?php echo 'Fechar Relatório';?>">
    </section>
</body>

</html>