<?php

namespace miguel\BacalhauBundle\Api\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use miguel\BacalhauBundle\Api\Exception;

/**
 * Not Implemented Api Exception class
 *
 * @author miguel
 */
class NotImplementedException extends Exception
{
    //@TODO make better good stuff
    public function __construct($message)
    {
        parent::__construct($message, JsonResponse::HTTP_NOT_IMPLEMENTED);
    }
}
