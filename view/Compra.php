
<?php

require_once 'Conexao.php';
require_once 'Produto.php';
require_once 'Venda.php';
require_once 'Estoque.php';
require_once 'Pessoa.php';


class Compra{
    public int $id_compra;
    public string $data_compra;
    public string $valor_compra;
    public string $numero_nota;
    public Pessoa $fornecedor;
    public string $valor_compra;
 

    function __construct_compra()
        
    {
        
    }

}

?>