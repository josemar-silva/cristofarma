<?php
    require_once 'Produto.php';
    require_once 'ItemVenda.php';
    require_once 'Pessoa.php';
    require_once 'Venda.php';
    require_once 'Estoque.php';
    require_once 'Conexao.php';

    class Cupom {

        public Venda $venda_id_venda;


    function __construct_cupom() {

    }

    function createCupomFiscal($codigo_venda_return) {

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE codigo_venda = :cdv"); // dados retornam como ARRAY
        $dados->bindValue("cdv", $codigo_venda_return);
        $dados->execute(); 
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $id_venda = $res['id_venda'];

        $dados  = $conexao->pdo->prepare("INSERT INTO cupom_fiscal (venda_id_venda) VALUE (:idv)");
        $dados->bindValue("idv", $id_venda);
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

    