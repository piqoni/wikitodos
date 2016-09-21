<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
// use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     * @Method("POST")
     */
    public function searchAction(Request $request)
    {
        $search = $request->request->get('search');

        $todo_elements = $this->getDoctrine()
            ->getRepository('AppBundle:TodoElements')
            ->findBy(['todo_id' => $search]);

        return $this->render('default/todo_elements.html.twig',[
            'todo_elements' => $todo_elements
            ]);
        
    }    


    /**
     * @Route("/jsonsearch", name="jsonsearch")
     * @Method("POST")
     */
    public function jsonSearchAction(Request $request)
    {
    	$search = $request->request->get('search');

        $todo_elements = $this->getDoctrine()
            ->getRepository('AppBundle:TodoElements')
            ->findBy(['todo_id' => $search]);

        $response = new Response(json_encode($todo_elements));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
