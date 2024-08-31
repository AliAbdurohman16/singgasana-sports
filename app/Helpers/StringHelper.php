<?php

namespace App\Helpers;

class StringHelper
{
    public static function formatCurrency($number): string
    {
        return 'Rp ' . number_format($number, 0, ',', '.');
    }
}