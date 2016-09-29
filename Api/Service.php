<?php

namespace miguel\BacalhauBundle\Api;

use Doctrine\ORM\EntityManager;
use miguel\BacalhauBundle\Api\Exception\NotImplementedException;

/**
 * Base Api Service Class
 *
 * @author miguel
 */
class Service
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * GET method
     *
     * @param mixed $param
     * @param array $data
     */
    public function get($param, array $data)
    {
        throw new NotImplementedException('get');
    }
    /**
     * PUT method
     *
     * @param mixed $param
     * @param array $data
     */
    public function put($param, array $data)
    {
        throw new NotImplementedException('put');
    }
    /**
     * POST method
     *
     * @param mixed $param
     * @param array $data
     */
    public function post($param, array $data)
    {
        throw new NotImplementedException('post');
    }
    /**
     * DELETE method
     *
     * @param mixed $param
     * @param array $data
     */
    public function delete($param, array $data)
    {
        throw new NotImplementedException('delete');
    }

    /**
     * @param Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
