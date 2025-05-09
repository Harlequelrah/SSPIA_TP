<?php
namespace App\Enums;


enum UnitEnum: string {
    case L = 'Litre';
    case KG = 'Kilogramme';
    case T = 'Tone';

    public static function values(): array
    {
return array_column(UnitEnum::cases(), 'value');

    }
}


