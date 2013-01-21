<?php
namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use GaBlog\Entity\Post;

class PostRestController
    extends AbstractRestfulController
{

    public function getList()
    {
        $posts = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Post')->findAll();
        foreach($posts as $ii => $post){
            $posts[$ii] = array(
                    'title' => $post->getTitle(),
                    'created' => $post->getDateTimeCreated(),
                    'description' => $post->getDescription(),
                    'content' => $post->getContent(),
                    'tag' => $post->getTag(),
                    'publish' => $post->getDateTimePublish(),
                    'unpublish' => $post->getDateTimeUnpublish(),
                    'status' => $post->getStatus(),
                    'idUser' => $post->getIdUser(),
                    'idCategory' => $post->getIdCategory(),
                    'id' => $post->getId()
            );
        
        }
        $view = new JsonModel($posts);
        $view->setTerminal(true);
        return $view;
    }

    public function get($id)
    {
        $posts = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ->getRepository('GaBlog\Entity\Post')->find($id);
        foreach($posts as $ii => $post){
            $posts[$ii] = array(
                    'title' => $post->getTitle(),
                    'created' => $post->getDateTimeCreated(),
                    'description' => $post->getDescription(),
                    'content' => $post->getContent(),
                    'tag' => $post->getTag(),
                    'publish' => $post->getDateTimePublish(),
                    'unpublish' => $post->getDateTimeUnpublish(),
                    'status' => $post->getStatus(),
                    'idUser' => $post->getIdUser(),
                    'idCategory' => $post->getIdCategory(),
                    'id' => $post->getId()
            );
        
        }
        $view = new JsonModel($posts);
        $view->setTerminal(true);
        return $view;
    }

    public function create($data)
    {
        try{
            $post = new Post();
            $post->setTitle($data['title'])
            ->setTag((empty($data['tag'])) ? null : $data['tag'])
            ->setDescription((empty($data['description'])) ? null : $data['description'])
            ->setIdCategory((empty($data['idCategory'])) ? null : $data['idCategory'])
            ->setContent($data['content'])
            ->setDateTimeCreated((empty($data['created'])) ? null : $data['created'])
            ->setDateTimePublish((empty($data['publish'])) ? null : $data['publish'])
            ->setDateTimeUnpublish((empty($data['unpublish'])) ? null : $data['unpublish'])
            ->setStatus((empty($data['status'])) ? null : $data['status'])
            ->setIdUser($data['idUser']);
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->persist($category);
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
            $response = array('action' => 'create', 'status' => 'ok');
        } catch (Exception $e) {
            $response =  array('action' => 'create', 'status' => $e->getMessage());
            $view = new JsonModel($response);
            $view->setTerminal(true);
            return $view;
        }
        $view = new JsonModel($response);
        $view->setTerminal(true);
        return $view;
    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {
        $post = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ->getRepository('GaBlog\Entity\Post')->find($id);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->remove($post);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        $response =  array('action' => 'delete', 'status' => 'ok');
        $view = new JsonModel($response);
        $view->setTerminal(true);
        return $view;
    }
}