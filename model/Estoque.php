<?php

require_once 'Produto.php';
require_once 'Conexao.php';
require_once 'Venda.php';

class Estoque
{
    public int $produto_id_estoque;
    public int $quantidade;
}

function __construct_pessoa()
    {

    }   

function createEstoque($produto_id_produto,$quantidade)
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
