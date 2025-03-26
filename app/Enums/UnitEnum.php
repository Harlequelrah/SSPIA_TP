<?php
namespace App\Enums;


enum UnitEnum: string {
    case L = 'Litre';
    case KG = 'Kilogramme';

    public static function values(): array
    {
return array_column(UnitEnum::cases(), 'value');

    }
}


