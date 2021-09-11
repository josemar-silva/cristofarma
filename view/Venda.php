<?php

require_once 'Conexao.php';
require_once 'Produto.php';
require_once 'Estoque.php';
require_once 'Conexao.php';
require_once 'Pessoa.php';


class Venda
{
    // declaração de propriedade
    public string $id_venda;
    public string $valor_venda_sem_desconto;
    public string $desconto;
    public string $valor_venda_com_desconto;
    public string $tipo_pagamento;
    public string $data_venda;
    public Pessoa $vendedor;
    public Pessoa $cliente;
    public string $total_item_venda;

    function __construct()
    {
    
    }

    public function selectVenda($id)
    {
        $vendaSelecionada = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE pessoa_id_pessoa = :id"); // dados retornam como ARRAY
        $dados->bindValue("id", $id); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $vendaSelecionada = $dados->fetch(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        return $vendaSelecionada; //varialvel de retorno da funcao
    }

    //metodos de acesso 
    function __getCodigoVenda()
    {

    }

    function __setCodigoVenda()
    {
        
    }

    function __getValorSemDesconto()
    {

    }

    function __setValorSemDesconto()
    {
        
    }

    function __getDesconto()
    {

    }

    function __setDesconto()
    {
        
    }

    function __getValorComDesconto()
    {

    }

    function __setValorComDesconto()
    {
        
    }

    function __getTipoPagamento()
    {

    }

    function __setTipoPagamento()
    {
        
    }

    function __getDataVenda()
    {

    }

    function __setDataVenda()
    {
        
    }


}

?>