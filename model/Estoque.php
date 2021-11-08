<?php

require_once 'Produto.php';
require_once 'Conexao.php';
require_once 'Venda.php';

class Estoque
{   
    public int $id_estoque;
    public Produto $produto_fk_estoque;
    public int $quantidade_estoque;
}

function __construct_pessoa()
    {

    }   

function createEstoque($produto_fk_estoque, $quantidade_estoque)
{
    $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
    
    
}

function updateEstoque()
{
}

function deleteEstoque()
{
}

function selectInEstoque()
{
}

function selectAllEstoque()
{
}
