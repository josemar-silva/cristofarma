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
        $conexao = new Conexao();

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

    public function estornarVenda($cod_venda)
{
    $conexao = new Conexao();

    $dados = $conexao->pdo->prepare("UPDATE venda SET status_venda = 'cancelado' WHERE id_venda = :cdv");
    $dados->bindValue("cdv", $cod_venda);
    $dados->execute();

    return true;
}

    public function updateVenda($id_venda_up, $pessoa_id_pessoa_vendedor, $pessoa_id_pessoa_Cliente, $data_venda, $tipo_pagamento, $status_venda,
    $valor_venda_sem_desconto, $desconto, $valor_venda_com_desconto, $total_item_venda)
    {
        $conexao = new Conexao();

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

    public function fecharVenda($codigo_venda)
    {
        $conexao = new Conexao();

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE codigo_venda = :cdv"); // dados retornam como ARRAY
        $dados->bindValue("cdv", $codigo_venda);
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $id_venda = $res['id_venda'];

        $dados = $conexao->pdo->prepare("UPDATE venda SET status_venda = 'fechado' WHERE id_venda = :cdv");

        $dados->bindValue(":cdv", $id_venda);
        $dados->execute();

        return true;
    }

    public function selectAllVenda()
    {
        $conexao = new Conexao();

        $dadosSelecionados = array();

        $dados  = $conexao->pdo->query("SELECT * FROM venda ORDER BY data_venda DESC");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectVendaId($id_venda)
    {
        $conexao = new Conexao();

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda WHERE id_venda = :id");
        $dados->bindValue(":id", $id_venda);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectAllVendaAberta()
    {
        $conexao = new Conexao();

        $dadosSelecionados = array();

        $dados  = $conexao->pdo->query("SELECT * FROM venda LEFT JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa WHERE status_venda = 'aberto' 
             ORDER BY data_venda DESC");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectAllVendaFechada()
    {
        $conexao = new Conexao();

        $dadosSelecionados = array();

        $dados  = $conexao->pdo->prepare("SELECT * FROM venda left JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa where status_venda = 'fechado' 
            ORDER BY data_venda DESC");

        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectVendaData( $data_ini, $data_fim)
    {
        $conexao = new Conexao();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda INNER JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa AND status_venda = 'fechado' 
            WHERE data_venda >= :di AND data_venda <= :df ORDER BY data_venda DESC");

        $dados->bindValue(":di", $data_ini);
        $dados->bindValue(":df", $data_fim);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectVendaClienteLike($nomeCliente)
    {
        $conexao = new Conexao();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa AND status_venda = 'fechado'
             WHERE nome LIKE :lk AND tipo_pessoa = 'cliente' ORDER BY data_venda DESC");

        $dados->bindValue(":lk", $nomeCliente);
        $dados->execute();
        $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

       return $dadosPessoaSelecionados;
    }

    // public function selectVendaClienteLikeDataLike($nomeCliente,  $data_ini,  $data_fim)
    // {
    //     $conexao = new Conexao();

    //     $dados = $conexao->pdo->prepare("SELECT * FROM venda LEFT JOIN pessoa ON pessoa_id_pessoa_cliente = id_pessoa AND 
    //          WHERE nome LIKE :lk AND data_venda >= :di AND data_venda <= :df ORDER BY data_venda DESC");

    //     $dados->bindValue(":lk", $nomeCliente);
    //     $dados->bindValue(":di", $data_ini);
    //     $dados->bindValue(":df", $data_fim);
    //     $dados->execute();
    //     $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

    //     return $dadosPessoaSelecionados;
    // }

    public function selectVendaAllLikePagamento($tipoPagamento)
    {
        $conexao = new Conexao();

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda WHERE tipo_pagamento = :tp AND status_venda = 'fechado' ORDER BY data_venda DESC");

        $dados->bindValue(":tp", $tipoPagamento);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function consultaVendaLikeVendedor($nomeVendedor)
    {
        $conexao = new Conexao();

        $dados = $conexao->pdo->prepare("SELECT * FROM venda JOIN pessoa ON pessoa_id_pessoa_vendedor = id_pessoa AND status_venda = 'fechado'
             WHERE nome LIKE :lk AND tipo_pessoa = 'funcionario' AND funcao = 'vendedor' ORDER BY data_venda DESC");

        $dados->bindValue(":lk", $nomeVendedor);
        $dados->execute();
        $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

       return $dadosPessoaSelecionados;
    }

    // public function selectVendaVendedorLikeDataLike($nomeVendedor,  $data_ini,  $data_fim)
    // {
    //     $conexao = new Conexao();

    //     $dados = $conexao->pdo->prepare("SELECT * FROM venda JOIN pessoa ON pessoa_id_pessoa_vendedor = id_pessoa
    //          WHERE nome LIKE :lk AND funcao = 'vendedor' AND data_venda >= :di AND data_venda <= :df ORDER BY data_venda DESC");

    //     $dados->bindValue(":lk", $nomeVendedor);
    //     $dados->bindValue(":di", $data_ini);
    //     $dados->bindValue(":df", $data_fim);

    //     $dados->execute();
    //     $dadosPessoaSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

    //     return $dadosPessoaSelecionados;
    // }

    public function selectVendaAbertaLikeId($idVendaLike)
    {
        $conexao = new Conexao();

        $dados  = $conexao->pdo->prepare("SELECT * FROM venda WHERE id_venda = :id AND status_venda = 'aberto'"); // dados retornam como ARRAY

        $dados->bindValue("id", $idVendaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
       
        return $dadosSelecionados;
    } 

    public function selectVendaFechadaLikeId($idVendaLike)
    {
        $conexao = new Conexao();

        $dados  = $conexao->pdo->prepare("SELECT * FROM venda WHERE id_venda = :id AND status_venda = 'fechado'"); // dados retornam como ARRAY

        $dados->bindValue("id", $idVendaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
       
        return $dadosSelecionados;
    }

    function calculaValorVenda($valor_venda_sem_desconto, $desconto_calculado)
    {

    $valor_venda_com_desconto = $valor_venda_sem_desconto - $desconto_calculado;

    return $valor_venda_com_desconto;

    }

    function calculoFecharVendaCaixa($valor_recebido, $valor_venda)
    {
        
    $troco = $valor_recebido - $valor_venda;

    return $troco;

    }

    function calculaDescontoPorcentagem ($valor_venda_sem_desconto, $porcentagem) {

        $return_procentagem = ($valor_venda_sem_desconto / 100) * $porcentagem;

        return $return_procentagem;
    }    

}


?>