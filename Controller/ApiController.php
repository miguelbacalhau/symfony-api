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
    public function apiAction($service, $param, Request $request)
    {

        $data = $this->buildData(
            $request->getContent()
        );
        $method = strtolower($request->getMethod());

        try {
            // @TODO verify method exist before calling
            $apiServiceResponse = $this->get("miguel_bacalhau.$service")->$method($param, $data);
            $data = $apiServiceResponse->getData();
            $status = $apiServiceResponse->getStatus();
            $headers = $apiServiceResponse->getHeaders();
        } catch (ApiException $e) {
            $data = $e->toJson();
            $status = $e->getStatusCode();
            // @TODO the very gud headers
            $headers = [];
        }

        return new JsonResponse($data, $status, $headers);
    }

    /**
     * Builds the parameters from json data for the Api Services
     *
     * @param string $jsonData
     *
     * @return mixed
     */
    private function buildData($jsonData)
    {
        if (empty($jsonData)) {
            return null;
        }

        $contents = json_decode($jsonData);

        $data = [];
        if (is_array($contents)) {
            foreach ($contents as $content) {
                $data[] = $this->buildObject($content);
            }
        } else {
            $data[] = $this->buildObject($contents);
        }

        return $data;
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
