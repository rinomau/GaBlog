<?php
/**
 * Manage category
 * @author Gianluca Arbezzano <gianarb92@gmail.com>
 */

namespace GaBlog\Controller;

use GaBlog\Entity\Post;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Client;
use GaBlog\Form\PostEdit;
use ZendTest\XmlRpc\Server\Exception;

class PostController
    extends AbstractActionController
{
    public function newAction()
    {
        $form = new PostEdit();
        $categories = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
        ->getRepository('GaBlog\Entity\Category')->findAll();
        foreach($categories as $category){
            $params[$category->getId()] = $category->getName();
        }
        $form->get('categoryId')->setValueOptions($params);
        if($this->params('id')){
            $post = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Post')->find($this->params('id'));
            $form->populateValues($post->toArray());
        }
        return new ViewModel(array(
            'form' => $form
        ));
    }

    public function addAction()
    {
        $form = new PostEdit();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $category = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Category')->find($form->get('categoryId')->getValue());
            if("" === $form->get('id')->getValue()){
                $post = new Post();
                $post->setDateTimeCreated(new \DateTime(date('Y-m-d G:m:s')));
            } else {
                $post = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
                ->getRepository('GaBlog\Entity\Post')->find($form->get('id')->getValue());
            }
                $post->setTitle($form->get('title')->getValue());
                $post->setContent($form->get('content')->getValue());
                $post->setDescription($form->get('description')->getValue());
                $post->setTag($form->get('tag')->getValue());
                $post->setCategory($category);
                $post->setUser($this->getServiceLocator()->get('zfcuser_auth_service')->getIdentity());
                $post->setStatus($form->get('status')->getValue());
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->persist($post);
            $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        }

        return new ViewModel(array(
            'message' => 'ciao'
        ));
    }

    public function listAction()
    {
        $posts = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Post')->findAll();
        return new ViewModel(array(
            'posts' => $posts,
        ));
    }
    
    public function delAction()
    {
        $post = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')
            ->getRepository('GaBlog\Entity\Post')->find($this->getRequest()->getPost('id'));
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->remove($post);
        $this->getServiceLocator()->get('Doctrine\ORM\EntityManager')->flush();
        return false;
    }
}