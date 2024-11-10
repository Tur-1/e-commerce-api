<?php

namespace App\Modules\Admins\Enums;

enum AdminGenderEnum: string
{
    case Female = 'female';
    case Male = 'male';

    /**
     * Get the displayable name of the status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female',
        };
    }
}
