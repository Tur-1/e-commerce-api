<?php

namespace App\Modules\Roles\Exceptions;

use Exception; 

class RoleException extends Exception
{
    /**
     * Handle "Record Not Found" exception.
     *
     * @return self
     */
    public static function notFound(): self
    {
        return new self("role not found.", 404);
    }

}
