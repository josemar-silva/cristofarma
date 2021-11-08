<?php

require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Conexao.php';


class ItemVenda
{
    public int $id_item_venda;
    public Venda $venda_id_venda;
    public Produto $produto_id_produto;
    public int $quantidade_item;
    public float $valor_total_item;


    function __construct()
    {
    
    }

    public function createItemVenda($codigo_venda, $produto_id_produto, $quantidade_item, $valor_total_item){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE codigo_venda = :cdv"); // dados retornam como ARRAY
        $dados->bindValue("cdv", $codigo_venda);
        $dados->execute(); 
        $reurn = $dados->fetch(PDO::FETCH_ASSOC);
        $id_venda = $reurn['id_venda'];

        $dados  = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :idp"); 
        $dados->bindValue("idp", $produto_id_produto);
        $dados->execute(); 
        $resturn2 = $dados->fetch(PDO::FETCH_ASSOC); 
        $id_produto = $resturn2['id_produto'];

        $dados = $conexao->pdo->prepare("INSERT INTO item_venda (venda_id_venda, produto_id_produto, quantidade_item, valor_total_item) 
            VALUES (:idv, :idp, :qtd, :vti)");
        $dados->bindValue("idv", $id_venda); 
        $dados->bindValue("idp", $id_produto);
        $dados->bindValue("qtd", $quantidade_item);
        $dados->bindValue("vti", $valor_total_item);
       
        $dados->execute();

        return true;   
    }

    public function deleteItemVenda($venda_id_venda, $produto_id_produto){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare(" DELETE FROM item_venda WHERE venda_id_venda = :fkv AND produto_id_produto = :fkp");
        $dados->bindValue("fkv", $venda_id_venda);
        $dados->bindValue("fkp", $produto_id_produto);
        $dados->execute();
    }

    public function updateItemVenda($codigo_venda, $produto_id_produto, $quantidade_item, $valor_total_item){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE codigo_venda = :cdv"); // dados retornam como ARRAY
        $dados->bindValue("cdv", $codigo_venda);
        $dados->execute();
        $reurn = $dados->fetch(PDO::FETCH_ASSOC);
        $id_venda = $reurn['id_venda'];

        $dados  = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :idp");
        $dados->bindValue("idp", $produto_id_produto);
        $dados->execute();
        $resturn2 = $dados->fetch(PDO::FETCH_ASSOC);
        $id_produto = $resturn2['id_produto'];

        $dados = $conexao->pdo->prepare(" UPDATE item_venda SET quantidade_item = :qtd, valor_total_item = :vti  WHERE venda_id_venda = :fkv AND produto_id_produto = :fkp");
        $dados->bindValue("fkv", $id_venda);
        $dados->bindValue("fkp", $id_produto);
        $dados->bindValue("qtd", $quantidade_item);
        $dados->bindValue("vti", $valor_total_item);
        $dados->execute();

        return true;
    }

    public function selectQuantidadeValor($codigo_venda, $produto_id_produto){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados  = $conexao->pdo->prepare("SELECT id_venda FROM venda WHERE codigo_venda = :cdv"); // dados retornam como ARRAY
        $dados->bindValue("cdv", $codigo_venda);
        $dados->execute();
        $reurn = $dados->fetch(PDO::FETCH_ASSOC);
        $id_venda = $reurn['id_venda'];

        $dados  = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :idp"); 
        $dados->bindValue("idp", $produto_id_produto);
        $dados->execute(); 
        $resturn2 = $dados->fetch(PDO::FETCH_ASSOC);
        $id_produto = $resturn2['id_produto'];

        $dados = $conexao->pdo->prepare(" SELECT quantidade_item, valor_total_item FROM item_venda  WHERE venda_id_venda = :fkv AND produto_id_produto = :fkp");
        $dados->bindValue("fkv", $id_venda);    
        $dados->bindValue("fkp", $id_produto);  
        $dados->execute(); 
    
        $returnQuantidadeValor = $dados->fetch(PDO::FETCH_ASSOC);

        // $quantidadeItem = $returnQuantidadeValor['quantidade_item'];
        // $valorItem = $returnQuantidadeValor['valor_total_item'];

        return $returnQuantidadeValor;
    }

    public function selectItemVendaLike($venda_id_venda, $produto_id_produto){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare(" SELECT * FROM item_venda WHERE venda_id_venda = :viv AND produto_id_produto = :pvp");
        $dados->bindValue("viv", $venda_id_venda);
        $dados->bindValue("pvp", $produto_id_produto);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectAllItemVenda(){

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); 

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare(" SELECT * FROM item_venda");
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;
    }

    public function selectItemVendaId(){

    }

}

?>