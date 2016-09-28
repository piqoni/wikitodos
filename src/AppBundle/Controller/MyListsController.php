<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class MyListsController extends Controller
{
    /**
     * @Route("/my", name="myLists")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     */
    public function myAction(Request $request)
    {

        $user_id = $this->getUser()->getId();
        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery('SELECT t.id, t.name 
                                   FROM AppBundle\Entity\UserElements u 
                                   JOIN  AppBundle\Entity\Todo t WITH t.id=u.todo_id
                                   WHERE u.user_id = :user_id
                                   GROUP BY t.id');
        
        $query->setParameter('user_id', $user_id);

        $myLists = $query->getResult(); 

        $response = new Response(json_encode($myLists));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
