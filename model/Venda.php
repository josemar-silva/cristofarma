<?php

require_once 'Conexao.php';
require_once 'Produto.php';
require_once 'Estoque.php';
require_once 'Pessoa.php';
require_once 'ItemVenda.php';

class Venda
{
    public int $id_venda;
    public int $codigo_venda;
    public Pessoa $pessoa_id_pessoa_vendedor;
    public Pessoa $pessoa_id_pessoa_Cliente;
    public string $data_venda;
    public string $tipo_pagamento;
    public string $status_venda;
    public float $valor_venda_sem_desconto;
    public float $desconto;
    public float $valor_venda_com_desconto;
    public int $total_item_venda;    
    

    function __construct()
    {
    
    }

    public function createVenda($codigo_venda, $pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_Cliente, $data_venda, $tipo_pagamento, $status_venda,
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

            $dados = $conexao->pdo->prepare("INSERT INTO venda (codigo_venda, pessoa_id_pessoa_vendedor, pessoa_id_pessoa_Cliente, data_venda,
                tipo_pagamento, status_venda, valor_venda_sem_desconto, desconto, valor_venda_com_desconto, total_item_venda)
                    VALUES (:id, :fkv, :fkc, :dt, :tp, :stv, :vsd, :d, :vcd, :tiv)");
            $dados->bindValue(":id", $codigo_venda);
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

    public function deleteVenda($data_venda, $idClienteVenda)
{
    $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

    $fk_venda = array();

    $dados = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE data_venda = :dv AND pessoa_id_pessoa_cliente = :fkp");
    $dados->bindValue("dv", $data_venda);
    $dados->bindValue("fkp", $idClienteVenda);
    $dados->execute();
    $res = $dados->fetch(PDO::FETCH_ASSOC);
    $fk_venda = $res[0]['id_venda'];

    $dados = $conexao->pdo->prepare("DELETE FROM venda WHERE codigo_venda = :id");
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
        
        $dados = $conexao->pdo->prepare("UPDATE venda SET codigo_venda = :id, pesoa_id_pessoa_vendedor = :fkv, pesoa_id_pessoa_clinte = :fkc, 
            produto.preco_custo = :pc, data_venda = :dt, tipo_pagamento = :tp, status_venda = :stv, valor_venda_sem_desconto = :vsd,
                desconto = :d, valor_venda_com_desconto = :vcd, total_item_venda = :tiv WHERE codigo_venda = :id");

            $dados->bindValue(":id", $id_venda_up);
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
    }

    public function selectAllVenda()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados  = $conexao->pdo->query("SELECT * FROM venda ORDER BY data_venda DESC");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectVendaIdRelatorio($idVendaLike)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT * FROM venda WHERE codigo_venda LIKE :id AND status_venda = 'fechado'"); // dados retornam como ARRAY
        $dados->bindValue("id", $idVendaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);    
       
        return $dadosSelecionados;
    }

    public function selectVendaLikeCpf($buscaCpf)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE cpf_cnpj = :cpf"); // dados retornam como ARRAY
        $dados->bindValue("cpf", $buscaCpf);
        $dados->execute();
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC);
        $idPessoa = $dadosSelecionados['id_pessoa'];

        $dados  = $conexao->pdo->prepare("SELECT * FROM venda WHERE pessoa_id_pessoa_cliente = :fk  AND status_venda = 'fechado' "); // dados retornam como ARRAY
        $dados->bindValue("fk", $idPessoa);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
       
        return $dadosSelecionados;
    }

    public function selectAllVendaAberta()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados  = $conexao->pdo->query("SELECT * FROM venda LEFT JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa WHERE status_venda = 'aberto' 
             ORDER BY data_venda DESC");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectAllVendaFechada()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados  = $conexao->pdo->query("SELECT * FROM venda left JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa where status_venda = 'fechado' 
            ORDER BY data_venda DESC");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectVendaData( $data_ini, $data_fim)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT * FROM venda INNER JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa WHERE data_venda >= :di 
            AND data_venda <= :df ORDER BY data_venda DESC");
        $dados->bindValue(":di", $data_ini);
        $dados->bindValue(":df", $data_fim);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectVendaClienteLike($nomeCliente)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT * FROM venda JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa
             WHERE nome LIKE :lk AND tipo_pessoa = 'cliente'");
        $dados->bindValue(":lk", $nomeCliente);
        $dados->execute();
        $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

       return $dadosPessoaSelecionados;
    }

    public function selectVendaClienteLikeDataLike($nomeCliente,  $data_ini,  $data_fim)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT * FROM venda LEFT JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa AND 
             WHERE nome LIKE :lk AND data_venda >= :di AND data_venda <= :df ORDER BY data_venda DESC");
        $dados->bindValue(":lk", $nomeCliente);
        $dados->bindValue(":di", $data_ini);
        $dados->bindValue(":df", $data_fim);
        $dados->execute();
        $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosPessoaSelecionados;
    }

    public function selectVendaAllLikePagamento($tipoPagamento)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda WHERE tipo_pagamento = :tp ORDER BY data_venda DESC");
        $dados->bindValue(":tp", $tipoPagamento);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function consultaVendaLikeVendedor($nomeVendedor)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT * FROM venda JOIN pessoa ON pessoa_id_pessoa_vendedor = id_pessoa
             WHERE nome LIKE :lk AND tipo_pessoa = 'funcionario' AND funcao = 'vendedor'");
        $dados->bindValue(":lk", $nomeVendedor);
        $dados->execute();
        $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

       return $dadosPessoaSelecionados;
    }

    public function selectVendaVendedorLikeDataLike($nomeVendedor,  $data_ini,  $data_fim)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT * FROM venda JOIN pessoa ON pessoa_id_pessoa_vendedor = id_pessoa
             WHERE nome LIKE :lk AND funcao = 'vendedor' AND data_venda >= :di AND data_venda <= :df ORDER BY data_venda DESC");
        $dados->bindValue(":lk", $nomeVendedor);
        $dados->bindValue(":di", $data_ini);
        $dados->bindValue(":df", $data_fim);

        $dados->execute();
        $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosPessoaSelecionados;
    }

    public function selectVendaAbertaLikeId($idVendaLike)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT * FROM venda WHERE id_venda = :id AND status_venda = 'aberto'"); // dados retornam como ARRAY
        $dados->bindValue("id", $idVendaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
       
        return $dadosSelecionados;
    }

    public function selectVendaProdutoVenda($data_venda,  $pessoa_id_pessoa_cliente)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT codigo_venda FROM venda WHERE data_venda = :id AND pessoa_id_pessoa_cliente = :fk"); // dados retornam como ARRAY
        $dados->bindValue("id", $data_venda);
        $dados->bindValue("fk", $pessoa_id_pessoa_cliente);
        $dados->execute();
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC);
       
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