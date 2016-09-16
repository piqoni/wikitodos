<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Todo;
use AppBundle\Entity\TodoElements;

class LoadTodoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $todo = new Todo();
        $todo->setName('Go to the beach');
        $todo->setCreateDate(new \DateTime('now'));
        $manager->persist($todo);
        
        $goToBeachElements = array(
            'Sunscreen' => true,
            'Slippers' => false,
            'Playing Cards' => true,
            'Secondary Swimsuit' => true,
        );

        foreach ($goToBeachElements as $elementDescription => $optional) {
            $todoElement = new TodoElements();
            $todoElement->setDescription($elementDescription);
            $todoElement->setTodoId($todo);
            $todoElement->setOptional($optional);
            $manager->persist($todoElement);
        }

        $manager->flush();

    }
}