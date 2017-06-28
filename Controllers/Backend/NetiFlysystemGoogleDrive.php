<?php

/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */
class Shopware_Controllers_Backend_NetiFlysystemGoogleDrive
    extends \NetiFoundation\Controllers\Backend\AbstractBackendExtJsController
    implements \Shopware\Components\CSRFWhitelistAware
{
    /**
     * @return array
     */
    public function getWhitelistedCSRFActions()
    {
        return array(
            'refreshToken'
        );
    }

    /**
     *
     */
    public function preDispatch()
    {
        parent::preDispatch();

        if (in_array($this->Request()->getActionName(), array('refreshToken'))) {
            $plugins = $this->Front()->Plugins();
            /**
             * @var Enlight_Controller_Plugins_ViewRenderer_Bootstrap $viewRenderer
             * @var Enlight_Controller_Plugins_Json_Bootstrap         $json
             */
            $viewRenderer = $plugins->get('ViewRenderer');
            $json         = $plugins->get('Json');
            if ($viewRenderer) {
                $viewRenderer->setNoRender(true);
            }

            if ($json) {
                $json->setRenderer(true);
            }
        }
    }

    /**
     *
     */
    public function indexAction()
    {
    }

    /**
     *
     */
    public function refreshTokenAction()
    {
        $request      = $this->Request();
        $clientId     = $request->getParam('clientId');
        $clientSecret = $request->getParam('clientSecret');
        $code         = $request->getParam('code');
        $host         = str_replace('.local', '.de', $_SERVER['HTTP_HOST']);
        if (! empty($code)) {
            $clientId     = $_SESSION['netiFlysystemGoogleDriveClientId'];
            $clientSecret = $_SESSION['netiFlysystemGoogleDriveClientSecret'];

            $client = new Google_Client();
            $client->setClientId($clientId);
            $client->setClientSecret($clientSecret);
            $client->setRedirectUri('http://' . $host . '/backend/NetiFlysystemGoogleDrive/refreshToken');

            try {
                $client->fetchAccessTokenWithAuthCode($code);
                $this->View()->assign($client->getAccessToken());
            } catch (\Exception $e) {
            }

            unset($_SESSION['netiFlysystemGoogleDriveClientId'], $_SESSION['netiFlysystemGoogleDriveClientSecret']);
        } else {
            if (! empty($clientId) && ! empty($clientSecret)) {
                $host   = str_replace('.local', '.de', $_SERVER['HTTP_HOST']);
                $client = new Google_Client();
                $client->setClientId($clientId);
                $client->setClientSecret($clientSecret);
                $client->setAccessType('offline');
                $client->setIncludeGrantedScopes(true);
                $client->addScope(Google_Service_Drive::DRIVE_READONLY);
                $client->setRedirectUri('http://' . $host . '/backend/NetiFlysystemGoogleDrive/refreshToken');

                $auth_url                                         = $client->createAuthUrl();
                $_SESSION['netiFlysystemGoogleDriveClientId']     = $clientId;
                $_SESSION['netiFlysystemGoogleDriveClientSecret'] = $clientSecret;
                $this->View()->assign('authUrl', filter_var($auth_url, FILTER_SANITIZE_URL));
            }
        }
    }
}
