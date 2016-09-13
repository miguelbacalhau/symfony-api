<?php

namespace miguel\BacalhauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use miguel\BacalhauBundle\Api\Exception as ApiException;

/**
 * Api Controller class
 *
 * @author miguel
 */
class ApiController extends Controller
{
    /**
     * Api base Controller method
     *
     * @param string $service
     * @param string $method
     * @param Symfony\Component\HttpFoundation\Request $reques
     *
     * @return Symfony\Component\HttpFoundation\JsonResponse
     */
    public function apiAction($service, $method, Request $request)
    {
        $parameters = $this->buildParameters(
            $request->getContent()
        );

        try {
            $return = $this->get("miguel_bacalhau.$service")->$method($parameters);
        } catch (ApiException $e) {
            $return = $e->toJson();
        }

        return new JsonResponse($return);
    }

    /**
     * Builds the parameters from json data for the Api Services
     *
     * @param string $jsonData
     *
     * @return mixed
     */
    private function buildParameters($jsonData)
    {
        $contents = json_decode($jsonData);

        if (is_array($contents)) {
            $parameters = [];
            foreach ($contents as $content) {
                $parameters[] = $this->buildObject($content);
            }
        } else {
            $parameters = $this->buildObject($contents);
        }

        return $parameters;
    }

    /**
     * Builds and Api object based on the data
     *
     * @param stdClass $data
     *
     * @return mixed
     */
    private function buildObject($data)
    {
        // @TODO: validate data, throw exceptions
        $className = 'miguel\BacalhauBundle\\' . $data->classType;
        $object = new $className();

        foreach ($data->properties as $name => $value) {
            $object->$name = $value;
        }

        return $object;
    }
}
