<?php

namespace miguel\BacalhauBundle\Api;

use Doctrine\ORM\EntityManager;

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
