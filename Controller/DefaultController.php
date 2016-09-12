<?php

namespace miguel\BacalhauBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use miguel\BacalhauBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = new User();
        $email = uniqid() . '@miguel.pt';
        $user->setName('miguel')->setEmail($email);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('miguelBacalhauBundle:Default:index.html.twig');
    }
}
