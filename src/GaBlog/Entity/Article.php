<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="gablog_article")
 */
class Article
{
    private $id;
    private $title;
    private $description;
    private $content;
    private $tag;
    private $dateTimeCreate;
    private $dateTimePublish;
    private $dateTimeUnpublish;
    private $idUser;
}