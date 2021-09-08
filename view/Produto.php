<?php

require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'Estoque.php';

class Produto 
{   
    public string $id_produto;
    public string $nome_produto;
    public string $preco_custo;
    public string $preco_venda;
    public string $codigo_barras;
    public Pessoa $produto_fornecedor;

    function __construct()
    {

    }

        public function createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_fornecedor)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        global $res2;
        $dados = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome  = :f");
        $dados->bindValue(":f", $produto_fornecedor);
        $dados->execute();
        $res = $dados->fetch(PDO::FETCH_ASSOC);
        $res2 = $res['id_pessoa'];        
        
        $dados = $conexao->pdo->prepare("SELECT id_produto  FROM produto WHERE codigo_barras = :cb");
        //$cadastrar = $this->pdo->query("SELECT * id FROM pessoa WHERE email = ".$email);
        $dados->bindValue(":cb", $produto_codigo_barras);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO produto (nome_produto, preco_custo, preco_venda, codigo_barras, produto_fornecedor, pessoa_id_pessoa)
            VALUES (:pn, :pc, :pv, :cb, :pf, :pfk)");
            $dados->bindValue(":pn", $produto_nome);
            $dados->bindValue(":pc", $produto_preco_custo);
            $dados->bindValue(":pv", $produto_preco_venda);
            $dados->bindValue(":cb", $produto_codigo_barras);
            $dados->bindValue(":pf", $produto_fornecedor);
            $dados->bindValue(":pfk", $res2);
            $dados->execute();
            
            return true;
        }
    }
}
 
?>