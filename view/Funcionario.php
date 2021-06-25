<?php

require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'PessoaJuridica.php';
require_once 'PessoaFisica.php';

class Funcionario extends PessoaFisica
{
    // declaração de propriedade
    public string $matricula;
    public string $senha;
    
    // método contrutor
    function __construct_funcionario() {
    }

    // declaração de métodos especiais        
    public function createFuncionario($nome, $email, $telefoneFixo, $telefoneCelular, $endereco, $cpf, $matricula, $senha)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
        
        $dados = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE email = :e");
        //$cadastrar = $this->pdo->query("SELECT * id FROM pessoa WHERE email = ".$email);
        $dados->bindValue(":e", $email);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO pessoa (nome, email, telefone_fixo, telefone_celular,
             endereco) VALUES (:n, :e, :tf, :tc, :ed)");
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

            $dados = $conexao->pdo->prepare("INSERT INTO funcionario (matricula, senha, pessoa_fisica_cpf) VALUES (:m, :s, :fk)");
            $dados->bindValue(":m", $matricula);
            $dados->bindValue(":s", $senha);
            $dados->bindValue(":fk", $cpf);
            $dados->execute();
            return true;
        }
    }

    public function selectFuncionario()
    {
        
    }

    public function updateFuncionario()
    {
    }

    public function deleteFuncionario()
    {

    }

    public function selectAllFuncionario()
    {

    }

}