<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="gablog_article")
 */
class Article
{
    const STATUS_Draft = 0;
    const STATUS_Publish = 1;
    const STATUS_Unpublish = 2;
    const STATUS_Inactive = 3;
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
     * @ORM\Column(type="string")
     * @var string
     */
    private $description;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $content;
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
     * @ORM\Column(type="datetime", name="publish") @ORM\GeneratedValue
     * @var datetime
     */
    private $dateTimePublish;
    /**
     * @ORM\Column(type="datetime", name="unpublish")
     * @var datetime
     */
    private $dateTimeUnpublish;
    /**
     * @ORM\Column(type="datetime")
     * @var int
     */
    private $status;
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $idUser;

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
        return $this->dateTimeCreated;
    }

    /**
     * @return datetime
     */
    function getDateTimePublish()
    {
        return $this->dateTimePublish;
    }

    /**
     * @return datetime
     */
    function getDateTimeUnpublish()
    {
        return $this->dateTimeUnpublish;
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
    function getIdUser()
    {
        return $this->idUser;
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

    function setIdUser($i)
    {
        $this->idUser = $i;
        return $this;
    }
}