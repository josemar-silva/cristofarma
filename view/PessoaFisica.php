<?php

require_once 'Conexao.php';
require_once 'PessoaFisica.php';
require_once 'Pessoa.php';

class PessoaFisica extends Pessoa
{
    // declaração de propriedade
    public string $cpf;

    // método contrutor,
    function __construct_pessoaFisica(string $nome, string $cpf)
    {
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    // declaração de métodos especiais
    public function createPessoaFisica($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cpf)
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
            $dados = $conexao->pdo->prepare("INSERT INTO pessoa_fisica (cpf, pessoa_id_pessoa) VALUES (:c, :fk)");
            $dados->bindValue(":c", $cpf);
            $dados->bindValue(":fk", $res2);
            $dados->execute();
            return true;
        }
    }

    public function selectPessoaFisica($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD

        $dados  = $conexao->pdo->prepare("SELECT * FROM pessoa WHERE id_pessoa = :id"); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        return $dadosSelecionados; //varialvel de retorno da funcao
    }

    public function updatePessoaFisica($id_up, $email)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("UPDATE pessoa_fisica SET email = :e WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->bindValue("e", $email);

        $dados->execute();
    }

    public function deletePessoaFisica($id_up)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa_fisica WHERE pessoa_id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();
    }

    public function selectAllPessoaFisica()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa ORDER BY id_pessoa");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }
}
