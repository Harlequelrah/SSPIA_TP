<?php
namespace App\Enums;


enum RoleEnum: string {
    case ADMIN = 'Administrateur';
    case AGRICULTEUR = 'Agriculteur';

    public static function values(): array
    {
        return [
            self::ADMIN,
            self::AGRICULTEUR
        ];
    }
}


