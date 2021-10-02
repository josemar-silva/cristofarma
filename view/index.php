<!doctype html>
<html lang="pt">

    

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/formularios/bootstrap.css">

    <title>Login</title>
    
</head>


<body class="body">   
    <header>        
    </header>
    <section >
        <h1>Bem Vindo!</h1><br><br/>
        
        <form id="login" method="POST">
            <legend><h3>Informe o seu Login e Senha!</h3></legend>

            <label for="email">E-mail:</label>
            <input id="email" type="text" name="email" size="40" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><br><br>
            
            <label for="senha">Senha:</label>
            <input id="senha" type="password" name="senha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" size = "60"><br><br>
            
            <button type="submit" id="btnEntrarLoginGerencial" name="entrarLoginGerencial" class="btn btn-outline-danger"> Entrar</button>
            <button type="submit" id="btnSairLoginGerencial" name="sairLoginLoginGerencial" class="btn btn-outline-danger">Sair</button><br><br>
        </form>

        <?php
        ## =================== VALIDAR LOGIN ========================

        require_once 'Pessoa.php';
        $pessoa = new Pessoa();

        if (isset($_POST['email']) && isset($_POST['senha'])) {

                $emailLogin = addslashes($_POST['email']);
                $senhaLogin = addslashes($_POST['senha']);

                if (!empty($emailLogin) && !empty($senhaLogin)) {
               
                        if ($login = $pessoa->funcionarioLogin($emailLogin, $senhaLogin)) {

                            header("location: home.php");

                        } else {

                            echo "<h3>e-mail ou senha incorretos! Tente novamente!</h3>";
                }             
            } else { 
                echo "<h2>Preencha todos os campos!</h2>";
        }
    }
        ?>
    </section>
</body>

</html>