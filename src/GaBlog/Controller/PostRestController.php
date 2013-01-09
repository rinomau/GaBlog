<?php
namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class PostRestController
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

    }

    public function update($id, $data)
    {

    }

    public function delete($id)
    {

    }
}