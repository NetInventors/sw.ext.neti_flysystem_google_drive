<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive\Struct;

use NetiFoundation\Struct\AbstractClass;

/**
 * Class AdapterConfig
 *
 * @package NetiFlysystemGoogleDrive\Struct
 */
class AdapterConfig extends AbstractClass
{
    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $refreshToken;

    /**
     * @var string
     */
    protected $accessToken;

    /**
     * @var string
     */
    protected $rootDir = 'root';

    /**
     * @var string
     */
    protected $developerKey;

    /**
     * @var bool
     */
    protected $development = false;

    /**
     * Gets the value of clientId from the record
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Gets the value of clientSecret from the record
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Gets the value of refreshToken from the record
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Gets the value of rootDir from the record
     *
     * @return string
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Gets the value of developerKey from the record
     *
     * @return string
     */
    public function getDeveloperKey()
    {
        return $this->developerKey;
    }

    /**
     * Gets the value of development from the record
     *
     * @return bool
     */
    public function isDevelopment()
    {
        return $this->development;
    }

    /**
     * Sets the Value to development in the record
     *
     * @param bool $development
     *
     * @return self
     */
    public function setDevelopment($development)
    {
        $this->development = $development;

        return $this;
    }

    /**
     * Gets the value of accessToken from the record
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}
