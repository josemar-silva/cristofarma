<?php

class Conexao {

   public $pdo;

    function __construct($dbname, $host, $user, $senha)
    { //PARAMETROS CONEXÃO COM BANCO DE DADOS

        try {
            $this->pdo  = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (PDOException $e) {
            echo "Erro com Banco de Dados: " . $e->getMessage();
            exit();
        } catch (Exception $e) {
            echo "Erro Generico: " . $e->getMessage();
            exit();
        }
    }
}

?>