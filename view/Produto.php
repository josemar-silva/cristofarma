<?php

require_once 'Conexao.php';
require_once 'Fornecedor.php';
require_once 'Pessoa.php';
require_once 'Estoque.php';
require_once 'PessoaJuridica.php';

class Produto extends Conexao
{   
    protected string $id_produto;
    protected string $nome_produto;
    protected string $fornecedor;
    protected string $preco_custo;
    protected string $preco_venda;
    protected string $codigo_barras;

    function __construct()
    {
    }

    public function createProduto($produto_nome, $produto_fornecedor, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $fornecedor_pessoa_juridica_cnpj)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");
        
        $dados = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE nome_produto = :pn");
      
        $dados->bindValue(":pn", $produto_codigo_barras);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {

            $dados = $conexao->pdo->prepare("INSERT INTO produto (nome_produto, fornecedor, preco_custo, preco_venda,
             codigo_barras, fornecedor_pessoa_juridica_cnpj ) VALUES (:pn, :pf, :pc, :pv, :cb, :pfk)");
            $dados->bindValue(":pn", $produto_nome);
            $dados->bindValue(":pf", $produto_fornecedor);            
            $dados->bindValue(":pc", $produto_preco_custo);
            $dados->bindValue(":pv", $produto_preco_venda);
            $dados->bindValue(":cb", $produto_codigo_barras);       
            $dados->bindValue(":pfk", $fornecedor_pessoa_juridica_cnpj);
            $dados->execute();
            
            return true;
    }
    
}
}

?>