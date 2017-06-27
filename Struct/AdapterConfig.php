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
    protected $root = 'root';

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
     * Gets the value of root from the record
     *
     * @return string
     */
    public function getRoot()
    {
        return $this->root;
    }
}
