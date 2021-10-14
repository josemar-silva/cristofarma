<?php

require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Conexao.php';


class ProdutoVenda
{
    public Produto $produto_id_produto;
    public Venda $venda_id_venda; 
    public string $quantidade;

    function __construct()
    {
    
    }

    public function createProdutoVenda($id_produto, $id_venda){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        global $res;
        global $res2;

        $dados = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :id");
        $dados->bindValue(":id", $id_produto);
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $idProduto = $res['id_produto'];
        
        $dados = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE id_venda = :id");
        $dados->bindValue(":id", $id_venda);
        $res2 = $dados->fetch(PDO::FETCH_ASSOC);
        $idVenda = $res2['id_venda'];
        
        $dados = $conexao->pdo->prepare(" INSERT INTO produto_venda (produto_id_produto, venda_id_venda) 
            VALUES (:ip, :iv)");

            $dados->bindValue(":ip", $idProduto);
            $dados->bindValue(":iv", $idVenda);
            $dados->execute();
    }

    public function deleteProdutoVenda($id_produto, $id_venda){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare(" DELETE FROM produto_venda WHERE produto_id_produto = :idp
            AND venda_id_venda = :idv");

            $dados->bindValue(":idp", $id_produto);
            $dados->bindValue(":idv", $id_venda);
            $dados->execute();
    }

    public function updateProdutoVenda($id_produto, $id_venda){

    }

    public function selectProdutoVenda($id_produto, $id_venda){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("SELECT produto.nome_produto, produto.produto_fornecedor");
    }

    public function selectallProdutoVenda($id_produto, $id_venda){

    }

    public function selectProdutoVendalike(){

    }

}

?>