<?php

namespace App\Enums;

enum  StatusEnum :string
{
    case EN_C = 'En culture';
    case EN_J = 'En jachère';
    case RCLT = 'Recoltée';

    public static function values():array{
        return array_column(StatusEnum::cases(), 'value');

    }
}
