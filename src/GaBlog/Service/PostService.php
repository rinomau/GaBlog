<?php

namespace GaBlog\Service;
use \Doctrine\ORM\EntityManager;
use GaBlog\Entity\Post;
use Zend\Stdlib\Hydrator\ClassMethods;

class PostService
{
    protected $em;
    protected $postEntity;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->postEntity = $this->em->getRepository('GaBlog\Entity\Post');
        return $this;
    }

    public function insert(array $data, $persist = true)
    {
        $hydrator = new ClassMethods();
        $post = new Post();
        $post = $hydrator->hydrate($data, $post);
        if($persist){
            $this->em->persist($post);
            $this->em->flush();
        }
    }

    public function update($id, array $data, $persist = true)
    {
        $hydrator = new ClassMethods();
        $post = $this->postEntity->find($id);
        $post = $hydrator->hydrate($data, $post);
        if($persist){
            $this->em->persist($post);
            $this->em->flush();
        }
    }

    public function find($id = null)
    {
        if($id){
            return $this->postEntity->find($id);
        } else {
            return $this->postEntity->findAll();
        }
    }

    public function delete($id)
    {
        $p = $this->postEntity->find($id);
        $this->em->remove($p);
        $this->em->flush();
    }
}