<?php
    require_once '../model/Pessoa.php';

    $pessoa = new Pessoa();
   // $usuarioLogado = $pessoa->login();              
?>

<!doctype html>
<html lang="pt">

<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="../css/bootstrap/nav/navegador.css">
  <link rel="stylesheet" href="../css/estilo.css">
  <link rel="stylesheet" href="../css/fontawesome/css/all.css">
  <title>Pesquisar Clientes</title>
</head>

<body>
    <header>
        <div class="dp-menu">
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
        </div>
    </header>
    <div id="divSair">
        <a href="ConsultaClientes.php?sair=<?php echo 1;?>">Sair</a>
    </div>

    <form action="ConsultaClientes.php" method="GET">
        <legend>CONSULTA CLIENTES</legend><br><br>

        <label style="margin-left: 25%;"></label>
        <input type="search" id="buscaCliente" class="form-control" name="buscaCliente" autofocus value="<?php if (isset($_GET['buscaCliente']) && !empty($_GET['buscaCliente']))
                                                                                                                echo $_GET['buscaCliente']; ?>" size=" 50" class="form-control-busca" placeholder="Digte aqui para buscar" style="display: inline; font-size: 13pt;">

        <button class="btn btn-outline-danger" id="btnBuscar" onclick="" style="width: 10%; padding: 2px; margin-left: 3%;">Buscar</button><br><br>
    </form>

    <section>
        <?php
        if (isset($_GET['buscaCliente'])) {
            $tipoConsulta = "cliente";
        ?>
            <div class="tableFixHead"  style="height: 40em;">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> NOME DO CLIENTE</th>
                            <th style="width: 10%;"> CPF/CNPJ</th>
                            <th> EMAIL </th>
                            <th style="width: 10%;"> TELEFONE FIXO </th>
                            <th style="width: 10%;"> TELEFONE CELULAR </th>
                            <th> ENDEREÇO DO CLIENTE</th>
                            <th> AÇÃO </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $dados = $pessoa->consultaClienteFornecedorLike($consultaLike = "%" . trim($_GET['buscaCliente']) . "%", $tipoConsulta);

                        #echo"<pre>"; // organizar o array (matriz de array)
                        #var_dump($dados); // imprimir na tela o resultado do array
                        #echo"</pre>"; // organizar o array (matriz de array)

                        if (count($dados) > 0) {
                            for ($i = 0; $i < count($dados); $i++) {
                                echo "<tr>"; // abre a linha dos dados selecionados

                                foreach ($dados[$i] as $key => $value) {
                                    if ($key != "matricula" && $key != "senha" && $key != "funcao" && $key != "tipo_pessoa") // ignorar coluna
                                    {
                                        echo "<td>" . $value . "</td>";
                                    }
                                }
                        ?>
                                <td>
                                    <a id="acaoSelecionar" href="Vendas.php?id_cliente_up_venda=<?php echo $dados[$i]['id_pessoa']; ?>"><i class="fas fa-hand-pointer"></i><!--Selecionar--></a>
                                    <a class="acaoVerde" id="acaoEditar" href="AtualizaCliente.php?id_get_up=<?php echo $dados[$i]['id_pessoa']; ?>"><i class="fas fa-edit"></i><!--Editar--></a>
                                    <a class="acaoVermelho" id="acaoExcluir" href="ConsultaClientes.php?id_get_del=<?php echo $dados[$i]['id_pessoa']; ?>"><i class="fas fa-trash"></i><!--Excluir--></a>
                                    <!-- usar "echo $dados[$i]['id_pessoa']; "pegar ID desejado no array e passar como 'string' para o metodo $_GET-->
                                </td>
                        <?php
                                echo "</tr>"; // fecha linha dos dados selecionados
                            }
                        }
                        ?>
                    </tbody>    
                </table>
            </div>
        
        <?php

        }
        ?>
    </section>

    <?php

  #deletar dado selecionado pelo numero da ID passado como parametro 
  if (isset($_GET['id_get_del'])) # verificando se existe dados selecionado para exclusão
  {
    $id_up = addslashes($_GET['id_get_del']); # pegar ID desejado no array
    $pessoa->deletePessoa($id_up);
    header("location: ConsultaClientes.php?buscaCliente=+"); #atualizar a pagina ao executar a exclusão
  }
  ?>
</body>

</html>