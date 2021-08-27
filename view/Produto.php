<?php

require_once 'Conexao.php';
require_once 'Fornecedor.php';
require_once 'Pessoa.php';
require_once 'Estoque.php';
require_once 'PessoaJuridica.php';

class Produto extends Conexao
{
    // declaração de propriedade
    protected string $nome_produto;
    protected string $fornecedor;
    protected string $preco_custo;
    protected string $preco_venda;
    protected string $codigo_barras;

    function __construct()
    {
    }

    //metodos de acesso 

    public function createProduto($produto_nome, $produto_fornecedor, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_quantidade)
    {
        
       
    }
    
    
}

?>