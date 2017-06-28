<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive\Service\ImportExport;

use Google_Service_Drive;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
use League\Flysystem\Filesystem;
use NetiFlysystemGoogleDrive\Struct\AdapterConfig;
use NetiImportExport\Models\Profiles;
use NetiImportExport\Models\Storage;
use NetiImportExport\Service\Collections\CollectionInterface;
use NetiImportExport\Service\Collections\FileHandlerInterface;
use NetiImportExport\Service\Collections\StorageAdapterInterface;
use NetiImportExport\Service\StorageAdapterHelperInterface;
use NetiImportExport\Service\Collections\DataHandlerInterface;

/**
 * Class StorageAdapter
 *
 * @package NetiFlysystemGoogleDrive\Service\ImportExport
 */
class StorageAdapter implements StorageAdapterInterface
{
    /**
     * @var \Enlight_Components_Snippet_Manager
     */
    protected $snippets;

    /**
     * @var StorageAdapterHelperInterface
     */
    protected $storageAdapterHelper;

    /**
     * @var AdapterConfig
     */
    protected $configData;

    /**
     * @var bool
     */
    protected $initalized = false;

    /**
     * @var \Google_Client
     */
    protected $googleClient;

    /**
     * @var \Google_Service_Drive
     */
    protected $googleServiceDrive;

    /**
     * @var GoogleDriveAdapter
     */
    protected $googleDriveAdapter;

    /**
     * @var Filesystem
     */
    protected $storage;

    /**
     * StorageAdapter constructor.
     *
     * @param \Enlight_Components_Snippet_Manager $snippets
     * @param StorageAdapterHelperInterface       $storageAdapterHelper
     */
    public function __construct(
        \Enlight_Components_Snippet_Manager $snippets,
        StorageAdapterHelperInterface $storageAdapterHelper
    ) {
        $this->snippets             = $snippets;
        $this->storageAdapterHelper = $storageAdapterHelper;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->snippets->getNamespace('plugins/neti_flysystem_google_drive/backend/import_export/storage_adapter')->get('name', 'Google Drive');
    }

    /**
     * @param mixed $key
     *
     * @return bool
     */
    public function supports($key)
    {
        return in_array($key, $this->getSupportedTypes());
    }

    /**
     * @return array
     */
    public function getSupportedTypes()
    {
        return array(
            StorageAdapterInterface::SUPPORTED_TYPE_BACKEND,
            StorageAdapterInterface::SUPPORTED_TYPE_CLI,
            DataHandlerInterface::SUPPORTED_TYPE_IMPORT,
            DataHandlerInterface::SUPPORTED_TYPE_EXPORT,
            DataHandlerInterface::SUPPORTED_TYPE_EVENT,
        );
    }

    /**
     * @param array $configData
     *
     * @return $this
     */
    public function setConfigData(array $configData)
    {
        $this->configData = new AdapterConfig($configData);

        return $this;
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    /**
     * @return array
     */
    public function getViewData()
    {
        return array(
            array(
                'xtype' => 'neti_flysystem_google_drive_import_export_storage_adapter'
            ),
        );
    }

    /**
     * @param null $key
     *
     * @return string
     */
    public function getDataModel($key = null)
    {
        switch ($key) {
            case 'view':
                return \NetiFlysystemGoogleDrive\Models\ImportExport\StorageAdapter::class;
                break;
        }
    }

    public function getSelectionViewData()
    {
        // TODO: Implement getSelectionViewData() method.
    }

    /**
     * @param array $item
     */
    public function onListItemResult(array &$item)
    {
        $item['storageAdapterViewData']          = $this->getViewData();
        $item['storageAdapterSelectionViewData'] = $this->getSelectionViewData();
    }

    /**
     * @param \Enlight_Controller_Request_Request $request
     * @param Storage                             $storageModel
     * @param Profiles                            $profileModel
     *
     * @return array|null|void
     */
    public function onUploadFile(
        \Enlight_Controller_Request_Request $request,
        Storage $storageModel,
        Profiles $profileModel
    ) {
        // TODO: Implement onUploadFile() method.
    }

    /**
     * @param \Enlight_Controller_Request_Request $request
     * @param Storage                             $storageModel
     * @param Profiles                            $profileModel
     *
     * @return array|null|void
     */
    public function onRemoveUploadedFile(
        \Enlight_Controller_Request_Request $request,
        Storage $storageModel,
        Profiles $profileModel
    ) {
        // TODO: Implement onRemoveUploadedFile() method.
    }

    public function getMimeType($path)
    {
        // TODO: Implement getMimeType() method.
    }

    public function getEncoding($path)
    {
        // TODO: Implement getEncoding() method.
    }

    public function readStream($path)
    {
        // TODO: Implement readStream() method.
    }

    public function delete($path)
    {
        // TODO: Implement delete() method.
    }

    public function getSize($path)
    {
        // TODO: Implement getSize() method.
    }

    public function rename($path, $newpath)
    {
        // TODO: Implement rename() method.
    }

    public function copy($path, $newpath)
    {
        // TODO: Implement copy() method.
    }

    public function listContents($directory = '', $recursive = false)
    {
        $this->initialize();
        //var_dump('initialize');exit;
        try {
            $list = $this->storage->listContents($directory, $recursive);
            var_dump($list);
            exit;
        } catch (\Exception $e) {
            var_dump($e);
            exit;
        }
        // TODO: Implement listContents() method.
    }

    public function has($path)
    {
        // TODO: Implement has() method.
    }

    public function applyPathPrefix($path)
    {
        // TODO: Implement applyPathPrefix() method.
    }

    public function getPathPrefix()
    {
        // TODO: Implement getPathPrefix() method.
    }

    /**
     * @return FileHandlerInterface[]|null
     */
    public function getFileHandlers()
    {
        return array();
    }

    public function createTempFile($path)
    {
        // TODO: Implement createTempFile() method.
    }

    /**
     *
     */
    private function initialize()
    {
        if (! $this->initalized) {
            $this->createGoogleClient();
            $this->createGoogleServiceDrive();
            $this->createGoogleDriveAdapter();

            $this->createStorage();

            $this->initalized = true;
        }
    }

    /**
     * @return \Google_Client
     */
    private function createGoogleClient()
    {
        if (empty($this->googleClient)) {
            /**
             * https://accounts.google.com/o/oauth2/v2/auth?scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive.appdata&access_type=offline&include_granted_scopes=true&state=state_parameter_passthrough_value&redirect_uri=http%3A%2F%2Fshopware-5214.de%2Fcallback&response_type=code&client_id=71137613328-b8trbhhdofvmutt8b1aho2cbsdhc7mm6.apps.googleusercontent.com
             */
            $this->googleClient = new \Google_Client();
            if ($this->configData->isDevelopment()) {
                $this->googleClient->setDeveloperKey($this->configData->getDeveloperKey());
            } else {
                $this->googleClient->setClientId($this->configData->getClientId());
                $this->googleClient->setClientSecret($this->configData->getClientSecret());
                $this->googleClient->refreshToken($this->configData->getRefreshToken());
                $this->googleClient->setAccessToken($this->configData->getAccessToken());
                //$this->googleClient->fetchAccessTokenWithAuthCode($this->configData->getRefreshToken());
            }
        }

        return $this->googleClient;
    }

    /**
     * @return \Google_Service_Drive
     */
    private function createGoogleServiceDrive()
    {
        return $this->googleServiceDrive = new \Google_Service_Drive($this->googleClient);
    }

    /**
     * @return GoogleDriveAdapter
     */
    private function createGoogleDriveAdapter()
    {
        //// $adapter = new \League\Flysystem\Cached\CachedAdapter(
        ////     new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, '['root' or folder ID]'),
        ////     new \League\Flysystem\Cached\Storage\Memory()
        //// );

        return $this->googleDriveAdapter = new GoogleDriveAdapter(
            $this->googleServiceDrive,
            $this->configData->getRoot()
        );
    }

    /**
     *
     */
    private function createStorage()
    {
        $this->storage = new Filesystem($this->googleDriveAdapter);
    }
}
