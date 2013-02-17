<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 * @ORM\Entity @ORM\Table(name="gablog_category")
 */
class Category
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $name;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;
    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $tag;
    
    /**
     * @ORM\Column(type="datetime", name="created")
     * @var datetime
     */
    private $dateTimeCreated;
    
    /**
     * @ORM\ManyToOne(targetEntity="GaBlog\Entity\User", inversedBy="category")
     */
    private $user;
    
    /**
     * @ORM\OneToMany(targetEntity="GaBlog\Entity\Post", mappedBy="category")
     */
    private $post;

    /**
     * @return int
     */
    function getId()
    {
        return $this->id;
    }

    function getUser()
    {
        return $this->user;
    }
    /**
     * @return string
     */
    function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    function getDescription()
    {
        return $this->description;
    }

    /**
     * @return string
     */
    function getTag()
    {
        return $this->tag;
    }

    /**
     * @return datetime
     */
    function getDateTimeCreated()
    {
        return $this->dateTimeCreated->format('Y-m-d G:m:s');
    }

    /**
     * @param $i
     * @return $this
     */
    function setId($i)
    {
        $this->id = $i;
        return $this;
    }

    /**
     * @param $n
     * @return $this
     */
    function setName($n)
    {
        $this->name = $n;
        return $this;
    }

    /**
     * @param $d
     * @return $this
     */
    function setDescription($d)
    {
        $this->description = $d;
        return $this;
    }

    /**
     * @param $t
     * @return $this
     */
    function setTag($t)
    {
        $this->tag = $t;
        return $this;
    }

    /**
     * @param $dtc
     * @return $this
     */
    function setDateTimeCreated($dtc)
    {
        $this->dateTimeCreated = $dtc;
        return $this;
    }
    
    /**
     * 
     * @param unknown_type $us
     * @return \GaBlog\Entity\Category
     */
    function setUser(User $us)
    {
        $this->user = $us;
        return $this;
    }

    /**
     * return array of this object
     * @return array
     */
    function toArray()
    {
        return  array(
                'name' => $this->getName(),
                'created' => $this->getDateTimeCreated(),
                'description' => $this->getDescription(),
                'tag' => $this->getTag(),
                'user' => $this->getUser(),
                'categoryId' => $this->getId()
            );
    }
}