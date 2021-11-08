
<?php

require_once 'Conexao.php';
require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Estoque.php';
require_once 'Pessoa.php';


class ProdutoCompra{
    public int $id_compra;
    public int $quantidade_compra;
    public float $valor_total_compra;
    public Produto $fk_produto;
 

    function __constructPprodutoCompra()
        
    {
        
    }

}

?>