<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 * @ORM\Entity @ORM\Table(name="gablog_post")
 */
class Post
{
    const STATUS_Draft = 0;
    const STATUS_Publish = 1;
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @var string
     */
    private $description;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $content;
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
     * @ORM\Column(type="datetime", name="publish", nullable=true)
     * @var datetime
     */
    private $dateTimePublish;
    /**
     * @ORM\Column(type="datetime", name="unpublish", nullable=true)
     * @var datetime
     */
    private $dateTimeUnpublish;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $status;
    /**
     * @ORM\ManyToOne(targetEntity="GaBlog\Entity\User", inversedBy="post")
     * @var int
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="GaBlog\Entity\Category", inversedBy="post")
     */
    private $category;

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
    function getTitle()
    {
        return $this->title;
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
    function getContent()
    {
        return $this->content;
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
     * @return datetime
     */
    function getDateTimePublish()
    {
        return $this->dateTimePublish->format('Y-m-d G:m:s');
    }

    /**
     * @return datetime
     */
    function getDateTimeUnpublish()
    {
        if($this->dateTimeUnpublish)
            return $this->dateTimeUnpublish->format('Y-m-d G:m:s');
        else
            return null;
    }
    
    /**
     * @return int
     */
    function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int
     */
    function getUser()
    {
        return $this->user;
    }
    /**
     * @param $id
     * @return $this
     */
    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param $t
     * @return $this
     */
    function setTitle($t)
    {
        $this->title = $t;
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
     * @param $c
     * @return $this
     */
    function setContent($c)
    {
        $this->content = $c;
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
     * @param $dtp
     * @return $this
     */
    function setDateTimePublish($dtp)
    {
        $this->dateTimePublish = $dtp;
        return $this;
    }

    /**
     * @param $dtu
     * @return $this
     */
    function setDateTimeUnpublish($dtu)
    {
        $this->dateTimeUnpublish = $dtu;
        return $this;
    }

    /**
     * @param int $s
     * @return $this
     */
    function setStatus($s = 0)
    {
        $this->status = $s;
        return $this;
    }

    /**
     * @param $i
     * @return $this
     */
    function setUser(User $i)
    {
        $this->user = $i;
        return $this;
    }
    
    /**
     * return array by object
     * @return array
     */
    function toArray()
    {
        return array(
                  'title' => $this->getTitle(),
                  'description' => $this->getDescription(),
                  'tag' => $this->getTag(),
                  'categoryId' => $this->getId(),
                  'userId' => $this->getIdUser(),
                  'content' => $this->getContent(),
                  'id' => $this->getId(),
                  'created' => $this->getDateTimeCreated(),
                  'publish' => $this->getDateTimePublish(),
                  'unpublish' => $this->getDateTimeUnpublish(),
                  'status' => $this->getStatus()
               );
    }
    
    /**
     * translate status
     */
    function translateStatus()
    {
        if($this->status == 0 )
            return 'Draft';
        elseif($this->status == 1)
            return 'Publish';
    }
    
    /**
     * get category of a post
     * @return Category
     */
    function getCategory()
    {
        return $this->category;
    }
    
    /**
     * set category for a post
     * @param Category $cat
     * @return \GaBlog\Entity\Post
     */
    function setCategory(Category $cat)
    {
        $this->category = $cat;
        return $this;
    }
}