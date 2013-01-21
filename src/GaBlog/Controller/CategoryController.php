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
                $request = new Client();
                $request->setMethod('POST');
                $request->setUri('http://zend2.local/gablog/ws/category-rest');
                $request->setParameterPost(array(
                    'name' => $form->get('name')->getValue(),
                    'description' => $form->get('description')->getValue(),
                    'tag' => $form->get('tag')->getValue(),
                    'userId' => $form->get('userId')->getValue()
                ));
                $response = $request->send()->getContent();
            } else {
                $request = new Client();
                $request->setMethod('PUT');
                $request->setUri("http://zend2.local/gablog/ws/category-rest/{$form->get('categoryId')->getValue()}");
                $request->setParameterPost(array(
                            'name' => $form->get('name')->getValue(),
                            'description' => $form->get('description')->getValue(),
                            'tag' => $form->get('tag')->getValue(),
                            'userId' => $form->get('userId')->getValue()
                        ));
                $response = $request->send()->getContent();
            }
            return false;
        }

        return new ViewModel(array(
            'message' => $response
        ));
    }

    public function listAction()
    {
        $request = new Client();
        $request->setMethod('GET');
        $request->setUri('http://zend2.local/gablog/ws/category-rest');
        $response = $request->send()->getContent();
        $response = json_decode($response, true);
        return new ViewModel(array(
            'categories' => $response,
        ));
    }
    
    public function delAction()
    {
        $request = new Client();
        $request->setMethod('DELETE');
        $request->setUri("http://zend2.local/gablog/ws/category-rest/{$this->getRequest()->getPost('id')}");
        $response = $request->send()->getContent();
        $response = json_decode($response, true);
        return false;
    }
}