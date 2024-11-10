<?php

namespace App\Modules\Admins\Exceptions;

use Exception;

class AdminException extends Exception
{
    /**
     * Handle "Record Not Found" exception.
     *
     * @return self
     */
    public static function notFound(): self
    {
        return new self("admin not found.", 404);
    }
}
