<?php
require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'PessoaFisica.php';

class Funcionario extends PessoaFisica
{
    // declaração de propriedade
    protected string $matricula;
    protected string $senha;
    
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
            $dados = $conexao->pdo->prepare("INSERT INTO pessoa (nome, cpf, email, telefone_fixo, telefone_celular,
             endereco, cpf, matricula, senha)
            VALUES (:n, :e, :tf, :tc, :ed, :c, :m, :s)");
            $dados->bindValue(":n", $nome);
            $dados->bindValue(":e", $email);            
            $dados->bindValue(":tf", $telefoneFixo);
            $dados->bindValue(":tc", $telefoneCelular);
            $dados->bindValue(":ed", $endereco);
            $dados->bindValue(":c", $cpf);            
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

            $dados = $conexao->pdo->prepare("INSERT INTO funcionario (pessoa_fisica_cpf, maticula, senha,) VALUEs (:fk, :m, :s)");
            $dados->bindValue(":fk", $cpf);
            $dados->bindValue(":m", $matricula);
            $dados->bindValue(":s", $senha);
            $dados->execute();
            return true;
        }
    }

    public function selectFornecedor($id_fornecedor_up)
    {
        $dadosSelecionados = array();

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT * FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_fornecedor_up);
        $dados->execute();
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function updateFornecedor()
    {
    }

    public function deleteFornecedor($id)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

    
        $cnpj = $conexao->pdo->prepare("SELECT cnpj FROM pessoa_juridica WHERE pessoa_id_pessoa = :id");
        $cnpj->bindValue("id", $id);
        $cnpj->execute();
        $dadosSelecionados = $cnpj->fetch(PDO::FETCH_ASSOC);
        $res = $dadosSelecionados['cnpj'];

        $dados = $conexao->pdo->prepare("DELETE FROM fornecedor WHERE pessoa_juridica_cnpj = :c");
        $dados->bindValue(":c", $res);
        $dados->execute();

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa_juridica WHERE pessoa_id_pessoa = :id");
        $dados->bindValue(":id", $id);
        $dados->execute();

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue(":id", $id);
        $dados->execute();
    }

    public function selectAllFornecedor()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa ORDER BY id_pessoa");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

}