<?php

namespace miguel\BacalhauBundle\Api\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;
use miguel\BacalhauBundle\Api\Exception;

/**
 * Invalid Entity Property Api Exception class
 *
 * @author miguel
 */
class InvalidEntityPropertyException extends Exception
{
    //@TODO make better good stuff
    public function __construct()
    {
        parent::__construct('Invalid Fields', JsonResponse::HTTP_BAD_REQUEST);
    }
}
