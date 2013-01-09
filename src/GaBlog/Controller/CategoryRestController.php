<?php
namespace GaBlog\Controller;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\ViewModel;

class CategoryRestController
    extends AbstractRestfulController
{
    public function getList()
    {
        $c = array('c' => 'b', 'd' => 'e');
        $view = new ViewModel($c);
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