<?php

require __DIR__ . '/vendor/autoload.php';

use App\Storage\AzureStorageManager;

// Read env from .env if available
if (file_exists(__DIR__ . '/.env')) {
    // load minimal env for script
    $lines = file(__DIR__ . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (!strpos($line, '=')) continue;
        list($k, $v) = explode('=', $line, 2);
        putenv(trim($k) . '=' . trim($v));
    }
}

$account = getenv('AZURE_STORAGE_ACCOUNT') ?: 'cheenti';
$key = getenv('AZURE_STORAGE_KEY') ?: '';
$container = getenv('AZURE_STORAGE_CONTAINER') ?: 'company-logos';

echo "Using Azure account: {$account}, container: {$container}\n";

try {
    $mgr = new AzureStorageManager($account, $key, $container);

    // create a small temp file
    $tmp = sys_get_temp_dir() . '/azure-test-' . time() . '.txt';
    file_put_contents($tmp, "Azure upload test at " . date('c'));

    $path = 'company-logos/test-' . time() . '.txt';

    // use putStream
    $res = $mgr->putStream($path, fopen($tmp, 'r'));
    echo 'putStream result: ' . ($res ? 'success' : 'failed') . "\n";

    $url = $mgr->getUrl($path);
    echo 'URL: ' . $url . "\n";

    echo 'exists: ' . ($mgr->exists($path) ? 'yes' : 'no') . "\n";

    // cleanup local temp
    @unlink($tmp);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage() . "\n";
}

echo "Done\n";
