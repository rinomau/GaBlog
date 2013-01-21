<?php
namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

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

    }

    public function create($data)
    {

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }
}