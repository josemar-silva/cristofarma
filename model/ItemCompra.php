
<?php

    require_once 'Conexao.php';
    require_once 'Produto.php';
    require_once 'Venda.php';
    require_once 'Estoque.php';
    require_once 'Produto.php';



    class ItemCompra{
        
        public int $id_compra;
        public string $data_compra;
        public int $numero_nota; 
        public int $quantidade_compra;
        public Produto $produto_id_produto;

        function __constructProdutoCompra(){   
        }

        public function createItemCompra($data_compra, $numero_nota, $quantidade_compra, $produto_id_produto)
        {
            $conexao = new Conexao();



            $dados = $conexao->pdo->prepare("INSERT INTO item_compra (data_compra, numero_nota, quantidade_compra, produto_id_produto) 
                VALUES (:dc,:nt, :qc, :fkp)");

            $dados->bindValue(":dc", $data_compra);
            $dados->bindValue(":nt", $numero_nota);
            $dados->bindValue(":qc", $quantidade_compra);
            $dados->bindValue(":fkp", $produto_id_produto);

            $dados->execute();

            return true;
        }
    }

?>