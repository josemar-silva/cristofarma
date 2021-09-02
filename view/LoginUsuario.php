<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/formularios/bootstrap.css">
    <title>Login</title>
</head>

<body class="body">
    <header>

    </header>
    <section >
        <h1>Bem Vindo!</h1>
        <form id="formLoginUsuario">
            <label for="matricula">Matrícula:</label>
            <input id="matricula" type="text" name="matricula" size="20" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><br><br>
            <label for="senha">Senha:</label>
            <input id="get-senha" type="password" name="senha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><br><br>
            <button type="submit" id="btnGravarLoginUsuario" name="gravarLoginUsuario" class="btn btn-outline-danger">Entrar</button>
            <button type="submit" id="btnSairLoginUsuario" name="sairLoginUsuario" class="btn btn-outline-danger" >Sair</button>
        </form>
    </section>
</body>

</html>