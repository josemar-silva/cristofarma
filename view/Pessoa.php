<?php

require_once 'Conexao.php';

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
    public string $endereco;

    // método contrutor
    function __construct_pessoa(string $nome, string $cpf_cnpj)
    {
        $this->nome = $nome;
        $this->cpf_cnpj = $cpf_cnpj;
    }

    // declaração de métodos especiais
    public function createPessoa($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
        $telefoneCelular, $endereco)
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
            tipo_pessoa, email, telefone_fixo, telefone_celular, endereco)
            VALUES (:n, :c, :tp, :e, :tf, :tc,:ed)");
            $dados->bindValue(":n", $nome);
            $dados->bindValue(":c", $cpf_cnpj);
            $dados->bindValue(":tp", $tipo_pessoa);
            $dados->bindValue(":e", $email);
            $dados->bindValue(":tf", $telefoneFixo);
            $dados->bindValue(":tc", $telefoneCelular);
            $dados->bindValue(":ed", $endereco);
            $dados->execute();

            return true;
        }
    }
    
    public function createPessoaFuncionario($nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
        $telefoneCelular, $matricula, $senha, $funcao, $endereco)
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
            tipo_pessoa, email, telefone_fixo, telefone_celular, matricula, senha, funcao, endereco)
            VALUES (:n, :c, :tp, :e, :tf, :tc, :m, :s, :f,:ed)");
            $dados->bindValue(":n", $nome);
            $dados->bindValue(":c", $cpf_cnpj);
            $dados->bindValue(":tp", $tipo_pessoa);
            $dados->bindValue(":e", $email);
            $dados->bindValue(":tf", $telefoneFixo);
            $dados->bindValue(":tc", $telefoneCelular);
            $dados->bindValue(":m", $matricula);
            $dados->bindValue(":s", $senha);
            $dados->bindValue(":f", $funcao);
            $dados->bindValue(":ed", $endereco);
            $dados->execute();

            return true;
        }
    }

    public function updatePessoaClienteFornecedor($id_upd, $nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
    $telefoneCelular, $endereco)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("UPDATE pessoa SET nome = :n, cpf_cnpj = :c, tipo_pessoa = :tp, 
        email = :e, telefone_fixo = :tf, telefone_celular = :tc, endereco = :ed WHERE id_pessoa = :id");
        $dados->bindValue(":n", $nome);
        $dados->bindValue(":c", $cpf_cnpj);
        $dados->bindValue(":tp", $tipo_pessoa);
        $dados->bindValue(":e", $email);
        $dados->bindValue(":tf", $telefoneFixo);
        $dados->bindValue(":tc", $telefoneCelular);
        $dados->bindValue(":ed", $endereco);
        $dados->bindValue(":id", $id_upd); 
        $dados->execute();
    }

    public function updatePessoaFuncionario($id_upd, $nome, $cpf_cnpj, $tipo_pessoa, $email, $telefoneFixo, 
    $telefoneCelular, $matricula, $funcao, $endereco)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("UPDATE pessoa SET nome = :n, cpf_cnpj = :c, tipo_pessoa = :tp, 
        email = :e, telefone_fixo = :tf, telefone_celular = :tc, matricula = :m,  funcao = :f, endereco = :ed WHERE id_pessoa = :id");
        $dados->bindValue(":n", $nome);
        $dados->bindValue(":c", $cpf_cnpj);
        $dados->bindValue(":tp", $tipo_pessoa);
        $dados->bindValue(":e", $email);
        $dados->bindValue(":tf", $telefoneFixo);
        $dados->bindValue(":tc", $telefoneCelular);
        $dados->bindValue(":m", $matricula); 
        $dados->bindValue(":f", $funcao);
        $dados->bindValue(":ed", $endereco);
        $dados->bindValue(":id", $id_upd); 
        $dados->execute();
    }

    public function deletePessoa($id_up)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("DELETE FROM pessoa WHERE id_pessoa = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();
    }

    public function selectPessoaCliente($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD
 
        $dados  = $conexao->pdo->prepare("SELECT pessoa.id_pessoa, pessoa.nome, pessoa.cpf_cnpj, pessoa.tipo_pessoa,
        pessoa.email, pessoa.telefone_fixo, pessoa.telefone_celular, pessoa.endereco 
        FROM pessoa WHERE tipo_pessoa = 'cliente' AND id_pessoa = :id; " ); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }

    public function selectPessoaFornecedor($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD
 
        $dados  = $conexao->pdo->prepare("SELECT pessoa.id_pessoa, pessoa.nome, pessoa.cpf_cnpj, pessoa.tipo_pessoa,
        pessoa.email, pessoa.telefone_fixo, pessoa.telefone_celular, pessoa.endereco 
        FROM pessoa WHERE tipo_pessoa = 'fornecedor' AND id_pessoa = :id; " ); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }

    public function selectPessoaFuncionario($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD
 
        $dados  = $conexao->pdo->prepare("SELECT pessoa.id_pessoa, pessoa.nome, pessoa.cpf_cnpj, pessoa.tipo_pessoa, 
        pessoa.email, pessoa.telefone_fixo, pessoa.telefone_celular, pessoa.matricula, pessoa.senha, pessoa.funcao, pessoa.endereco 
        FROM pessoa WHERE tipo_pessoa = 'funcionario' AND id_pessoa = :id; " ); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }

    public function selectAllPessoa()
    {
        $dadosSelecionados = array(); 

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * pessoa ORDER BY nome;");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function selectAllPessoaCliente()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT pessoa.id_pessoa, pessoa.nome, pessoa.cpf_cnpj, pessoa.tipo_pessoa,
        pessoa.email, pessoa.telefone_fixo, pessoa.telefone_celular, pessoa.endereco 
        FROM pessoa WHERE tipo_pessoa = 'cliente' ORDER BY nome;");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function selectAllPessoaFornecedor()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT pessoa.id_pessoa, pessoa.nome, pessoa.cpf_cnpj, pessoa.tipo_pessoa,
        pessoa.email, pessoa.telefone_fixo, pessoa.telefone_celular, pessoa.endereco 
        FROM pessoa WHERE tipo_pessoa = 'fornecedor' ORDER BY nome;");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }
    
    public function selectAllPessoaFuncionario()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM pessoa WHERE tipo_pessoa = 'funcionario' ORDER BY nome");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function consultaClienteFornecedorLike($consultaLike, $tipoConsulta){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT * FROM pessoa WHERE nome LIKE :lk AND tipo_pessoa = :tp 
            ORDER BY nome ASC");
            
        $dados->bindValue(":lk", $consultaLike);
        $dados->bindValue(":tp", $tipoConsulta);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;

    }

    public function funcionarioLogin($emailLogin, $senhaLogin){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT email, senha FROM pessoa WHERE email = :e AND senha = :s");
        $dados->bindValue(":e", $emailLogin);
        $dados->bindValue(":s", $senhaLogin);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        if ($dadosSelecionados[0]['email'] == $emailLogin && $dadosSelecionados[0]['senha'] == $senhaLogin)
        {
            $loginFuncionario = true;
        } else {
            $loginFuncionario = false;
        }

        return $loginFuncionario;
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