<?php

require_once 'Conexao.php';
require_once 'Pessoa.php';

class PessoaJuridica extends Pessoa
{
    // declaração de propriedade
    public string $cnpj;
        
    // método contrutor
    function __construct_pessoaJuridica($cnpj) 
    {
        $this->nome = $cnpj;
    }
    
    
    public function createPessoaJuridica($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cnpj)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
        
        $dados = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE email = :e");
        //$cadastrar = $this->pdo->query("SELECT * id FROM pessoa WHERE email = ".$email);
        $dados->bindValue(":e", $email);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO pessoa (nome, email, telefone_fixo, telefone_celular, endereco)
            VALUES (:n, :e, :tf, :tc, :ed)");
            $dados->bindValue(":n", $nome);
            $dados->bindValue(":e", $email);
            $dados->bindValue(":tf", $telefoneFixo);
            $dados->bindValue(":tc", $telefoneCelular);
            $dados->bindValue(":ed", $endereco);
            $dados->execute();

            $dados = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE email = :e");
            $dados->bindValue(":e", $email);
            $dados->execute();
            $res = $dados->fetch(PDO::FETCH_ASSOC);
            $res2 = $res['id_pessoa'];
            
            $dados = $conexao->pdo->prepare("INSERT INTO pessoa_juridica (cnpj, pessoa_id_pessoa) VALUES (:c, :fk)");
            $dados->bindValue(":c", $cnpj);
            $dados->bindValue(":fk", $res2);
            $dados->execute();
            return true;
        }
    }

    public function selectPessoaJuridica($id_up)
    {
        $dadosSelecionados = array();

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT * FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function updatePessoaJuridica()
    {
    }

    public function deletePessoaJuridica($id)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa_juridica WHERE pessoa_id_pessoa = :id");
        $dados->bindValue("id", $id);
        $dados->execute();

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue("id", $id);
        $dados->execute();
    }

    public function selectAllPessoaJuridica()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa ORDER BY id_pessoa");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }
}
?>