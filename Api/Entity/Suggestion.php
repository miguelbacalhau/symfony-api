<?php

namespace miguel\BacalhauBundle\Api\Entity;

/**
 * Suggestion Api Entity class
 *
 * @author miguel
 */
class Suggestion
{
    /**
     * @var $id
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $message;
    /**
     * @var miguel\BacalhauBundle\Api\Entity\User
     */
    public $author;
}
