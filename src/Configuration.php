<?php

namespace FromDopplerPHP;

use FromDopplerPHP\Api\ListsApi;

class Configuration
{
    private static Configuration $defaultConfiguration;

    protected string $apiKey = "";
    protected string $account = '';
    protected string $host = 'https://restapi.fromdoppler.com';
    protected bool $debug = false;
    protected string $debugFile = 'php://output';
    protected string $tempFolderPath;
    protected int $timeout = 120;
    public ListsApi $lists;

    public function __construct()
    {
        $this->tempFolderPath = sys_get_temp_dir();

        $this->lists = new ListsApi($this);
    }

    public function setConfig($config = array()): Configuration
    {
        $apiKey = $config['apiKey'] ?? '';
        $account = $config['account'] ?? '';

        // Bearer Authentication
        if (!empty($apiKey) && !empty($account)) {
            $this->setAccount($account);
            $this->setApiKey($apiKey);
        }

        if (isset($config['timeout'])) {
            $this->timeout = $config['timeout'];
        }

        return $this;
    }

    public function setApiKey($key): Configuration
    {
        $this->apiKey = $key;
        return $this;
    }

    public function getApiKey()
    {
        return $this->apiKey ?? null;
    }

    public function setAccount($account): Configuration
    {
        $this->account = $account;
        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    public function setHost($host): Configuration
    {
        $this->host = $host;
        return $this;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function setDebug($debug): Configuration
    {
        $this->debug = $debug;
        return $this;
    }

    public function getDebug(): bool
    {
        return $this->debug;
    }

    public function setDebugFile($debugFile): Configuration
    {
        $this->debugFile = $debugFile;
        return $this;
    }

    public function getDebugFile(): string
    {
        return $this->debugFile;
    }

    public function setTempFolderPath($tempFolderPath): Configuration
    {
        $this->tempFolderPath = $tempFolderPath;
        return $this;
    }

    public function getTempFolderPath(): string
    {
        return $this->tempFolderPath;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function getTimeout(): int
    {
        return $this->timeout;
    }

    public static function getDefaultConfiguration(): Configuration
    {
        if (self::$defaultConfiguration === null) {
            self::$defaultConfiguration = new Configuration();
        }

        return self::$defaultConfiguration;
    }

    public static function setDefaultConfiguration(Configuration $config)
    {
        self::$defaultConfiguration = $config;
    }

    public static function toDebugReport(): string
    {
        $report  = 'PHP SDK (FromDopplerPHP) Debug Report:' . PHP_EOL;
        $report .= '    OS: ' . php_uname() . PHP_EOL;
        $report .= '    PHP Version: ' . PHP_VERSION . PHP_EOL;
        $report .= '    OpenAPI Spec Version: 0.0.1' . PHP_EOL;
        $report .= '    SDK Package Version: 0.0.1' . PHP_EOL;
        $report .= '    Temp Folder Path: ' . self::getDefaultConfiguration()->getTempFolderPath() . PHP_EOL;

        return $report;
    }
}
