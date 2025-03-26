<?php

namespace App\Enums;

enum  StatusEnum :string
{
    case EN_C = 'En culture';
    case EN_J = 'En jachère';
    case RCLT = 'Recoltée';

    public static function values():array{
        return [
            self::EN_C,
            self::EN_J,
            self::RCLT,
        ];
    }
}
