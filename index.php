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

                $passwordHash = $pessoa->selectSenhaHash($usuarioLogin);
                $password = $passwordHash['senha'];

                $login =  password_verify($usuarioLogin, $password); // funcao que verifica se a hash gravada no BD confere com o password informado
               
                    if ($login) {

                        header("location: view/home.php");

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