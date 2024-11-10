<?php

namespace App\Modules\Auth\Exceptions;

use Exception; 

class AuthException extends Exception
{
    /**
     * Handle "Record Not Found" exception.
     *
     * @return self
     */
    public static function notFound(): self
    {
        return new self("auth not found.", 404);
    }

}
