<?php
/**
 * Manage category
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 */

namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;

class PostController
    extends AbstractActionController
{
    /**
     * crete form and populate if is a edit
     * @return \Zend\View\Model\ViewModel
     */
    public function newAction()
    {
        $form = $this->getServiceLocator()->get('gablog_form_post');

        //@TODO Use Category Service
        $categories = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ->getRepository('GaBlog\Entity\Category')->findAll();
        //@TODO Use service Locator!
        $service = new \GaBlog\Service\PostService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        if($categories){
            foreach($categories as $category){
                $params[$category->getId()] = $category->getName();
            }
            $form->get('categoryId')->setValueOptions($params);
        }
        if($this->params('id')){
            $post = $service->find($this->params('id'));
            $form->populateValues($post->toArray());
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    /**
     * add and edit record
     * @return \Zend\View\Model\ViewModel
     */
    public function addAction()
    {
        $form = $this->getServiceLocator()->get('gablog_form_post');
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            //@TODO Use Category Service!
            $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->find($form->get('categoryId')->getValue());
            //@TODO Use service Locator!
            $service = new \GaBlog\Service\PostService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
            $data = array(
                'id' => $form->get('id')->getValue(),
                'title' => $form->get('title')->getValue(),
                'content' => $form->get('content')->getValue(),
                'description' => $form->get('description')->getValue(),
                'tag' => $form->get('tag')->getValue(),
                'category' => $category,
                'user' => $this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity(),
                'status' => $form->get('status')->getValue()
            );
            if("" === $form->get('id')->getValue()){
                $service->insert($data);
            } else {
                $service->update($data['id'], $data);
            }
        }
        return $this->redirect()->toRoute('blog', array('controller'=>'post', 'action'=>'list'));
    }

    /**
     * list all post
     * @return \Zend\View\Model\ViewModel
     */
    public function listAction()
    {
        //@TODO Use service Locator!
        $service = new \GaBlog\Service\PostService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $posts = $service->find();
        return new ViewModel(array(
            'posts' => $posts,
        ));
    }
    
    /**
     * delete a single record
     * @return boolean
     */
    public function delAction()
    {
        //@TODO Use service Locator!
        $service = new \GaBlog\Service\PostService($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $service->delete($this->getRequest()->getPost('id'));
        return false;
    }
}