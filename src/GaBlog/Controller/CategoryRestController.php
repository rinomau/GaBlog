<?php
namespace GaBlog\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use GaBlog\Entity\Category;

class CategoryRestController
    extends AbstractRestfulController
{

    public function getList()
    {
        $c = array('c' => 'b', 'd' => 'e');
        $view = new JsonModel($c);
        $view->setTerminal(true);
        return $view;
    }

    public function get($id)
    {

    }

    public function create($data)
    {
        die(var_dump($data));
        $category = new Category();
        $category->setName($data['title'])
            ->setTag($data['tag'])
            ->setDescription($data['description'])
            ->setIdUser($data['idUser']);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->persist($category);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        $c = array('ciao' => 'create');
        $view = new JsonModel($c);
        $view->setTerminal(true);
        return $view;
    }

    public function update($id, $data)
    {
        $c = array('ciao' => 'update', 'd' => 'e');
        $view = new JsonModel($c);
        $view->setTerminal(true);
        return $view;
    }

    public function delete($id)
    {
        $c = array('ciao' => 'delete', 'd' => 'e');
        $view = new JsonModel($c);
        $view->setTerminal(true);
        return $view;
    }
}