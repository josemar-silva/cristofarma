<?php

require_once 'Produto.php';
require_once 'Conexao.php';
require_once 'Venda.php';

class Estoque
{   
    public int $id_estoque;
    public int $quantidade_estoque;
    public Produto $produto_id_produto;

function __construct_pessoa()
    {

    }   

function createEstoque($quantidade_estoque, $produto_id_produto)
{
    $conexao = new Conexao();
    
    $dados  = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :idp"); 
    $dados->bindValue("idp", $produto_id_produto);
    $dados->execute(); 
    $resturn = $dados->fetch(PDO::FETCH_ASSOC); 
    $id_produto = $resturn['id_produto'];

    $dados = $conexao->pdo->prepare("INSERT INTO estoque (produto_id_produto, quantidade_estoque) VALUES (:idp, :qtd)"); 
    $dados->bindValue("idp", $id_produto);
    $dados->bindValue("qtd", $quantidade_estoque);

    $dados->execute();

    return true;   
}

function updateEstoque($produto_id_produto, $quantidade_estoque)
{
    $conexao = new Conexao();
    
    $dados  = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :idp"); 
    $dados->bindValue("idp", $produto_id_produto);
    $dados->execute(); 
    $resturn = $dados->fetch(PDO::FETCH_ASSOC); 
    $id_produto = $resturn['id_produto'];

    $dados = $conexao->pdo->prepare("UPDATE estoque SET quantidade_estoque = :qtd WHERE produto_id_produto = :idp");
    $dados->bindValue(":qtd", $quantidade_estoque);
    $dados->bindValue(":idp", $id_produto);
    $dados->execute(); 

    return true;
}

function deleteEstoque($produto_id_produto)
{
    $conexao = new Conexao();

    $dados  = $conexao->pdo->prepare("SELECT id_estoque FROM estoque WHERE produto_id_produto = :idp"); 
    $dados->bindValue("idp", $produto_id_produto);
    $dados->execute(); 
    $resturn = $dados->fetch(PDO::FETCH_ASSOC); 
    $id_estoque = $resturn['id_estoque'];

    $dados = $conexao->pdo->prepare(" DELETE FROM estoque WHERE id_estoque = :ide");
    $dados->bindValue("ide", $id_estoque);
    $dados->execute();

    return true;
}

function selectQuantidadeEstoque($produto_id_produto)
{
    $conexao = new Conexao();

    $dados  = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE id_produto = :idp");
    $dados->bindValue("idp", $produto_id_produto);
    $dados->execute();
    $resturn = $dados->fetch(PDO::FETCH_ASSOC);
    $id_produto = $resturn['id_produto'];

    $dados  = $conexao->pdo->prepare("SELECT quantidade_estoque FROM estoque WHERE produto_id_produto = :idp"); 
    $dados->bindValue("idp", $id_produto);
    $dados->execute(); 
    $produto_estoque_quantidade = $dados->fetch(PDO::FETCH_ASSOC); 

    return $produto_estoque_quantidade;
}

function estoqueAdicionar($id_produto_adicionar, $quantidade_produto_adicionar)
{
    $conexao = new Conexao();

    $dados  = $conexao->pdo->prepare("SELECT quantidade_estoque FROM estoque WHERE produto_id_produto = :idp");
    $dados->bindValue("idp", $id_produto_adicionar);
    $dados->execute(); 
    $return_quantidade = $dados->fetch(PDO::FETCH_ASSOC);
    $quantidade_estoque = $return_quantidade['quantidade_estoque'];
    
    $quantidade_estoque_update = (int) $quantidade_estoque + (int) $quantidade_produto_adicionar;

    $this->updateEstoque($id_produto_adicionar, $quantidade_estoque_update);

    return true;
}

function estoqueRemover($id_produto_remover, $quantidade_produto_remover)
{
    $conexao = new Conexao();

    $dados  = $conexao->pdo->prepare("SELECT quantidade_estoque FROM estoque WHERE produto_id_produto = :idp");
    $dados->bindValue("idp", $id_produto_remover);
    $dados->execute(); 
    $return_quantidade = $dados->fetch(PDO::FETCH_ASSOC);
    $quantidade_estoque = $return_quantidade['quantidade_estoque'];
    
    $quantidade_estoque_update = (int) $quantidade_estoque - (int) $quantidade_produto_remover;

    $this->updateEstoque($id_produto_remover, $quantidade_estoque_update);

    return true;
}
 
}
