<?php
/**
 * @copyright  Copyright (c) 2017, Net Inventors GmbH
 * @category   NetiFlysystemGoogleDrive
 * @author     bmueller
 */

namespace NetiFlysystemGoogleDrive\Service\ImportExport;

use NetiImportExport\Models\Profiles;
use NetiImportExport\Models\Storage;
use NetiImportExport\Service\Collections\CollectionInterface;
use NetiImportExport\Service\Collections\FileHandlerInterface;
use NetiImportExport\Service\Collections\StorageAdapterInterface;
use NetiImportExport\Service\StorageAdapterHelperInterface;

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

    public function getName()
    {
        // TODO: Implement getName() method.
    }

    public function supports($key)
    {
        // TODO: Implement supports() method.
    }

    public function getSupportedTypes()
    {
        // TODO: Implement getSupportedTypes() method.
    }

    public function setConfigData(array $configData)
    {
        // TODO: Implement setConfigData() method.
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

    public function getViewData()
    {
        // TODO: Implement getViewData() method.
    }

    public function getDataModel($key = null)
    {
        // TODO: Implement getDataModel() method.
    }

    public function getSelectionViewData()
    {
        // TODO: Implement getSelectionViewData() method.
    }

    public function onListItemResult(array &$item)
    {
        // TODO: Implement onListItemResult() method.
    }

    public function onUploadFile(
        \Enlight_Controller_Request_Request $request,
        Storage $storageModel,
        Profiles $profileModel
    ) {
        // TODO: Implement onUploadFile() method.
    }

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

    public function getFileHandlers()
    {
        // TODO: Implement getFileHandlers() method.
    }

    public function createTempFile($path)
    {
        // TODO: Implement createTempFile() method.
    }
}
