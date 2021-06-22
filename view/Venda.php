<?php
class Venda
{
    // declaração de propriedade
    protected string $codigo_venda;
    protected string $valor_venda_sem_desconto;
    protected string $desconto;
    protected string $valor_venda_com_desconto;
    protected string $tipo_pagamento;
    protected string $data_venda;

    function __construct(string $codigo_venda, string $valor_venda_sem_desconto)
    {
        $this->codigoVenda = $codigo_venda;
        $this->valorVendaSemDesconto = $valor_venda_sem_desconto;
    }

    //metodos de acesso 
    function __getCodigoVenda()
    {

    }

    function __setCodigoVenda()
    {
        
    }

    function __getValorSemDesconto()
    {

    }

    function __setValorSemDesconto()
    {
        
    }

    function __getDesconto()
    {

    }

    function __setDesconto()
    {
        
    }

    function __getValorComDesconto()
    {

    }

    function __setValorComDesconto()
    {
        
    }

    function __getTipoPagamento()
    {

    }

    function __setTipoPagamento()
    {
        
    }

    function __getDataVenda()
    {

    }

    function __setDataVenda()
    {
        
    }


}

?>