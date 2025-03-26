<?php
namespace App\Enums;


enum InterventionTypeEnum: string {
    case SM = 'Semis';
    case AR = 'Arrosage';
    case FT = 'Fertilisation';
    case TR = 'Traitement';
    case RC = 'Récolte';

    public static function values(): array
    {
        return [
            self::SM,
            self::AR,
            self::FT,
            self::TR,
            self::RC
        ];
    }
}


