<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
    <link rel="stylesheet" href="../css/estilo.css">
    <link rel="stylesheet" href="../css/fontawesome/css/all.css">

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
    <section id="principalCaaixa">

        <div id="listaVendas">
            <legend>VENDAS REALIZADAS</legend>

            <div class="tableFixHead">

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> DATA </th>
                            <th> ID VENDA </th>
                            <th> NOME DO CLIENTE </th>
                            <th> VENDEDOR </th>
                            <th> VALOR VENDA </th>
                            <th> PAGAMENTO </th>
                            <th> SITUAÇÃO </th>
                            <th> AÇÃO </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once '../model/Produto.php';
                        require_once '../model/ItemVenda.php';
                        require_once '../model/Pessoa.php';
                        require_once '../model/Venda.php';
                        require_once '../model/Estoque.php';

                        $produto = new Produto();
                        $itemVenda = new ItemVenda();
                        $pessoa = new Pessoa();
                        $venda = new Venda();
                        $estoque = new Estoque();

                        $dados = $venda->selectAllVendaAberta();

                        if (count($dados) > 0) {

                            for ($i = 0; $i < count($dados); $i++) {
                                echo "<tr>"; // abre a linha dos dados selecionados

                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == "data_venda") // ignorar coluna
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == 'codigo_venda')  // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == 'pessoa_id_pessoa_cliente')  // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        $cliente = $pessoa->selectPessoaCliente($value);
                                        echo "<td>" . $cliente[0]['nome'] . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == 'pessoa_id_pessoa_vendedor')  // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        $cliente = $pessoa->selectPessoaFuncionario($value);
                                        echo "<td>" . $cliente[0]['nome'] . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == 'valor_venda_com_desconto')  // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        echo "<td>" . number_format($value, 2, ',', '.') . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == 'tipo_pagamento')  // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                                foreach ($dados[$i] as $key => $value) {
                                    if ($key == 'status_venda')  // IMPRIMIR VALOR SOMENTE SE...
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                        ?>
                                <td>
                                    <a class="acaoVerde" id="fecharVendaNoCaixa" href="FecharVendaCaixa.php?id_get_venda_up=<?php echo $dados[$i]['id_venda']; ?>"><i class="fas fa-hand-holding-usd"></i>
                                        <a class="acaoVermelho" id="cancelaNoVendaCaixa" href=""><i class="fas fa-window-close"></i>
                                </td>
                        <?php
                                echo "</tr>"; // fecha linha dos dados selecionados
                            }
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </section>
</body>

</html>