<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive\Subscriber;

use Enlight\Event\SubscriberInterface;

/**
 * Class Backend
 *
 * @package NetiFlysystemGoogleDrive\Subscriber
 */
class Backend implements SubscriberInterface
{
    /**
     * @var string
     */
    protected $pluginDir;

    /**
     * Backend constructor.
     *
     * @param string $pluginDir
     */
    public function __construct(
        $pluginDir
    ) {
        $this->pluginDir = $pluginDir;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            'Enlight_Controller_Action_PostDispatch' => 'onPostDispatch',
        );
    }

    /**
     * @param \Enlight_Event_EventArgs $args
     */
    public function onPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /**
         * @var \Enlight_Controller_Request_RequestHttp   $request
         * @var \Enlight_Controller_Response_ResponseHttp $response
         */
        $request  = $args->get('subject')->Request();
        $response = $args->get('subject')->Response();
        if (! $request->isDispatched() || $response->isException()) {
            return;
        }

        $module = $request->getModuleName();
        if ('backend' === $module) {
            /**
             * @var \Enlight_View_Default $view
             */
            $view       = $args->get('subject')->View();
            $controller = strtolower($request->getControllerName());
            $action     = strtolower($request->getActionName());

            $view->addTemplateDir(
                $this->pluginDir . '/Resources/views/'
            );

            if ('index' === $controller && 'load' === $action) {
                $view->extendsTemplate('backend/neti_flysystem_google_drive/extensions/view/import_export/storage_adapter.js');
            }
        }
    }

}
