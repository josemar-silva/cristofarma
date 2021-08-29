<?php

require_once 'Conexao.php';
require_once 'Endereco.php';

abstract class Pessoa extends Conexao

{
    // declaração de propriedade
    protected string $id_pessoa;
    protected string $nome;
    protected string $email;
    protected Endereco $endereço;
    protected string $telefoneFixo;
    protected string $telefoneCelular;
    
    // método contrutor
    function __construct() 
    {

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