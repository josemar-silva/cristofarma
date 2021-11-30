<!doctype html>
<html lang="pt">

    

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/formularios/bootstrap.css">


    <title>Login</title>
    
</head>

<h1>Sistema de Gerenciamento e Controle de Estoque para Farmácia - SisgeconFarm</h1>

<body class="body" style=" margin-left: auto; margin-right: auto;  margin-top: 6%;">   

<legend id="sistemaDesenvolvedores">  </legend><br>
    

    <header>    

    </header>

    <section >
        <h2>Bem Vindo!</h2><br>
        
            <form id="login" action="" method="POST" style="border: double 2px; width: 30%; margin-top: 2%; margin-left: auto; margin-right: auto;  border-radius: 20px; height: 23em;  padding: 2%;">
                <legend><h4>Informe o seu Login e Senha!</h4></legend><br><br>

                <label for="email">Usuário:</label>
                <input id="usuario" type="text" name="usuario" size="30" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
                    style="width: 50%; display: block; margin-left: auto; margin-right: auto; font-size: 13pt;"><br>
                
                <label for="senha">Senha:</label>
                <input id="senha" type="password" name="senha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
                    size = "30" style="width: 50%; display: block; margin-left: auto; margin-right: auto; font-size: 13pt;" ><br><br>

                <button type="submit" id="btnEntrarLoginGerencial" name="entrarLoginGerencial" class="btn btn-outline-danger">Entrar</button>
            </form>

        <?php
                                    ## =================== VALIDAR LOGIN ========================

        require_once 'model/Pessoa.php';
        $pessoa = new Pessoa();

        if (isset($_POST['usuario']) && isset($_POST['senha'])) {

            $usuarioLogin = addslashes($_POST['usuario']);
            $senhaLogin = addslashes($_POST['senha']);

            if (!empty($usuarioLogin) && !empty($senhaLogin)) 
            {

                $user = $pessoa->selectUsuarioLogin($usuarioLogin);
                $userLogin = $user['matricula'];
                $userPasswordHash = $user['senha'];
                $userFuncao = $user['funcao'];

                $login =  password_verify($senhaLogin, $userPasswordHash); // funcao nativa do PHP que compara a hash gravada no BD com HASH do password informado (retorno==boolean)
              
                    if ($login) {
                        session_start();
                        $_SESSION['login'] = array('user' => $userLogin, 'password' => $userPasswordHash, 'function'=> $userFuncao);
                        header("location: view/home.php");
                        var_dump($_SESSION['login']);

                    } else {
                             
                        echo "<script> alert('Usuário ou senha incorretos! Tente novamente!')</script>";
                }             
            } else { 
                
                echo "<script> alert('Preencha todos os campos!')</script>";
        }
    } 
        ?>
    </section>
</body>



</html>

<footer>
   
</footer>