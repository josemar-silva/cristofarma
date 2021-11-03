<?php

require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Conexao.php';


class ProdutoVenda
{
    public int $venda_id_venda;
    public int $produto_id_produto;
    public string $quantidade;
    public string $valor;


    function __construct()
    {
    
    }

    public function createProdutoVenda($venda_id_venda, $produto_id_produto){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("INSERT INTO produto_venda (venda_id_venda, produto_id_produto) VALUES (:idv, :idp)");
        $dados->bindValue("idv", $venda_id_venda);
        $dados->bindValue("idp", $produto_id_produto);
        $dados->execute();  

        return true;   
    }

    public function deleteProdutoVenda($venda_id_venda, $produto_id_produto){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare(" DELETE * produto_venda WHERE venda_id_venda = :idv AND produto_id_produto = :idp)");
        $dados->bindValue("idv", $venda_id_venda);
        $dados->bindValue("idp", $produto_id_produto);
        $dados->execute();  

        return true;   
    }

    public function updateProdutoVenda(){

    }

    public function selectProdutoVenda(){

      
    }

    public function selectallProdutoVenda(){

    }

    public function selectProdutoVendalike(){

    }

}

?>