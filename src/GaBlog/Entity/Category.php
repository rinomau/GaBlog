<?php
namespace GaBlog\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="gablog_category")
 */
class Category
{
    private $id;
    private $name;
    private $description;
    private $tag;
    private $dateTimeCreate;
    private $idUser;
}