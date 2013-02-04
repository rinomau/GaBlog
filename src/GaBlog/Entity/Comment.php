<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 * @ORM\Entity @ORM\Table(name="gablog_comment")
 */
class Comment
{
    /**
     * @ORM\Id @ORM\Column(type="integer") @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="GaBlog\Entity\Post", inversedBy="comment")
     */
    private $post;

    /**
     * @ORM\ManyToOne(targetEntity="GaBlog\Entity\User", inversedBy="comment")
     */
    private $user;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $site;

    /**
     * @ORM\Column(type="string")
     */
    private $content;

    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    function getId()
    {
        return $this->id;
    }

    function setPost($p)
    {
        $this->post = $p;
        return $this;
    }

    function getPost()
    {
        return $this->post;
    }

    function setEmail($e)
    {
        $this->email = $e;
        return $this;
    }

    function getEmail()
    {
        return $this;
    }

    function setUsername($u)
    {
        $this->username = $u;
        return $this;
    }

    function getUsername()
    {
        return $this->username;
    }

    function setUser($us)
    {
        $this->user = $us;
        return $this;
    }

    function getUser()
    {
        return $this->user;
    }

    function setSite($s)
    {
        $this->site = $s;
        return $this;
    }

    function getSite()
    {
        return $this->site;
    }

    function setContent($c)
    {
        $this->content = $c;
        return $this;
    }

    function getContent()
    {
        return $this->content;
    }
}
