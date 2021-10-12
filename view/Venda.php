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
        global $res; 
        global $res2;

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome = :cn"); // dados retornam como ARRAY
        $dados->bindValue("cn", $cliente); 
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $clienteSelecionado = $res['id_cliente']; 

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome = :vn"); 
        $dados->bindValue("vn", $vendedor); 
        $res2 = $dados->fetch(PDO::FETCH_ASSOC); 
        $vendedorSelecionado = $res2['id_pessoa'];

        $dados = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE data_venda = :dtv");
        $dados->bindValue(":dtv", $data_venda);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO venda (valor_venda_sem_desconto, desconto, 
            valor_venda_com_desconto, tipo_pagamento, data_venda, vendedor, cliente, total_item_venda, 
            status_venda, pessoa_id_pessoa_vendedor, pessoa_id_pessoa_cliente)
            VALUES (:vsd, :dsc, :vcd, :tp, :dtv, :v, :c, :tiv, :stv, :fkv, :fkc)");
            $dados->bindValue(":vsd", $valor_venda_sem_desconto);
            $dados->bindValue(":dsc", $desconto);
            $dados->bindValue(":vcd", $valor_venda_com_desconto);
            $dados->bindValue(":tp", $tipo_pagamento);
            $dados->bindValue(":dtv", $data_venda);
            $dados->bindValue(":v", $vendedor);
            $dados->bindValue(":c", $cliente);
            $dados->bindValue(":tiv", $total_item_venda);
            $dados->bindValue(":stv", $status_venda);
            $dados->bindValue(":fkv", $vendedorSelecionado);
            $dados->bindValue(":fkc", $clienteSelecionado);           
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

public function updateVenda($valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $tipo_pagamento,
$data_venda, $vendedor, $cliente, $total_item_venda,$status_venda, $id_up)
{
    $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome = :cn"); // dados retornam como ARRAY
        $dados->bindValue("cn", $cliente); 
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $clienteSelecionado = $res['id_cliente']; 

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome = :vn"); 
        $dados->bindValue("vn", $vendedor); 
        $res2 = $dados->fetch(PDO::FETCH_ASSOC); 
        $vendedorSelecionado = $res2['id_pessoa'];

    $dados = $conexao->pdo->prepare("UPDATE venda SET valor_venda_sem_desconto = :vsd, desconto = :dsc, 
            valor_venda_com_desconto = :vcd, tipo_pagamento = :tp, data_venda = :dtv, vendedor = :v, 
            cliente = :c, total_item_venda = :tiv, status_venda = :stv, pessoa_id_pessoa_vendedor = :fkv, 
             pessoa_id_pessoa_cliente = :fkc WHERE id_venda = :id");
            $dados->bindValue(":vsd", $valor_venda_sem_desconto);
            $dados->bindValue(":dsc", $desconto);
            $dados->bindValue(":vcd", $valor_venda_com_desconto);
            $dados->bindValue(":tp", $tipo_pagamento);
            $dados->bindValue(":dtv", $data_venda);
            $dados->bindValue(":v", $vendedor);
            $dados->bindValue(":c", $cliente);
            $dados->bindValue(":tiv", $total_item_venda);
            $dados->bindValue(":stv", $status_venda);
            $dados->bindValue(":fkv", $vendedorSelecionado);
            $dados->bindValue(":fkc", $clienteSelecionado);
            $dados->bindValue(":id", $id_up);           
            $dados->execute();
}

public function selectVenda($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

    $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD
 
        $dados  = $conexao->pdo->prepare("SELECT id_venda,  valor_venda_sem_desconto, desconto, valor_venda_com_desconto,
        tipo_pagamento, data_venda, vendedor, cliente, total_item_venda FROM venda WHERE id_venda = :id");
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }

    public function selectAllVenda()
    {
        $dadosSelecionados = array(); 

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT id_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto,
        tipo_pagamento, data_venda, vendedor, cliente, total_item_venda FROM venda ORDER BY data_venda DESC ");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function consultaVendaLikeData($consultaLike)
    {

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT id_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto,
        tipo_pagamento, data_venda, vendedor, cliente, total_item_venda FROM venda WHERE data_venda LIKE :lk ORDER BY data_venda DESC");
        $dados->bindValue(":lk", $consultaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function consultaVendaLikeCliente($consultaLike)
    {

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT id_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto,
        tipo_pagamento, data_venda, vendedor, cliente, total_item_venda FROM venda WHERE cliente LIKE :lk OR ORDER BY data_venda DESC");
        $dados->bindValue(":lk", $consultaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function consultaVendaLikeVendedor($consultaLike)
    {

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT id_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto,
        tipo_pagamento, data_venda, vendedor, cliente, total_item_venda FROM venda WHERE vendedor LIKE :lk ORDER BY data_venda DESC");
        $dados->bindValue(":lk", $consultaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function consultaVendaLikePagamento($consultaLike)
    {

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT id_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto,
        tipo_pagamento, data_venda, vendedor, cliente, total_item_venda FROM venda WHERE tipo_pagamento LIKE :lk ORDER BY data_venda DESC");
        $dados->bindValue(":lk", $consultaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
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