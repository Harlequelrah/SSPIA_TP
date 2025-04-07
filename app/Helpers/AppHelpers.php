<?php

namespace App\Helpers;

class AppHelpers
{
    public static function initials(string $name): string
    {
        return collect(explode(' ', $name))
            ->map(fn($word) => strtoupper($word[0]))
            ->implode('');
    }
}

