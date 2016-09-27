<?php

namespace AppBundle\Controller;

use AppBundle\Entity\UserElements;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TodoController extends Controller
{
    /**
     * @Route("/add", name="add")
     * @Method("POST")
     * @Security("has_role('ROLE_USER')")
     */
    public function addAction(Request $request)
    {

        $todo_id = $request->request->get('todo_id');
        $user_id = $this->getUser()->getId();

        $em = $this->getDoctrine()->getManager();
        
        $user = $em->getReference('AppBundle:User', $user_id);
        $todo = $em->getReference('AppBundle:Todo', $todo_id);
        
        // check if list already exist
        $todo_exists =  $this->getDoctrine()
            ->getRepository('AppBundle:UserElements')
            ->findBy(['todo_id' => $todo_id,
                      'user_id' => $user_id]);
        
        if ($todo_exists) {
            return new Response('You have already added this to your lists.');
        }
        
        $todo_elements = $this->getDoctrine()
            ->getRepository('AppBundle:TodoElements')
            ->findBy(['todo_id' => $todo_id]);
        
        foreach ($todo_elements as $element) {
            $user_element = new UserElements();
            $user_element->setDescription($element->getDescription());
            $user_element->setTodoId($todo);
            $user_element->setUserId($user);
            $em->persist($user_element);
        }

        $em->flush();

        return new Response('List was added succesfully.');
    }

}
