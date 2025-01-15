<?php

declare(strict_types=1);

namespace App\Enums;

enum ProviderEnum: string
{
    case USERS = 'users';
    case GOOGLE = 'google';

    public static function has(string $provider): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $provider) {
                return true;
            }
        }
        return false;
    }

    public static function check(string $provider): ?string
    {
        if (self::has($provider)) {
            return $provider;
        }

        return null;
    }

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
