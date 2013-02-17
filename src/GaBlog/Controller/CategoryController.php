<?php
/**
 * Manage category
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 */

namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;

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
            $service = new \GaBlog\Service\CategoryService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
            $category = $service->find($this->params('id'));
            $form->populateValues($category->toArray());
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
        $service = new \GaBlog\Service\CategoryService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $data = array(
                'id' => $form->get('categoryId')->getValue(),
                'name' => $form->get('name')->getValue(),
                'tag' => $form->get('tag')->getValue(),
                'description' => $form->get('description')->getValue(),
                'user' => $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity()
            );
            if("" === $form->get('categoryId')->getValue()){
                $service->insert($data);
            } else {
                $service->update($form->get('categoryId')->getValue(), $data);
            }
        }
        return $this->redirect()->toRoute('blog', array('controller'=>'category', 'action'=>'list'));
    }

    /**
     * Grid with list of All Category
     * @return \Zend\View\Model\ViewModel
     */
    public function listAction()
    {
        $service = new \GaBlog\Service\CategoryService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $categories = $service->find();
        return new ViewModel(array(
            'categories' => $categories,
        ));
    }
    
    /**
     * Delete a single record
     */
    public function delAction()
    {
        $service = new \GaBlog\Service\CategoryService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $service->delete($this->getRequest()->getPost('id'));
        return false;
    }
}