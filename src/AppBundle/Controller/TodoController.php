<?php 

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class TodoController extends Controller
{
    /**
     * @Route("/add", name="")
     * @Template()
     */
    public function addAction()
    {

   	$todo = new Todo();
    $todo->setName('Go to the beach');
    $todo->setCreateDate(new \DateTime('now'));

    $em = $this->getDoctrine()->getManager();

    $em->persist($todo);

    $em->flush();

    return new Response('Saved new todo with id '.$todo->getId());
    }
}