<!doctype html>
<html lang="pt">

<head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap/formularios/bootstrap.css">

    <title>Torcar Senha</title>
    
</head>

<body class="body" style=" margin-left: auto; margin-right: auto;  margin-top: 6%;">       

    <header>    

    </header>

    <section >
            <?php
                require_once '../model/Pessoa.php';
                $pessoa = new Pessoa();

                if (isset($_GET['matricula_up'])) {

                    $matricula_up = addslashes($_GET['matricula_up']);

                }

                if (isset($_POST['btnTrocaSenha'])) {

                    $matriculaUpdate = addslashes($_POST['matricula']);
                    $senhaUpdate = addslashes($_POST['novaSenha']);
                    $novaSenhaHash = password_hash($senhaUpdate, PASSWORD_DEFAULT);
    
                    if ($pessoa->mudarSenha($matriculaUpdate, $novaSenhaHash)) {
                        
                        echo '<script> alert("Senha alterada com sucesso!")</script>';
                        ?> <script> window.close(); </script> <?php
                    } else {

                        echo '<script> alert("ERRO! Não foi possível alterar sua senha!\n Procure seu gerente!")</script>';
                    }
                }
            ?>

        <h2>Trocar senha:</h2>
        
            <form id="FormTrocarSunha" action="" method="POST" style="border: double 2px; width: 30%; margin-top: 2%; margin-left: auto; margin-right: auto;  border-radius: 20px; height: 23em; width: 60%; padding: 2%;">
                <legend><h4>Informe sua matrícula e a nova senha!</h4></legend><br>

                <label for="matricula">Matrícula:</label>
                <input id="matricula" type="text" name="matricula" size="30" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
                    value="<?php if (isset($_GET['matricula_up'])) { echo $matricula_up; } ?>" style="width: 50%; display: block; margin-left: auto; margin-right: auto; font-size: 13pt;"><br>
                
                <label for="novaSenha">Nova Senha:</label>
                <input id="novaSenha" type="password" name="novaSenha" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" 
                    size = "30" style="width: 50%; display: block; margin-left: auto; margin-right: auto; font-size: 13pt;" ><br><br>

                <button type="submit" id="btnTrocaSenha" name="btnTrocaSenha" class="btn btn-outline-danger" style="border: 1px white solid; color: white;">Trocar Senha</button>
            </form>
    
    </section>
</body>



</html>

<footer>
   
</footer>