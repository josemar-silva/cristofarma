<?php

require_once 'Pessoa.php';
require_once 'Conexao.php';
class Endereco
{
    protected string $id_endereco;
    protected string $logradouro;
    protected string $quadra;
    protected string $lote;
    protected string $bairro;
    protected string $cidade;
    protected string $cep;
    protected string $complemento;

    public function __construct() {
   
    }

    public function createEndereco($logradouro, $quadra, $lote, $bairro, 
        $cidade, $cep, $complemento)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
        
            #global $res;
            #dados = $conexao->pdo->prepare("SELECT cpf_cnpj FROM pessoa WHERE cpf_cnpj  = :fk");
            #$dados->bindValue(":fk", $cpf_cnpj);
            #$dados->execute();
            #$res2 = $dados->fetch(PDO::FETCH_ASSOC);
            #$res = $res2['id_pessoa'];

            $dados = $conexao->pdo->prepare("INSERT INTO endereco (logradouro, 
            quadra, lote, bairro, cidade, cep, complemento)
            VALUES (:lg, :qd, :lt, :b, :cd, :cp, :com)");
            $dados->bindValue(":lg", $logradouro);
            $dados->bindValue(":qd", $quadra);
            $dados->bindValue(":lt", $lote); 
            $dados->bindValue(":b", $bairro);
            $dados->bindValue(":cd", $cidade);
            $dados->bindValue(":cp", $cep);
            $dados->bindValue(":com", $complemento);
            #$dados->bindValue(":fk", $res);
            $dados->execute();

            return true;
        
    }

    //metodos de acesso 
    function __getIdEndereco()
    {

    }

    function __setIdEndereco()
    {

    }

    function __getLogradouro()
    {

    }

    function __setLogradouro()
    {

    }
    function __getQuadra()
    {

    }

    function __setQuadra()
    {

    }

    function __getLote()
    {

    }

    function __setLote()
    {

    }

    function __getCidade()
    {

    }

    function __setCidade()
    {

    }

    function __getEstado()
    {

    }

    function __setEstadoLote()
    {

    }

    function __getCep()
    {

    }

    function __setCep()
    {

    }
    function __getComplemento()
    {

    }

    function __setLoteComplemento()
    {

    }

}    
?>