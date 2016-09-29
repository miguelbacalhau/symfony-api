<?php

namespace miguel\BacalhauBundle\Api;

use Doctrine\ORM\EntityManager;
use miguel\BacalhauBundle\Api\Exception\NotImplementedException;

/**
 * Base Api Service Class
 *
 * @author miguel
 */
abstract class Service
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Lists one resource based on param
     *
     * @param mixed $param
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotImplementedException
     */
    public function listOne($param)
    {
        throw new NotImplementedException();
    }
    /**
     * Lists all resources
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotImplementedException
     */
    public function listAll()
    {
        throw new NotImplementedException();
    }
    /**
     * Create a new resource
     *
     * @param array $data
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotImplementedException
     */
    public function create(array $data)
    {
        throw new NotImplementedException();
    }
    /**
     * Updated a resource based on a param
     *
     * @param mixed $param
     * @param array $data
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotImplementedException
     */
    public function update($param, array $data)
    {
        throw new NotImplementedException();
    }
    /**
     * Deletes a resource based on a param
     *
     * @param mixed $param
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotImplementedException
     */
    public function destroy($param)
    {
        throw new NotImplementedException();
    }

    /**
     * GET method
     *
     * @param mixed $param
     * @param array $data
     */
    public function get($param, array $data)
    {
        if ($param) {
            return $this->listOne($param);
        } else {
            return $this->listAll();
        }
    }
    /**
     * PUT method
     *
     * @param mixed $param
     * @param array $data
     */
    public function put($param, array $data)
    {
        return $this->update($param, $data);
    }
    /**
     * POST method
     *
     * @param mixed $param
     * @param array $data
     */
    public function post($param, array $data)
    {
        return $this->create($data);
    }
    /**
     * DELETE method
     *
     * @param mixed $param
     * @param array $data
     */
    public function delete($param, array $data)
    {
        return $this->destroy($param);
    }

    /**
     * Prevents other method from being called
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotImplementedException
     */
    public function __call($name, $arguments)
    {
        throw new NotImplementedException();
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
