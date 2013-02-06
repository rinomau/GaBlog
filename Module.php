<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace GaBlog;

use Doctrine\ORM\Mapping\Entity;
use Zend\ModuleManager\Feature;
use Zend\EventManager\EventInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
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

    public function onBootstrap(MvcEvent $e)
    {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'gablog_form_category' => function() {
                    $form = new Form\CategoryEdit();
                    return $form;
                },
                'gablog_form_post' => function() {
                    $form = new Form\PostEdit();
                    return $form;
                },
                'gablog_entity_category' => function() {
                    return new \GaBlog\Entity\Category();
                },
                'gablog_entity_post' => function() {
                    return new \GaBlog\Entity\Post();
                },
                'gablog_entity_user' => function() {
                    return new \GaBlog\Entity\User();
                },
            ),
        );
    }
}
