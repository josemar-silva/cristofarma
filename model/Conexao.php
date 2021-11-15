<?php

class Conexao {

   public $pdo;

   public $dbname = "projeto_cristofarma";
   public $host = "localhost";
   public $user = "root";
   public $senha = "";

    function __construct()
    {
        try {
            $this->pdo  = new PDO("mysql:dbname=" . $this->dbname . ";host=" . $this->host, $this->user, $this->senha);
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