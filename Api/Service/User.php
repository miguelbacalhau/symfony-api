<?php

namespace miguel\BacalhauBundle\Api\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use miguel\BacalhauBundle\Api\Service;
use miguel\BacalhauBundle\Api\ServiceResponse;
use miguel\BacalhauBundle\Api\Exception\InvalidEntityPropertyException;
use miguel\BacalhauBundle\Api\Exception\NotFoundException;
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
     * @param mixed $param
     * @param array $data array with the users data
     *
     * @throws miguel\BacalhauBundle\Api\Exception\InvalidEntityPropertyException;
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function create(array $data)
    {
        //@TODO take care of null data
        //@TODO iterate data array
        $user = $this->buildUserEntity($data[0]);

        $this->getEntityManager()->persist($user);
        try {
            $this->getEntityManager()->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new InvalidEntityPropertyException();
        }

        // @TODO gud headers
        return new ServiceResponse($user->toArray(), JsonResponse::HTTP_CREATED);
    }

    /**
     * Get user with id
     *
     * @param mixed $param user id
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotFoundException;
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function listOne($param)
    {
        $repository = $this->getEntityManager()->getRepository('miguelBacalhauBundle:User');

        $users = $repository->findById($param);

        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $user->toArray();
        }

        if (empty($userArray)) {
            throw new NotFoundException('user not found');
        }

        return new ServiceResponse($userArray, JsonResponse::HTTP_OK);
    }

    /**
     * Get all users
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotFoundException;
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function listAll()
    {
        $repository = $this->getEntityManager()->getRepository('miguelBacalhauBundle:User');

        $users = $repository->findAll();

        $userArray = [];
        foreach ($users as $user) {
            $userArray[] = $user->toArray();
        }

        if (empty($userArray)) {
            throw new NotFoundException('user not found');
        }

        return new ServiceResponse($userArray, JsonResponse::HTTP_OK);
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
