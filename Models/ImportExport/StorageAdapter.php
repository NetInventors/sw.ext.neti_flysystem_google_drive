<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive\Models\ImportExport;

use Doctrine\ORM\Mapping as ORM;
use Shopware\Components\Model\ModelEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="StorageAdapterRepository")
 * @ORM\Table(name="s_neti_flysystem_google_drive_import_export_storage_adapter")
 */
class StorageAdapter extends ModelEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="bigint", name="id", options={"unsigned"=true})
     *
     * @var int
     */
    protected $id;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $clientId;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $clientSecret;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $refreshToken;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $accessToken;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $developerKey;

    /**
     * @ORM\Column(type="boolean")
     *
     * @var boolean
     */
    protected $development;

    /**
     * @Assert\NotBlank
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $rootDir;

    /**
     * Gets the value of id from the record
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the Value to id in the record
     *
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Gets the value of clientId from the record
     *
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Sets the Value to clientId in the record
     *
     * @param mixed $clientId
     *
     * @return self
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
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
     * Sets the Value to clientSecret in the record
     *
     * @param string $clientSecret
     *
     * @return self
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;

        return $this;
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
     * Sets the Value to refreshToken in the record
     *
     * @param string $refreshToken
     *
     * @return self
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
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
     * Sets the Value to rootDir in the record
     *
     * @param string $rootDir
     *
     * @return self
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;

        return $this;
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
     * Sets the Value to developerKey in the record
     *
     * @param string $developerKey
     *
     * @return self
     */
    public function setDeveloperKey($developerKey)
    {
        $this->developerKey = $developerKey;

        return $this;
    }

    /**
     * Gets the value of development from the record
     *
     * @return bool
     */
    public function getDevelopment()
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

    /**
     * Sets the Value to accessToken in the record
     *
     * @param string $accessToken
     *
     * @return self
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }
}
