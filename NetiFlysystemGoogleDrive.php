<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive;
if(is_file(__DIR__. '/vendor/autoload.php')) {
    require __DIR__ . '/vendor/autoload.php';
}

use Shopware\Components\Plugin;
use Shopware\Components\Plugin\Context\ActivateContext;
use Shopware\Components\Plugin\Context\InstallContext;
use Shopware\Components\Plugin\Context\UpdateContext;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class NetiFlysystemGoogleDrive
 *
 * @package NetiFlysystemGoogleDrive
 */
class NetiFlysystemGoogleDrive extends Plugin
{
    /**
     * @param InstallContext $context
     *
     * @throws \Exception
     */
    public function install(InstallContext $context)
    {
        $this->hasComposerAutoloader();
        parent::install($context);
    }

    /**
     * @param UpdateContext $context
     *
     * @throws \Exception
     */
    public function update(UpdateContext $context)
    {
        $this->hasComposerAutoloader();
        parent::update($context);
    }

    /**
     * @param ActivateContext $context
     *
     * @throws \Exception
     */
    public function activate(ActivateContext $context)
    {
        $this->hasComposerAutoloader();
        parent::activate($context);
    }

    /**
     * @throws \Exception
     */
    private function hasComposerAutoloader()
    {
        $pathToComposerAutoloader = $this->getComposerAutoloader();

        if (! is_file($pathToComposerAutoloader)) {
            throw new \Exception('Please run "composer install" before you install the plugin!');
        }
    }

    /**
     * @return string
     */
    private function getComposerAutoloader()
    {
        return $this->getPath() . '/vendor/autoload.php';
    }
}
