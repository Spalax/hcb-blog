<?php
namespace HcbBlog;

use HcbBlog\Options\ModuleOptions;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;

class Module
{
    /**
     * @param MvcEvent $e
     */
    public function onBootstrap(MvcEvent $e)
    {
        /* @var $sm \Zend\ServiceManager\ServiceManager */
        $sm = $e->getApplication()->getServiceManager();

        /* @var $di \Zend\Di\Di */
        $di = $sm->get('di');

        $config = $sm->get('config');
        $options = new ModuleOptions(isset($config['hcb-blog']) ? $config['hcb-blog'] : array());

        $di->instanceManager()->addSharedInstance($options, 'HcbBlog\Options\ModuleOptions');
        
        $e->getApplication()->getEventManager()->attach('render', array($this, 'registerStrategy'), 100);
    }

    /**
     * @param Event $e
     */
    public function registerStrategy($e)
    {
        $app = $e->getTarget();
        $sm = $app->getServiceManager();

        /* @var $di \Zend\Di\Di */
        $di = $sm->get('di');

        $view         = $sm->get('Zend\View\View');
        $strategy = $di->get('Zf2FileUploader\View\Strategy\UploaderStrategy');

        // Attach strategy, which is a listener aggregate, at high priority
        $view->getEventManager()->attach($strategy, 110);
    }

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
                )
            )
        );
    }
}
