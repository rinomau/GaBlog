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
    public function deleteAction()
    {
    }

    public function newAction()
    {
        return new ViewModel(array(
            'form' => new CategoryEdit(),
        ));
    }

    public function addAction()
    {
        $form = new CategoryEdit();

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if("" === $form->get('categoryId')->getValue()){
                try{
                $request = new Client();
                $request->setMethod('POST');
                $request->setUri('http://websenzafrontiere.local/gablog/ws/category-rest');
                $request->setParameterPost(array(
                    'name' => $form->getValue('name'),
                    'description' => $form->get('description'),
                    'idUser' => $form->getValue('userId')
                ));
                $response = $request->send()->getContent();
                var_dump(json_decode($response, true));
                } catch(Exception $e) {
                    var_dump($e->getMessage(), 'exc');
                }
            } else {
                echo 'update';
            }
            return false;
        }

        return new ViewModel(array(
            'message' => 'wow'
        ));
    }

    public function listAction()
    {
        $request = new Client();
        $request->setMethod('GET');
        $request->setUri('http://websenzafrontiere.local/gablog/ws/category-rest');
        $response = $request->send()->getContent();
        $response = json_decode($response, true);
        return new ViewModel(array(
            'categories' => $response,
        ));
    }
}