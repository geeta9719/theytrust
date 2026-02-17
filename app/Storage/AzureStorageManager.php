<?php

namespace App\Storage;

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Blob\Models\CreateBlockBlobOptions;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;

class AzureStorageManager
{
    private $client;
    private $container;
    private $accountName;

    public function __construct(string $accountName, string $accountKey, string $container)
    {
        $this->accountName = $accountName;
        $this->container = $container;

        $connectionString = "DefaultEndpointsProtocol=https;AccountName={$accountName};AccountKey={$accountKey};EndpointSuffix=core.windows.net";
        $this->client = BlobRestProxy::createBlobService($connectionString);
    }

    public function put(string $path, string $contents, array $options = []): bool
    {
        try {
            $blobOptions = new CreateBlockBlobOptions();

            // Set Content-Type from options or detect from extension
            $contentType = $options['ContentType'] ?? $options['content_type'] ?? null;
            if (!$contentType) {
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                $mimeMap = [
                    'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg',
                    'png' => 'image/png',  'gif'  => 'image/gif',
                    'svg' => 'image/svg+xml', 'webp' => 'image/webp',
                    'pdf' => 'application/pdf',
                    'json' => 'application/json',
                    'css' => 'text/css', 'js' => 'application/javascript',
                    'html' => 'text/html', 'txt' => 'text/plain',
                ];
                $contentType = $mimeMap[$ext] ?? 'application/octet-stream';
            }
            $blobOptions->setContentType($contentType);

            $this->client->createBlockBlob($this->container, $path, $contents, $blobOptions);
            return true;
        } catch (ServiceException $e) {
            throw new \RuntimeException('Failed to upload to Azure: ' . $e->getMessage());
        }
    }

    public function putStream(string $path, $stream, array $options = []): bool
    {
        if (is_resource($stream)) {
            $contents = stream_get_contents($stream);
        } else {
            $contents = (string) $stream;
        }
        return $this->put($path, $contents, $options);
    }

    public function get(string $path): string
    {
        try {
            $blob = $this->client->getBlob($this->container, $path);
            return stream_get_contents($blob->getContentStream());
        } catch (ServiceException $e) {
            throw new \RuntimeException('Failed to download from Azure: ' . $e->getMessage());
        }
    }

    public function delete(string $path): bool
    {
        try {
            $this->client->deleteBlob($this->container, $path);
            return true;
        } catch (ServiceException $e) {
            return false;
        }
    }

    public function exists(string $path): bool
    {
        try {
            $this->client->getBlobProperties($this->container, $path);
            return true;
        } catch (ServiceException $e) {
            return false;
        }
    }

    /**
     * Create the container if it doesn't exist.
     */
    public function createContainerIfNotExists(): bool
    {
        try {
            $this->client->createContainer($this->container);
            return true;
        } catch (ServiceException $e) {
            // If container already exists, treat as success (409)
            $code = $e->getCode();
            if ($code == 409) {
                return true;
            }
            return false;
        }
    }

    public function getUrl(string $path): string
    {
        return "https://{$this->accountName}.blob.core.windows.net/{$this->container}/{$path}";
    }
}
