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