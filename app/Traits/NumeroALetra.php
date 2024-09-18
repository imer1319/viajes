<?php

namespace App\Traits;
use Luecano\NumeroALetras\NumeroALetras;

trait NumeroALetra
{
    function convertirNumeroALetras($number)
    {
        $formatter = new NumeroALetras();
        $formatter->conector = 'Y';
        $formatter->apocope = true;
       return $formatter->toInvoice($number, 2, 'pesos', 'centavos');
    }
}
