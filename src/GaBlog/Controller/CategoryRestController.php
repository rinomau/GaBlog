<?php
namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use GaBlog\Entity\Category;
use ZendTest\XmlRpc\Server\Exception;

class CategoryRestController
    extends AbstractRestfulController
{

    public function getList()
    {
        $categories = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->findAll();
        foreach($categories as $ii => $category){
            $categories[$ii] = array(
                'name' => $category->getName(),
                'created' => $category->getDateTimeCreated(),
                'description' => $category->getDescription(),
                'tag' => $category->getTag(),
                'idUser' => $category->getIdUser(),
                'id' => $category->getId()
            );

        }
        $view = new JsonModel($categories);
        $view->setTerminal(true);
        return $view;
    }

    public function get($id)
    {
        $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->find($id);
            $categoryArray = array(
                'name' => $category->getName(),
                'created' => $category->getDateTimeCreated(),
                'description' => $category->getDescription(),
                'tag' => $category->getTag(),
                'idUser' => $category->getIdUser(),
                'id' => $category->getId()
            );
        $view = new JsonModel($categoryArray);
        $view->setTerminal(true);
        return $view;
    }

    public function create($data)
    {
        try{
        $category = new Category();
        $category->setName($data['title'])
            ->setTag((empty($data['tag'])) ? null : $data['tag'])
            ->setDescription((empty($data['description'])) ? null : $data['description'])
            ->setIdUser($data['idUser']);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->persist($category);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        $response = array('action' => 'create', 'status' => 'ok');
        } catch (Exception $e) {
            $response =  array('action' => 'create', 'status' => $e->getMessage());
        }
        $view = new JsonModel($response);
        $view->setTerminal(true);
        return $view;
    }

    public function update($id, $data)
    {
        $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->find($id);
        $category->setName($data['title'])
            ->setTag((empty($data['tag'])) ? null : $data['tag'])
            ->setDescription((empty($data['description'])) ? null : $data['description'])
            ->setIdUser($data['idUser']);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->persist($category);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        $categoryArray = array(
            'name' => $category->getName(),
            'created' => $category->getDateTimeCreated(),
            'description' => $category->getDescription(),
            'tag' => $category->getTag(),
            'idUser' => $category->getIdUser(),
            'id' => $category->getId()
        );
        $view = new JsonModel($categoryArray);
        $view->setTerminal(true);
        return $view;
    }

    public function delete($id)
    {
        $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->delete($id);
        $view = new JsonModel("{'deleted':'ok'}");
        $view->setTerminal(true);
        return $view;
    }
}