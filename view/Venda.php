<?php

require_once 'Conexao.php';
require_once 'Produto.php';
require_once 'Estoque.php';
require_once 'Pessoa.php';
require_once 'PrudutoVenda.php';

class Venda
{
    public string $id_venda;
    public string $pessoa_id_pessoa_vendedor;
    public string $pessoa_id_pessoa_Cliente;
    public string $data_venda;
    public string $tipo_pagamento;
    public string $status_venda;
    public string $valor_venda_sem_desconto;
    public string $desconto;
    public string $valor_venda_com_desconto;
    public string $total_item_venda;    
    

    function __construct()
    {
    
    }

    public function createVenda($pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_Cliente, $data_venda, $tipo_pagamento, $status_venda,
    $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $total_item_venda)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");


        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE id_pessoa = :fk"); // dados retornam como ARRAY
        $dados->bindValue("fk", $pessoa_id_pessoa_vendedor);
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $fk_vendedor = $res['id_pessoa'];

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE id_pessoa = :fk"); 
        $dados->bindValue("fk", $pessoa_id_pessoa_Cliente);
        $dados->execute(); 
        $res2 = $dados->fetch(PDO::FETCH_ASSOC); 
        $fk_cliente = $res2['id_pessoa'];

        $dados = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE data_venda = :dt");
        $dados->bindValue(":dt", $data_venda);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO venda (pessoa_id_pessoa_vendedor, pessoa_id_pessoa_Cliente, data_venda,
                tipo_pagamento, status_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto, total_item_venda)
                    VALUES (:fkv, :fkc, :dt, :tp, :stv, :vsd, :d, :vcd, :tiv)");
            $dados->bindValue(":fkv", $fk_vendedor);
            $dados->bindValue(":fkc", $fk_cliente);
            $dados->bindValue(":dt", $data_venda);
            $dados->bindValue(":tp", $tipo_pagamento);
            $dados->bindValue(":stv", $status_venda);
            $dados->bindValue(":vsd", $valor_venda_sem_desconto);
            $dados->bindValue(":d", $desconto);
            $dados->bindValue(":vcd", $valor_venda_com_desconto);
            $dados->bindValue(":tiv", $total_item_venda);        
            $dados->execute();

            return true;
    }
}

    public function deleteVenda($data_venda, $idClienteVenda)
{
    $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

    $fk_venda = array();

    $dados = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE data_venda = :dv AND pessoa_id_pessoa_cliente = :fkp");
    $dados->bindValue("dv", $data_venda);
    $dados->bindValue("fkp", $idClienteVenda);
    $dados->execute();
    $res = $dados->fetch(PDO::FETCH_ASSOC);
    $fk_venda = $res['id_venda'];

    $dados = $conexao->pdo->prepare("DELETE FROM venda WHERE id_venda = :id");
    $dados->bindValue("id", $fk_venda);
    $dados->execute();
}

    public function updateVenda($id_venda_up, $pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_Cliente, $data_venda, $tipo_pagamento, $status_venda,
    $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $total_item_venda)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE id_pessoa = :fk"); // dados retornam como ARRAY
        $dados->bindValue("fk", $pessoa_id_pessoa_vendedor);
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $fk_vendedor = $res['id_pessoa'];

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE id_pessoa = :fk"); 
        $dados->bindValue("fk", $pessoa_id_pessoa_Cliente);
        $dados->execute(); 
        $res2 = $dados->fetch(PDO::FETCH_ASSOC); 
        $fk_cliente = $res2['id_pessoa'];
        
        $dados = $conexao->pdo->prepare("UPDATE venda SET pesoa_id_pessoa_vendedor = :fkv, pesoa_id_pessoa_clinte = :fkc, 
            produto.preco_custo = :pc, data_venda = :dt, tipo_pagamento = :tp, status_venda = :stv, valor_venda_sem_desconto = :vsd,
                desconto = :d, valor_venda_com_desconto = :vcd, total_item_venda = :tiv WHERE id_venda = :id");
       
            $dados->bindValue(":fkv", $fk_vendedor);
            $dados->bindValue(":fkc", $fk_cliente);
            $dados->bindValue(":dt", $data_venda);
            $dados->bindValue(":tp", $tipo_pagamento);
            $dados->bindValue(":stv", $status_venda);
            $dados->bindValue(":vsd", $valor_venda_sem_desconto);
            $dados->bindValue(":d", $desconto);
            $dados->bindValue(":vcd", $valor_venda_com_desconto);
            $dados->bindValue(":tiv", $total_item_venda); 
            $dados->bindValue(":id", $id_venda_up);
            $dados->execute();
    }

    public function selectVenda($id_venda_up)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda WHERE id_venda = :id ORDER BY data_venda DESC");
        $dados->bindValue(":id", $id_venda_up);
        $dados->execute();
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC);
        
        return $dadosSelecionados;
    
    }

    public function selectAllVenda()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT * FROM venda ORDER BY data_venda DESC");
    
        $dados->execute();
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC);
        
        return $dadosSelecionados;
    }

    public function consultaVendaLikeData()
    {


    }

    public function consultaVendaLikeCliente()
    {

        
    }

    public function consultaVendaLikeVendedor()
    {


    }

    public function consultaVendaPagamento()
    {

       
    }

    public function consultaVendaStatus()
    {

       
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