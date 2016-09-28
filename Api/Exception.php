<?php

namespace miguel\BacalhauBundle\Api;

use \Exception as PhpException;

/**
 * Base Api Exception class
 *
 * @author miguel
 */
class Exception extends PhpException
{
    private $statusCode;

    public function __construct($message, $statusCode)
    {
        //@TODO better faster stronger
        parent::__construct($message);
        $this->statusCode = $statusCode;
    }

    public function toJson()
    {
        //@TODO return object as json
        return $this->getMessage();
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
