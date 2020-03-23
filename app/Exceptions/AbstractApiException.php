<?php
declare(strict_types=1);

namespace App\Exceptions;

use App\Interfaces\ApiExceptionInterface;
use Exception;

/**
 * Base exception for all Api exceptions.
 */
abstract class AbstractApiException extends Exception implements ApiExceptionInterface
{
    //
}
