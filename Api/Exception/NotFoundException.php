<?php

namespace miguel\BacalhauBundle\Api\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use miguel\BacalhauBundle\Api\Exception;

/**
 * Not Found Api Exception class
 *
 * @author miguel
 */
class NotFoundException extends Exception
{
    //@TODO make better good stuff
    public function __construct($message = '')
    {
        parent::__construct($message, JsonResponse::HTTP_NOT_FOUND);
    }
}
