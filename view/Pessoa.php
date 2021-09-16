<?php

require_once 'Conexao.php';
require_once 'Endereco.php';

class Pessoa 

{
    // declaração de propriedade
    public string $id_pessoa;
    public string $nome;
    public string $cpf_cnpj;
    public string $tipo_pessoa;
    public string $email;
    public string $telefoneFixo;
    public string $telefoneCelular;
    public string $matricula;
    public string $senha;
    public string $funcao;

    // método contrutor
    function __construct_pessoa(string $nome, string $cpf_cnpj)
    {
        $this->nome = $nome;
        $this->cpf_cnpj = $cpf_cnpj;
    }

    // declaração de métodos especiais
    public function createPessoa($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
        $telefoneCelular, $matricula, $senha, $funcao)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
        
        $dados = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE email = :e");
        //$cadastrar = $this->pdo->query("SELECT * id FROM pessoa WHERE email = ".$email);
        $dados->bindValue(":e", $email);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO pessoa (nome, cpf_cnpj, 
            tipo_pessoa, email, telefone_fixo, telefone_celular, matricula, senha, funcao)
            VALUES (:n, :c, :tp, :e, :tf, :tc, :m, :s, :f)");
            $dados->bindValue(":n", $nome);
            $dados->bindValue(":c", $cpf_cnpj);
            $dados->bindValue(":tp", $tipo_pessoa);
            $dados->bindValue(":e", $email);
            $dados->bindValue(":tf", $telefoneFixo);
            $dados->bindValue(":tc", $telefoneCelular);
            $dados->bindValue(":m", $matricula);
            $dados->bindValue(":s", $senha);
            $dados->bindValue(":f", $funcao);
            $dados->execute();

            return true;
        }
    }

    public function selectPessoa($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD
 
        $dados  = $conexao->pdo->prepare("SELECT * FROM pessoa WHERE id_pessoa = :id" ); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }

    public function updatePessoa($id_up, $email)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("UPDATE pessoa_fisica SET email = :e WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->bindValue("e", $email);

        $dados->execute();
    }

    public function deletePessoa($id_up)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();
    }

    public function selectAllPessoaCiente()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa WHERE tipo_pessoa = 'cliente' ORDER BY id_pessoa");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function selectAllPessoaFornecedor()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa WHERE tipo_pessoa = 'fornecedor' ORDER BY id_pessoa");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }public function selectAllPessoaFuncionario()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa WHERE tipo_pessoa = 'funcionario' ORDER BY id_pessoa");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }



    //metodos de acesso 
    function __getId() 
    {

    }

    function __setId()
    {

    }

    function __getNome() 
    {

    }

    function __setNome()
    {

    }

    function __getEmail()
    {

    }

    function __setEmail()
    {

    }

    function __getEndereco()
    {

    }

    function __setEndereco()
    {

    }

    function __getTelefoneFixo()
    {

    }

    function __setTelefoneFixo()
    {

    }

    function __getTelefoneCelular()
    {

    }

    function __setTelefoneCelular()
    {

    }

  
}

?>