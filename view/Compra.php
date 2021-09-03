
<?php

require_once 'Conexao.php';
require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Estoque.php';
require_once 'Pessoa.php';


class Compra{
    public int $id;
    public  $dtCompra;
    public Pessoa $fornecedor;
    public $valor_compra;
 

    function __construct_compra()
        
    {
        
    }

}

?>