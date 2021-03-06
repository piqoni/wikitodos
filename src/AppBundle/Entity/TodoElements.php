<?php 

namespace AppBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="todo_elements")
 */
class TodoElements implements JsonSerializable
{
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

	/**
	 * @ORM\ManyToOne(targetEntity="Todo")
	 * @ORM\JoinColumn(name="todo_id", referencedColumnName="id")
	 */
	protected $todo_id;

    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @ORM\Column(name="optional", type="boolean", nullable=true)
     */
    protected $optional = false;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TodoElements
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set optional
     *
     * @param boolean $optional
     * @return TodoElements
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;

        return $this;
    }

    /**
     * Get optional
     *
     * @return boolean 
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * Set todo_id
     *
     * @param \AppBundle\Entity\Todo $todoId
     * @return TodoElements
     */
    public function setTodoId(\AppBundle\Entity\Todo $todoId = null)
    {
        $this->todo_id = $todoId;

        return $this;
    }

    /**
     * Get todo_id
     *
     * @return \AppBundle\Entity\Todo 
     */
    public function getTodoId()
    {
        return $this->todo_id;
    }


    public function __toString() {
        return $this->description;
    }


    public function jsonSerialize()
    {
        return array(
            'todo_id' => $this->todo_id->getId(),
            'description' => $this->description,
            'optional'=> $this->optional,
        );
    }

}
