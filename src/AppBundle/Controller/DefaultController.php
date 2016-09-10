<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $todos = $this->getDoctrine()
            ->getRepository('AppBundle:Todo')
            ->findAll();

        $user = $this->getUser();

        return $this->render('default/index.html.twig', [
            'user' => $user,
            'todos'=> $todos
            ]
        );
    }
}

