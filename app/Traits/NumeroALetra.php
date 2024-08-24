<?php

namespace App\Traits;

trait NumeroALetra
{
    function convertirNumeroALetras($number)
    {
        $units = ['', 'mil', 'millón', 'mil millones', 'billón'];
        $words = '';

        $number = number_format($number, 2, '.', '');
        list($integerPart, $decimalPart) = explode('.', $number);

        $integerPart = str_split(strrev((string) $integerPart), 3);

        foreach ($integerPart as $key => $part) {
            $part = strrev($part);
            $words = $this->convertThreeDigitNumber($part) . ' ' . $units[$key] . ' ' . $words;
        }

        $words = ucfirst(trim($words)) . " con $decimalPart/100";

        return "Pesos: $words";
    }

    function convertThreeDigitNumber($number)
    {
        $ones = ['', 'uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez', 'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'];
        $tens = ['', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'];
        $hundreds = ['', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos', 'setecientos', 'ochocientos', 'novecientos'];

        $result = '';

        if ($number == '100') {
            return 'cien';
        }

        $number = str_pad($number, 3, '0', STR_PAD_LEFT);

        $result .= $hundreds[$number[0]] . ' ';

        // Caso especial para números entre 21 y 29
        if ($number[1] == '2' && $number[2] != '0') {
            $result .= 'veinti' . $ones[$number[2]];
        } else {
            $result .= $tens[$number[1]];
            if ($number[1] != '0' && $number[2] != '0') {
                $result .= ' y ';
            }
            $result .= $ones[$number[2]];
        }

        return trim($result);
    }
}
