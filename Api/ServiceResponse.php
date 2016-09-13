<?php

namespace miguel\BacalhauBundle\Api;

/**
 * Api Service Response Class
 *
 * @author miguel
 */
class ServiceResponse
{
    /**
     * @var string
     */
    private $data;

    /**
     * @var int
     */
    private $status;

    /**
     * @var array
     */
    private $headers;

    /**
     * Class constructor
     *
     * @param string $data
     * @param int $status
     * @param array $headers
     */
    public function __construct($data, $status, $headers = [])
    {
        $this->data = $data;
        $this->status = $status;
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }
    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
