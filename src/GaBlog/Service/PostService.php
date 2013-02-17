<?php

namespace GaBlog\Service;
use \Doctrine\ORM\EntityManager;
use GaBlog\Entity\Post;

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
        $post = new Post();
        $post->setDateTimeCreated(new \DateTime(date('Y-m-d G:m:s')));
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setDescription($data['description']);
        $post->setTag($data['tag']);
        $post->setCategory($data['category']);
        $post->setUser($data['user']);
        $post->setStatus($data['status']);
        if($persist){
            $this->em->persist($post);
            $this->em->flush();
        }
    }

    public function update($id, array $data, $persist = true)
    {
        $post = $this->postEntity->find($id);
        $post->setDateTimeCreated(new \DateTime(date('Y-m-d G:m:s')));
        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setDescription($data['description']);
        $post->setTag($data['tag']);
        $post->setCategory($data['category']);
        $post->setUser($data['user']);
        $post->setStatus($data['status']);
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