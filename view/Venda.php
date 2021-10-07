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
    public string $status_venda;


    function __construct()
    {
    
    }

    public function createVenda($valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $tipo_pagamento,
    $data_venda, $vendedor, $cliente, $total_item_venda,$status_venda)
    {
        $clienteSelecionado = array(); 
        $vendedorSelecionado = array();

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome = :cn"); // dados retornam como ARRAY
        $dados->bindValue("cn", $cliente); 
        $dados->execute(); 
        $clienteSelecionado = $dados->fetch(PDO::FETCH_ASSOC); 

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome = :vn"); 
        $dados->bindValue("vn", $vendedor); 
        $vendedorSelecionado = $dados->fetch(PDO::FETCH_ASSOC); 

        $dados = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE data_venda = :dtv");
        $dados->bindValue(":dtv", $data_venda);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO venda (valor_venda_sem_desconto, desconto, 
            valor_venda_com_desconto, tipo_pagamento, data_venda, vendedor, cliente, total_item_venda, status_venda)
            VALUES (:vsd, :dsc, :vcd, :tp, :dtv, :v, :c, :tiv, :stv)");
            $dados->bindValue(":vsd", $valor_venda_sem_desconto);
            $dados->bindValue(":dsc", $desconto);
            $dados->bindValue(":vcd", $valor_venda_com_desconto);
            $dados->bindValue(":tp", $tipo_pagamento);
            $dados->bindValue(":dtv", $data_venda);
            $dados->bindValue(":v", $vendedor);
            $dados->bindValue(":c", $cliente);
            $dados->bindValue(":tiv", $total_item_venda);
            $dados->bindValue(":stv", $status_venda);

            $dados->execute();

            return true;
    }
}

    public function deleteVenda($id_up)
{
    $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

    $dados = $conexao->pdo->prepare("DELETE FROM venda WHERE id_venda = :id");
    $dados->bindValue("id", $id_up);
    $dados->execute();
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