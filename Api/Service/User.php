<?php

namespace miguel\BacalhauBundle\Api\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use miguel\BacalhauBundle\Api\Service;
use miguel\BacalhauBundle\Api\ServiceResponse;
use miguel\BacalhauBundle\Api\Exception\InvalidEntityPropertyException;
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
     * @throws miguel\BacalhauBundle\Api\Exception\InvalidEntityPropertyException;
     *
     * @param miguel\BacalhauBundle\Api\Entity\User $user
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function create(ApiUser $apiUser)
    {
        $user = $this->buildUserEntity($apiUser);

        $this->getEntityManager()->persist($user);
        try {
            $this->getEntityManager()->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new InvalidEntityPropertyException();
        }

        // @TODO better data and gud headers
        return new ServiceResponse('ola mis amigos', JsonResponse::HTTP_CREATED);
    }

    /**
     * @param miguel\BacalhauBundle\Api\Entity\User $user
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function get(ApiUser $apiUser = null)
    {
        $repository = $this->getEntityManager()->getRepository('miguelBacalhauBundle:User');

        if ($apiUser) {
            $users = $repository->findById($apiUser->id);
        } else {
            $users = $repository->findAll();
        }

        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $user->toArray();
        }

        if (empty($userArray)) {
            $statusCode = JsonResponse::HTTP_NOT_FOUND;
        } else {
            $statusCode = JsonResponse::HTTP_OK;
        }

        return new ServiceResponse($userArray, $statusCode);
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
