<?php

namespace App\Storage;

use League\Flysystem\FilesystemAdapter;
use League\Flysystem\FileAttributes;
use League\Flysystem\StorageAttributes;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

class AzureStorageAdapter implements FilesystemAdapter
{
    private $client;
    private $container;
    private $accountName;

    public function __construct($accountName, $accountKey, $container)
    {
        $this->accountName = $accountName;
        $this->container = $container;
        
        $connectionString = "DefaultEndpointsProtocol=https;AccountName={$accountName};AccountKey={$accountKey};EndpointSuffix=core.windows.net";
        $this->client = BlobRestProxy::createBlobService($connectionString);
    }

    public function fileExists(string $path): bool
    {
        try {
            $this->client->getBlobProperties($this->container, $path);
            return true;
        } catch (ServiceException $e) {
            return false;
        }
    }

    public function directoryExists(string $path): bool
    {
        return false;
    }

    public function write(string $path, string $contents, array $config = []): void
    {
        try {
            $this->client->createBlockBlob($this->container, $path, $contents);
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to write to Azure: " . $e->getMessage());
        }
    }

    public function writeStream(string $path, $contents, array $config = []): void
    {
        $this->write($path, stream_get_contents($contents), $config);
    }

    public function read(string $path): string
    {
        try {
            $blob = $this->client->getBlob($this->container, $path);
            return stream_get_contents($blob->getContentStream());
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to read from Azure: " . $e->getMessage());
        }
    }

    public function readStream(string $path)
    {
        try {
            $blob = $this->client->getBlob($this->container, $path);
            return $blob->getContentStream();
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to read from Azure: " . $e->getMessage());
        }
    }

    public function delete(string $path): void
    {
        try {
            $this->client->deleteBlob($this->container, $path);
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to delete from Azure: " . $e->getMessage());
        }
    }

    public function deleteDirectory(string $path): void
    {
        // Not implemented for blob storage
    }

    public function createDirectory(string $path, array $config = []): void
    {
        // Not needed for blob storage
    }

    public function listContents(string $path = '', bool $deep = false): iterable
    {
        try {
            $prefix = $path ? rtrim($path, '/') . '/' : '';
            $listBlobsOptions = null;
            $listBlobsOptions->setPrefix($prefix);
            
            $blobList = $this->client->listBlobs($this->container, $listBlobsOptions);
            
            foreach ($blobList->getBlobs() as $blob) {
                yield new FileAttributes($blob->getName());
            }
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to list blobs: " . $e->getMessage());
        }
    }

    public function move(string $source, string $destination, array $config = []): void
    {
        $contents = $this->read($source);
        $this->write($destination, $contents, $config);
        $this->delete($source);
    }

    public function copy(string $source, string $destination, array $config = []): void
    {
        $contents = $this->read($source);
        $this->write($destination, $contents, $config);
    }

    public function getUrl(string $path): string
    {
        return "https://{$this->accountName}.blob.core.windows.net/{$this->container}/{$path}";
    }

    public function getVisibility(string $path): string
    {
        return 'public';
    }

    public function setVisibility(string $path, string $visibility): void
    {
        // Azure blobs are publicly visible if in a public container
    }

    public function mimeType(string $path): string
    {
        try {
            $properties = $this->client->getBlobProperties($this->container, $path);
            return $properties->getProperties()->getContentType() ?? 'application/octet-stream';
        } catch (ServiceException $e) {
            return 'application/octet-stream';
        }
    }

    public function lastModified(string $path): int
    {
        try {
            $properties = $this->client->getBlobProperties($this->container, $path);
            return $properties->getProperties()->getLastModified()->getTimestamp();
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to get last modified: " . $e->getMessage());
        }
    }

    public function fileSize(string $path): int
    {
        try {
            $properties = $this->client->getBlobProperties($this->container, $path);
            return $properties->getProperties()->getContentLength();
        } catch (ServiceException $e) {
            throw new \RuntimeException("Failed to get file size: " . $e->getMessage());
        }
    }
}
