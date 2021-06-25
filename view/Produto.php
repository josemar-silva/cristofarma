<?php

require_once 'Conexao.php';
require_once 'Fornecedor.php';
require_once 'Pessoa.php';
require_once 'Estoque.php';
require_once 'PessoaJuridica.php';

class Produto
{
    // declaração de propriedade
    protected string $nome_produto;
    protected Fornecedor $fonecedor;
    protected string $preco_custo;
    protected string $preco_venda;
    protected string $codigo_barras;

    function __construct()
    {
    }

    //metodos de acesso 

    public function createProduto($produto_nome, $produto_fonecedor, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $quantidade)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
        
        $dados = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE codigo_barras = :cb");
        //$cadastrar = $this->pdo->query("SELECT * id FROM pessoa WHERE email = ".$email);
        $dados->bindValue(":cb", $produto_codigo_barras);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO produto (nome_produto, preco_custo, preco_venda, 
             codigo_barras, fornecedor_pessoa_juridica_cnpj) VALUES (:n, :pc, :pv, :cb, :f)");
            $dados->bindValue(":n", $produto_nome);
            $dados->bindValue(":pc", $produto_preco_custo);
            $dados->bindValue(":pv", $produto_preco_venda);
            $dados->bindValue(":cb", $produto_codigo_barras);
            $dados->bindValue(":f", $produto_fonecedor);
            $dados->execute();

            $dados = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE codigo_barras = :cb");
            $dados->bindValue("cb", $produto_codigo_barras);
            $dados->execute();
            $res = $dados->fetch(PDO::FETCH_ASSOC);
            
            $dados = $conexao->pdo->prepare("INSERT INTO estoque (produto_id_produto, quantidade_estoque) VALUES (:fk, :qnt)");
            $dados->bindValue("fk", $res['id_produto']);
            $dados->bindValue("qnt", $quantidade);
            $dados->execute();
            
            return true;
        }
    }
    
    
}

?>