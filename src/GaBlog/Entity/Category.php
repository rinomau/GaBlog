<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
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
     * @ORM\Column(type="string")
     * @var string
     */
    private $tag;
    /**
     * @ORM\Column(type="datetime", name="created") @ORM\GeneratedValue
     * @var datetime
     */
    private $dateTimeCreated;
    /**
     * @ORM\Column(type="integer", name="id_user")
     * @var int
     */
    private $idUser;
    
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
     * @return int
     */
    function getIdUser()
    {
        return $this->idUser;
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
     * @param $iu
     * @return $this
     */
    function setIdUser($iu)
    {
        $this->idUser = $iu;
        return $this;
    }
    
    function toArray()
    {
        return  array(
                'name' => $this->getName(),
                'created' => $this->getDateTimeCreated(),
                'description' => $this->getDescription(),
                'tag' => $this->getTag(),
                'idUser' => $this->getIdUser(),
                'id' => $this->getId()
            );
    }
}