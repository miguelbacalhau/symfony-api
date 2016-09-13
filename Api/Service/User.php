<?php

namespace miguel\BacalhauBundle\Api\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use miguel\BacalhauBundle\Api\Service;
use miguel\BacalhauBundle\Api\Entity\User as ApiUser;
use miguel\BacalhauBundle\Entity\User as UserEntity;

/**
 * User Api Service class
 *
 * @author miguel
 */
class User extends Service
{
    /**
     * Creates a new User
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function create(ApiUser $apiUser)
    {
        $user = $this->buildUserEntity($apiUser);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return 'created';
    }

    /**
     * Builds a User entity from a User Api Entity
     *
     * @param  miguel\BacalhauBundle\Api\Entity\User
     *
     * @return miguel\BacalhauBundle\Entity\User
     */
    private function buildUserEntity(ApiUser $apiUser)
    {
        $user = new UserEntity();
        $name = $apiUser->name;
        $email =$apiUser->email;
        $user->setName($name)->setEmail($email);

        return $user;
    }
}
