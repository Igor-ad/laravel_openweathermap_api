<?php

declare(strict_types=1);

namespace App\Enums;

enum UserStatusEnum: string
{
    case TRUE = 'Active';
    case FALSE = 'Deactivated';

    public static function casts(bool $status): string
    {
        if ($status) {
            return UserStatusEnum::TRUE->value;
        } else {
            return UserStatusEnum::FALSE->value;
        }
    }
}
