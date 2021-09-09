<?php

require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'Estoque.php';
require_once 'Venda.php';

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
        public function createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $produto_fornecedor, $quantidade_estoque)
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

            global $res3;
            $dados = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE codigo_barras  = :cb");
            $dados->bindValue(":cb", $produto_codigo_barras);
            $dados->execute();
            $res = $dados->fetch(PDO::FETCH_ASSOC);
            $res3 = $res['id_produto'];
            
            $dados = $conexao->pdo->prepare("INSERT INTO estoque (produto_id_produto, quantidade)
            VALUES (:fk, :qtd)");
            $dados->bindValue(":fk", $res3);
            $dados->bindValue(":qtd", $quantidade_estoque);
            $dados->execute();
                
            return true;
        }
    }

        public function selectProduto($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", ""); // instancia nova conexão com o BD
 
        $dados  = $conexao->pdo->prepare("SELECT * FROM produto WHERE id_produto = :id" ); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }   

    public function deleteProduto($id_up)
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dados = $conexao->pdo->prepare("DELETE FROM produto WHERE id_produto = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();
    }

    public function selectAllProduto()
    {
        $conexao = new Conexao("projeto_cristofarma", "localhost", "root", "");

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM produto ORDER BY id_produto");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }
}
 
?>