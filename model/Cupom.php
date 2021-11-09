<?php
    require_once 'Produto.php';
    require_once 'ItemVenda.php';
    require_once 'Pessoa.php';
    require_once 'Venda.php';
    require_once 'Estoque.php';
    require_once 'Conexao.php';

    class Cupom {

        public Venda $venda_id_venda;
        public int $codigo_venda;
        public float $valor_venda;
        public float $valor_recebido;
        public float $troco;
        public string $cliente;



    function __construct_cupom() {

    }

    function createCupomFiscal($codigo_venda, $valor_venda, $valor_recebido, $troco, $cliente) {

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE codigo_venda = :cdv"); // dados retornam como ARRAY
        $dados->bindValue("cdv", $codigo_venda);
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $id_venda = $res['id_venda'];

        $dados  = $conexao->pdo->prepare("INSERT INTO cupom_fiscal (venda_id_venda, valor_venda, valor_recebido, troco, cliente) 
            VALUES (:idv, :vv, :vr, :t, :c)");
        $dados->bindValue("idv", $id_venda);
        $dados->bindValue("vv", $valor_venda);
        $dados->bindValue("vr", $valor_recebido);
        $dados->bindValue("t", $troco);
        $dados->bindValue("c", $cliente);

        $dados->execute();

        return true;
    }

    function deleteCupomFiscal() {

    }

    function updateCupomFiscal() {

    }

    function selectCupomFiscalLikeId() {

    }

    function selectCupomFiscalAll() {

    }
}


?>

    