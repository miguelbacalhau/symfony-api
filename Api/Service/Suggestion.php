<?php

namespace miguel\BacalhauBundle\Api\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use miguel\BacalhauBundle\Api\Service;
use miguel\BacalhauBundle\Api\ServiceResponse;
use miguel\BacalhauBundle\Api\Exception\InvalidEntityPropertyException;
use miguel\BacalhauBundle\Api\Exception\NotFoundException;
use miguel\BacalhauBundle\Api\Entity\Suggestion as ApiSuggestion;
use miguel\BacalhauBundle\Entity\Suggestion as SuggestionEntity;

/**
 * Suggestion Api Service class
 *
 * @author miguel
 */
class Suggestion extends Service
{
    /**
     * Creates a new suggestion
     *
     * @param mixed $param
     * @param array $data array with the suggestions data
     *
     * @throws miguel\BacalhauBundle\Api\Exception\InvalidEntityPropertyException;
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function create(array $data)
    {
        //@TODO take care of null data
        //@TODO iterate data array
        $suggestion = $this->buildsuggestionEntity($data[0]);

        $this->getEntityManager()->persist($suggestion);
        try {
            $this->getEntityManager()->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new InvalidEntityPropertyException();
        }

        // @TODO gud headers
        return new ServiceResponse($suggestion->toArray(), JsonResponse::HTTP_CREATED);
    }

    /**
     * Get suggestion with id
     *
     * @param mixed $param suggestion id
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotFoundException;
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function listOne($param)
    {
        $repository = $this->getEntityManager()->getRepository('miguelBacalhauBundle:Suggestion');

        $suggestions = $repository->findById($param);

        $suggestionArray = [];
        foreach ($suggestions as $suggestion) {
            $suggestionArray[] = $suggestion->toArray();
        }

        if (empty($suggestionArray)) {
            throw new NotFoundException('suggestion not found');
        }

        return new ServiceResponse($suggestionArray, JsonResponse::HTTP_OK);
    }

    /**
     * Get all suggestion
     *
     * @throws miguel\BacalhauBundle\Api\Exception\NotFoundException;
     *
     * @return miguel\BacalhauBundle\Api\ServiceResponse
     */
    public function listAll()
    {
        $repository = $this->getEntityManager()->getRepository('miguelBacalhauBundle:Suggestion');

        $suggestions = $repository->findAll();

        $suggestionArray = [];
        foreach ($suggestions as $suggestion) {
            $suggestionArray[] = $suggestion->toArray();
        }

        if (empty($suggestionArray)) {
            throw new NotFoundException('suggestion not found');
        }

        return new ServiceResponse($suggestionArray, JsonResponse::HTTP_OK);
    }

    /**
     * Builds a suggestion entity from a suggestion Api Entity
     *
     * @param  miguel\BacalhauBundle\Api\Entity\suggestion
     *
     * @return miguel\BacalhauBundle\Entity\suggestion
     */
    private function buildSuggestionEntity(Apisuggestion $apiSuggestion)
    {
        $suggestion = new SuggestionEntity();
        $name = $apiSuggestion->name;
        $email =$apiSuggestion->email;
        $suggestion->setName($name)->setEmail($email);

        return $suggestion;
    }
}
