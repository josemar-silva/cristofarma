<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/estilo.css">
    <title>Gerenciar Usuário</title>
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
        <form action="cadastroUsuario">
            <legend>CADASTRO DE USUÁRIOS</legend><br>
            <label id="nome">Nome:</label>
            <input id="nome" type="text" name="nome" size="35"><br>
            <label id="cpf">CPF:</label>
            <input id="cpf" type="text" name="cpf" size="20"><br>
            <label id="matricula">Matrícula:</label>
            <input id="matricula" type="text" name="matricula" size="10">
            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="senha" size="10"><br>
            <label id="telefoneFixo">Telefone:</label>
            <input id="telefoneFixo" type="tel" name="telefoneFixo" size="15" minlength="11"><br>
            <label id="telefoneCelular">Celular:</label>
            <input id="telefoneCelular" type="tel" name="telefoneCelular" size="15" minlength="11"><br>
            <label id="funcao">Função:</label>
            <select id="listFuncao" name="listaFuncao">
                <option value="Gerente">Gerente</option>
                <option value="Vendedor" selected>Vendedor</option>
                <option value="Operador de Caixa">Operador de Caixa</option>
            </select><br />
            <label id="labelEnderecoUsuario">Endereço:</label>
            <input id="getEnderecoUsuario" type="text" name="nameEnderecoUsuario" size="30">
            <a href="FormEndereco.php">Editar</a><br>
            <button type="submit" id="btnGravarClientes" name="gravarClientes">Gravar</button>
        </form>
        <table id="cadastro">
            <tr>
                <tr>
                    <th>Nome do Cliente</th>
                    <th>Endereço de e-mail</th>
                    <th>Telefone Fixo</th>
                    <th>Telefone Celular</th>
                    <th colspan="2">Endereço</th> 
                </tr>
            </tr>
        </table>
    </section>
    <section id="btn">
        <button type="submit" id="btnCancelarUsuarios" name="cancelarUsuarios">Cancelar</button>
        <button type="submit" id="btnGravarUsuarios" name="gravarUsuarios">Gravar</button>
        <button type="submit" id="btnExcluirUsuarios" name="excluirUsuarios">Excluir</button>
    </section>
</body>

</html>