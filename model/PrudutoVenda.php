<?php

require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Conexao.php';


class ProdutoVenda
{
    public Venda $venda_id_venda;
    public Produto $produto_id_produto;
    public string $quantidade;
    public string $valor;


    function __construct()
    {
    
    }

    public function createProdutoVenda($idVenda, $idProduto){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("INSERT INTO produto_venda (venda_id_venda, produto_id_produto) VALUES (:idv, :idp)");
        $dados->bindValue("idv", $idVenda);
        $dados->bindValue("idp", $idProduto);
        $dados->execute();

        return true;   
    }

    public function deleteProdutoVenda(){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        
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