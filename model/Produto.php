<?php

require_once 'Conexao.php';
require_once 'Pessoa.php';
require_once 'Estoque.php';
require_once 'Venda.php';

class Produto 
{   
    public int $id_produto;
    public string $nome_produto;
    public float $preco_custo;
    public float $preco_venda;
    public string $codigo_barras;
    public Pessoa $pessoa_id_pessoa;


    function __construct()
    {

    }
        public function createProduto($produto_nome, $produto_preco_custo, $produto_preco_venda, $produto_codigo_barras, $pessoa_id_pessoa)
    {
        $conexao = new Conexao();

        global $res2;
        $dados = $conexao->pdo->prepare("SELECT id_pessoa FROM pessoa WHERE nome  = :f");
        $dados->bindValue(":f", $pessoa_id_pessoa);
        $dados->execute();
        $res = $dados->fetchAll(PDO::FETCH_ASSOC);
        $res2 = $res['id_pessoa'];        
        
        $dados = $conexao->pdo->prepare("SELECT id_produto FROM produto WHERE codigo_barras = :cb");
        //$cadastrar = $this->pdo->query("SELECT * id FROM pessoa WHERE email = ".$email);
        $dados->bindValue(":cb", $produto_codigo_barras);
        $dados->execute();
        if ($dados->rowCount() > 0) {
            return false;
        } else {
            $dados = $conexao->pdo->prepare("INSERT INTO produto (nome_produto, preco_custo, preco_venda, 
            codigo_barras, pessoa_id_pessoa)
            VALUES (:pn, :pc, :pv, :cb, :pfk)");
            $dados->bindValue(":pn", $produto_nome);
            $dados->bindValue(":pc", $produto_preco_custo);
            $dados->bindValue(":pv", $produto_preco_venda);
            $dados->bindValue(":cb", $produto_codigo_barras);
            $dados->bindValue(":pfk", $res2);
            $dados->execute();
                
            return true;
        }
    }

        public function selectProduto($id_up)
    {
        $dadosSelecionados = array(); // cria-se uma variavel ARRAY que armanenará a busca que o PDO retorna como ARRAY

        $conexao = new Conexao();
 
        $dados  = $conexao->pdo->prepare("SELECT * FROM produto WHERE id_produto = :id" ); // dados retornam como ARRAY
        $dados->bindValue("id", $id_up); // substituíção dos valores com o método BINDVALUE
        $dados->execute(); // comando que executa a busca no BD
        $dadosSelecionados = $dados->fetch(PDO::FETCH_ASSOC); // método fatch retorana um ARRAY, fatchAll retorna uma matriz
        
        return $dadosSelecionados; //varialvel de retorno da funcao
    }   

    public function deleteProduto($id_up)
    {
        $conexao = new Conexao();

        $dados = $conexao->pdo->prepare("DELETE FROM produto WHERE id_produto = :id");
        $dados->bindValue("id", $id_up);
        $dados->execute();
    }

    public function selectAllProduto()
    {
        $conexao = new Conexao();

        $dadosSelecionados = array();
        $dados  = $conexao->pdo->query("SELECT * FROM produto ORDER BY nome_produto");
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);
        return $dadosSelecionados;
    }

    public function updateProduto($id_up, $produto_nome, $produto_preco_custo, $produto_preco_venda, 
        $produto_codigo_barras)
    {
        $conexao = new Conexao();
        
        $dados = $conexao->pdo->prepare("UPDATE produto SET produto.nome_produto = :pn, produto.preco_custo = :pc, 
        produto.preco_venda = :pv, produto.codigo_barras = :cb WHERE produto.id_produto = :id");
        $dados->bindValue(":pn", $produto_nome);
        $dados->bindValue(":pc", $produto_preco_custo);
        $dados->bindValue(":pv", $produto_preco_venda);
        $dados->bindValue(":cb", $produto_codigo_barras);
        $dados->bindValue(":id", $id_up);
        $dados->execute();

        return true;
}
    public function consultaProdutoLike($consultaLike){

        $conexao = new Conexao();

        $dadosSelecionados = array();

        $dados = $conexao->pdo->prepare("SELECT * FROM produto WHERE nome_produto LIKE :lk ORDER BY nome_produto ASC");
        $dados->bindValue(":lk", $consultaLike);
        $dados->execute();
        $dadosSelecionados = $dados->fetchAll(PDO::FETCH_ASSOC);

        return $dadosSelecionados;

    }

}
 
?>