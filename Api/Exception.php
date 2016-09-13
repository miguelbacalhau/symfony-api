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
    public function __construct($message)
    {
        //@TODO better faster stronger
        parent::__construct($message);
    }

    public function toJson()
    {
        //@TODO return object as json
        return $this->getMessage();
    }
}
