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
    /**
     * create a form and populate if is a edit.
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction()
    {
        $form = $category = $this->getServiceLocator()->get('gablog_form_category');
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

    /**
     * Add new category
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $form = $category = $this->getServiceLocator()->get('gablog_form_category');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if("" === $form->get('categoryId')->getValue()){
                $category = $this->getServiceLocator()->get('gablog_entity_category');
                $category->setDateTimeCreated(new \DateTime(date('Y-m-d G:m:s')));
            } else {
                $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->getRepository('GaBlog\Entity\Category')->find($form->get('categoryId')->getValue());
            }
            $category->setName($form->get('name')->getValue());
            $category->setTag($form->get('tag')->getValue());
            $category->setDescription($form->get('description')->getValue());
            $category->setUser($this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity());
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->persist($category);
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->flush();
        }
        return $this->redirect()->toRoute('blog', array('controller'=>'category', 'action'=>'list'));
    }

    /**
     * Grid with list of All Category
     * @return \Zend\View\Model\ViewModel
     */
    public function listAction()
    {
        $auth = $this->getServiceLocator()->get('zfcuser_auth_service');
        $categories = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->findAll();
        return new ViewModel(array(
            'categories' => $categories,
        ));
    }
    
    /**
     * Delete a single record
     */
    public function delAction()
    {
        $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ->getRepository('GaBlog\Entity\Category')->find($this->getRequest()->getPost('id'));
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->remove($category);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        return false;
    }
}