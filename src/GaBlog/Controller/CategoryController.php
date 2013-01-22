<?php
/**
 * Manage category
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 */

namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;
use GaBlog\Form\CategoryEdit;
use ZendTest\XmlRpc\Server\Exception;
use GaBlog\Entity\Category;

class CategoryController
    extends AbstractActionController
{
    public function newAction()
    {
        $form = new CategoryEdit();
        if($this->params('id')){
            $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->find($this->params('id'));
            $form->populateValues(array(
                        'name' => $category->getName(),
                        'description' => $category->getDescription(),
                        'tag' => $category->getTag(),
                        'categoryId' => $category->getId(),
                        'userId' => $category->getIdUser()
                    ));
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function addAction()
    {
        $form = new CategoryEdit();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if("" === $form->get('categoryId')->getValue()){
                $category = new Category();
                $category->setDateTimeCreated(date('Y-m-d G:m:s'));
            } else {
                $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->getRepository('GaBlog\Entity\Category')->find($form->get('categoryId')->getValue());
            }
            $category->setName($form->get('name')->getValue());
            $category->setTag($form->get('tag')->getValue());
            $category->setDescription($form->get('description')->getValue());
            $category->setIdUser($form->get('userId')->getValue());
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->persist($category);
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->flush();
        }

        return new ViewModel(array(
            'message' => 'ok'
        ));
    }

    public function listAction()
    {
        $categories = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->findAll();
        foreach($categories as $ii => $category){
            $categories[$ii] = $category->toArray();
        }
        return new ViewModel(array(
            'categories' => $categories,
        ));
    }
    
    public function delAction()
    {
        $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ->getRepository('GaBlog\Entity\Category')->find($this->getRequest()->getPost('id'));
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->remove($category);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        return false;
    }
}