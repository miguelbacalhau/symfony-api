<?php

namespace miguel\BacalhauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('miguelBacalhauBundle:Default:index.html.twig');
    }
}
