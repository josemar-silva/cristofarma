<?php
require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'PessoaFisica.php';

class Funcionario extends PessoaFisica
{
    // declaração de propriedade
    protected string $matricula;
    protected string $senha;
    protected string $funcao;
    
    // método contrutor
    function __construct_funcionario(string $matricula) {
        $this->matricula = $matricula;
    }

    // declaração de métodos especiais        
       
}
