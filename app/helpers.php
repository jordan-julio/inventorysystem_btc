<?php

function format_money($money)
{
    if(!$money) {
        return "Rp.0.00";
    }

    $money = number_format($money, 0);

    if(strpos($money, '-') !== false) {
        $formatted = explode('-', $money);
        return "Rp.$formatted[1]";
    }

    return "Rp.$money";
}

function format_money_int($money)
{
    if (!$money) {
        return doubleval(0,00);
    } else {
        return number_format($money, 0, "", ".");
    }
}