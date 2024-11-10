<?php

namespace App\Modules\Users\Exceptions;

use Exception; 

class UserException extends Exception
{
    /**
     * Handle "Record Not Found" exception.
     *
     * @return self
     */
    public static function notFound(): self
    {
        return new self("user not found.", 404);
    }

}
