<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GaBlog;

use Zend\ModuleManager\Feature;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

class Module implements
    Feature\BootstrapListenerInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function onBootstrap(EventInterface $e)
    {
        $app = $e->getApplication();
        $em  = $app->getEventManager()->getSharedManager();
        $sm  = $app->getServiceManager();

        $em->attach(array(
            'GaBlog\Controller\CategoryRestController',
            'GaBlog\Controller\PostRestController'
        ), MvcEvent::EVENT_DISPATCH, function($e) use ($sm) {
            $strategy = $sm->get('ViewJsonStrategy');
            $view     = $sm->get('ViewManager')->getView();
            $strategy->attach($view->getEventManager());
        });
    }
}
