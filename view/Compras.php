
<?php
class Compras{
    public int $id;
    public  $dtCompra;
    public Fornecedor $fornecedor;
    public $dtBaixa;
    public $dtRecebimento;
    public $numeroNf;
    public $chaveNf;
    public $situacao;
    public $status;
    public $vlrTotal;
    public $vlrDesconto;
    public $vlrLiquido; 
 

    public function AlertaBaixa(){
        echo "Baixa realizada com sucesso!";
    }
    public function RealizarBaixa(){
        echo $this-> situacao;
    }

}

?>