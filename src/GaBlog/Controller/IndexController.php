<?php

namespace GaBlog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

    /**
     * FrontEnd
     * @author GianArb<gianarb92@gmail.com>
     */
class IndexController
    extends AbstractActionController
{
    /**
     * return list of category [GET] null => /blog/category/
     * return list of article of id category [GET] :id => /blog/category/:id
     */
    public function categoryAction()
    {
        return false;
    }

    /**
     * return single article [GET] :id => /blog/article/:id
     * return header/404 [GET] null => /blog/article/
     */
    public function articleAction()
    {
        return false;
    }
}