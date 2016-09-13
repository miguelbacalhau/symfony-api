<?php

namespace miguel\BacalhauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends Controller
{
    public function apiAction($service, $method, Request $request)
    {
        $content = json_decode($request->getContent(), true);
        var_dump($content);
        return new JsonResponse($content);

        $className = 'miguel\BacalhauBundle\\' . $content['classType'];
        $entity = new $className();

        foreach ($content['property'] as $name => $value) {
            $entity->$name = $value;
        }

        return new JsonResponse(
            $this->get("miguel_bacalhau.$service")->$method($entity)
        );
    }
}
