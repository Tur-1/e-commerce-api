<?php

namespace App\Modules\Admins\Enums;

enum AdminStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    /**
     * Get the displayable name of the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'active',
            self::INACTIVE => 'inactive',
        };
    }
}
