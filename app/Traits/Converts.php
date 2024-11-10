<?php

namespace App\Traits;

trait Converts
{
    public static function convert_money_to_double($value)
    {
        return str_replace(",", "", $value);
    }
    public static function conver_double_to_money($value)
    {
        return number_format($value, 0);
    }
}
