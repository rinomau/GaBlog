<?php
namespace GaBlog\Service;
use \Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use GaBlog\Entity\Comment;

class CommentService
{
    protected $em;
    protected $commentEntity;

    public function __constructor(EntityManager $em)
    {
        $this->em = $em;
        $this->commentEntity = $this->em->getRepository('GaBlog\Entity\Comment');
    }

    public function find($id = null)
    {
        if($id){
            return $this->commentEntity->find($id);
        } else {
            return $this->commentEntity->findAll();
        }
    }
    public function insert($data, $persist = true)
    {
        $comment = new Comment();
        $hydrate = new ClassMethods();
        $comment = $hydrate->hydrate($data, $comment);
        if($persist){
            $this->em->persist($comment);
            $this->em->flush();
        }
    }

    public function update($id, $data, $persist = true)
    {
        $comment = $this->commentEntity->find($id);
        $hydrate = new ClassMethods();
        $comment = $hydrate->hydrate($data, $comment);
        if($persist){
            $this->em->persist($comment);
            $this->em->flush();
        }
    }

    public function delete($id)
    {
        $p = $this->commentEntity->find($id);
        $this->em->remove($p);
        $this->em->flush();
    }
}