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
        $categories = $this->getServiceLocator()->get('categoryService')->find();
        $service = $this->getServiceLocator()->get('postService');
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
            $category = $this->getServiceLocator()->get('categoryService')->find($form->get('categoryId')->getValue());
            $service = $this->getServiceLocator()->get('postService');
            $data = array(
                'dateTimeCreated' => new \DateTime(),
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
        $service = $this->getServiceLocator()->get('postService');
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
        $service = $this->getServiceLocator()->get('postService');
        $service->delete($this->getRequest()->getPost('id'));
        return false;
    }
}