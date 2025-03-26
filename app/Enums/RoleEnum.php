<?php
namespace App\Enums;


enum RoleEnum: string {
    case ADMIN = 'Administrateur';
    case AGRICULTEUR = 'Agriculteur';

    public static function values(): array
    {
        return array_column(RoleEnum::cases(), 'value');

    }
}


