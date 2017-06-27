<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive\Service\ImportExport;

use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;
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
     * @var array
     */
    protected $configData;

    /**
     * @var bool
     */
    protected $initalized = false;

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
        $this->configData = $configData;

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
        $snippetNamespace = $this->snippets->getNamespace('plugins/neti_flysystem_google_drive/backend/import_export/storage_adapter');

        return array(
            array(
                'fieldLabel' => $snippetNamespace->get('field_label_client_id', 'Client id'),
                'name'       => 'clientId',
                'xtype'      => 'textfield'
            ),
            array(
                'fieldLabel' => $snippetNamespace->get('field_label_client_secret', 'Client secret'),
                'name'       => 'clientSecret',
                'xtype'      => 'textfield'
            ),
            array(
                'fieldLabel' => $snippetNamespace->get('field_label_refresh_token', 'Refresh token'),
                'name'       => 'refreshToken',
                'xtype'      => 'textfield'
            ),
            array(
                'fieldLabel' => $snippetNamespace->get('field_label_root_dir', 'Root dir'),
                'name'       => 'rootDir',
                'value'      => 'root',
                'xtype'      => 'textfield'
            )
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
        GoogleDriveAdapter::class;
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

    private function initialize()
    {
        if (! $this->initalized) {
            var_dump($this->configData);exit;
            //            $client = new \Google_Client();
            //            $client->setClientId('[app client id].apps.googleusercontent.com');
            //            $client->setClientSecret('[app client secret]');
            //            $client->refreshToken('[your refresh token]');
            //
            //            $service = new \Google_Service_Drive($client);
            //
            //            $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, '['root' or folder ID]');
            ///* Recommended cached adapter use */
            //// $adapter = new \League\Flysystem\Cached\CachedAdapter(
            ////     new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, '['root' or folder ID]'),
            ////     new \League\Flysystem\Cached\Storage\Memory()
            //// );
            //
            //$filesystem = new \League\Flysystem\Filesystem($adapter);
        }
    }
}
