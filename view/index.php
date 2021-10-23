<!doctype html>
<html lang="pt">

    

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/formularios/bootstrap.css">


    <title>Login</title>
    
</head>


<body class="body">   

<legend id="sistemaDesenvolvedores"> Sistema de Gerenciamento e Controle de Estoque para Farmácias - Sisgecon-farm</legend><br><br>
    

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

                <button type="submit" id="btnEntrarLoginGerencial" name="entrarLoginGerencial" 
                class="btn btn-outline-danger"> Entrar</button><br><br><br><br><br><br>
                <!-- <button onclick="fechaAplication(this)" type="submit" id="btnSairLoginGerencial"  -->
                <!-- name="sairLoginLoginGerencial" class="btn btn-outline-danger">Fechar</button><br><br> -->
            </form>

        <?php
        ## =================== VALIDAR LOGIN ========================

        require_once '../model/Pessoa.php';
        $pessoa = new Pessoa();

        if (isset($_POST['email']) && isset($_POST['senha'])) {

                $emailLogin = addslashes($_POST['email']);
                $senhaLogin = addslashes($_POST['senha']);

                if (!empty($emailLogin) && !empty($senhaLogin)) {
               
                        if ($login = $pessoa->funcionarioLogin($emailLogin, $senhaLogin)) {

                            header("location: home.php");

                        } else {
                            
                            echo "<script> alert('e-mail ou senha incorretos! Tente novamente!')</script>";
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
    <h7>
        by: Josemar Silva, Bruno Mikael, Junior Lima, Geovane Rodrigo
    </h7>
</footer>