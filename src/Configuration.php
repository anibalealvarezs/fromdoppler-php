<?php

namespace FromDopplerPHP;

use FromDopplerPHP\Api\AccountExportApi;
use FromDopplerPHP\Api\AccountExportsApi;
use FromDopplerPHP\Api\ActivityFeedApi;
use FromDopplerPHP\Api\AuthorizedAppsApi;
use FromDopplerPHP\Api\AutomationsApi;
use FromDopplerPHP\Api\BatchWebhooksApi;
use FromDopplerPHP\Api\BatchesApi;
use FromDopplerPHP\Api\CampaignFoldersApi;
use FromDopplerPHP\Api\CampaignsApi;
use FromDopplerPHP\Api\ConnectedSitesApi;
use FromDopplerPHP\Api\ConversationsApi;
use FromDopplerPHP\Api\CustomerJourneysApi;
use FromDopplerPHP\Api\EcommerceApi;
use FromDopplerPHP\Api\FacebookAdsApi;
use FromDopplerPHP\Api\FileManagerApi;
use FromDopplerPHP\Api\LandingPagesApi;
use FromDopplerPHP\Api\ListsApi;
use FromDopplerPHP\Api\PingApi;
use FromDopplerPHP\Api\ReportingApi;
use FromDopplerPHP\Api\ReportsApi;
use FromDopplerPHP\Api\RootApi;
use FromDopplerPHP\Api\SearchCampaignsApi;
use FromDopplerPHP\Api\SearchMembersApi;
use FromDopplerPHP\Api\TemplateFoldersApi;
use FromDopplerPHP\Api\TemplatesApi;
use FromDopplerPHP\Api\VerifiedDomainsApi;

class Configuration
{
    private static $defaultConfiguration;

    protected $apiKeys = [];
    protected $apiKeyPrefixes = [];
    protected $accessToken = '';
    protected $username = '';
    protected $password = '';
    protected $host = 'https://server.api.mailchimp.com/3.0';
    protected $userAgent = 'Swagger-Codegen/3.0.74/php';
    protected $debug = false;
    protected $debugFile = 'php://output';
    protected $tempFolderPath;
    protected $timeout = 120;

    public function __construct()
    {
        $this->tempFolderPath = sys_get_temp_dir();

        $this->accountExport = new AccountExportApi($this);
        $this->accountExports = new AccountExportsApi($this);
        $this->activityFeed = new ActivityFeedApi($this);
        $this->authorizedApps = new AuthorizedAppsApi($this);
        $this->automations = new AutomationsApi($this);
        $this->batchWebhooks = new BatchWebhooksApi($this);
        $this->batches = new BatchesApi($this);
        $this->campaignFolders = new CampaignFoldersApi($this);
        $this->campaigns = new CampaignsApi($this);
        $this->connectedSites = new ConnectedSitesApi($this);
        $this->conversations = new ConversationsApi($this);
        $this->customerJourneys = new CustomerJourneysApi($this);
        $this->ecommerce = new EcommerceApi($this);
        $this->facebookAds = new FacebookAdsApi($this);
        $this->fileManager = new FileManagerApi($this);
        $this->landingPages = new LandingPagesApi($this);
        $this->lists = new ListsApi($this);
        $this->ping = new PingApi($this);
        $this->reporting = new ReportingApi($this);
        $this->reports = new ReportsApi($this);
        $this->root = new RootApi($this);
        $this->searchCampaigns = new SearchCampaignsApi($this);
        $this->searchMembers = new SearchMembersApi($this);
        $this->templateFolders = new TemplateFoldersApi($this);
        $this->templates = new TemplatesApi($this);
        $this->verifiedDomains = new VerifiedDomainsApi($this);
    }

    public function setConfig($config = array())
    {
        $apiKey = isset($config['apiKey']) ? $config['apiKey'] : '';
        $accessToken = isset($config['accessToken']) ? $config['accessToken'] : '';
        $server = isset($config['server']) ? $config['server'] : 'invalid-server';
        $host = str_replace('server', $server, $this->getHost());

        // Basic Authentication
        if (!empty($apiKey)) {
            $this->setUsername('user');
            $this->setPassword($apiKey);
        }

        // OAuth Authentication
        elseif (!empty($accessToken)) {
            $this->accessToken = $accessToken;
        }

        $this->setHost($host);

        if (isset($config['timeout'])) {
            $this->timeout = $config['timeout'];
        }

        return $this;
    }

    public function setApiKey($apiKeyIdentifier, $key)
    {
        $this->apiKeys[$apiKeyIdentifier] = $key;
        return $this;
    }

    public function getApiKey($apiKeyIdentifier)
    {
        return isset($this->apiKeys[$apiKeyIdentifier]) ? $this->apiKeys[$apiKeyIdentifier] : null;
    }

    public function setApiKeyPrefix($apiKeyIdentifier, $prefix)
    {
        $this->apiKeyPrefixes[$apiKeyIdentifier] = $prefix;
        return $this;
    }

    public function getApiKeyPrefix($apiKeyIdentifier)
    {
        return isset($this->apiKeyPrefixes[$apiKeyIdentifier]) ? $this->apiKeyPrefixes[$apiKeyIdentifier] : null;
    }

    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setHost($host)
    {
        $this->host = $host;
        return $this;
    }

    public function getHost()
    {
        return $this->host;
    }

    public function setUserAgent($userAgent)
    {
        if (!is_string($userAgent)) {
            throw new \InvalidArgumentException('User-agent must be a string.');
        }

        $this->userAgent = $userAgent;
        return $this;
    }

    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setDebug($debug)
    {
        $this->debug = $debug;
        return $this;
    }

    public function getDebug()
    {
        return $this->debug;
    }

    public function setDebugFile($debugFile)
    {
        $this->debugFile = $debugFile;
        return $this;
    }

    public function getDebugFile()
    {
        return $this->debugFile;
    }

    public function setTempFolderPath($tempFolderPath)
    {
        $this->tempFolderPath = $tempFolderPath;
        return $this;
    }

    public function getTempFolderPath()
    {
        return $this->tempFolderPath;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public static function getDefaultConfiguration()
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

    public static function toDebugReport()
    {
        $report  = 'PHP SDK (FromDopplerPHP) Debug Report:' . PHP_EOL;
        $report .= '    OS: ' . php_uname() . PHP_EOL;
        $report .= '    PHP Version: ' . PHP_VERSION . PHP_EOL;
        $report .= '    OpenAPI Spec Version: 3.0.74' . PHP_EOL;
        $report .= '    SDK Package Version: 3.0.74' . PHP_EOL;
        $report .= '    Temp Folder Path: ' . self::getDefaultConfiguration()->getTempFolderPath() . PHP_EOL;

        return $report;
    }

    public function getApiKeyWithPrefix($apiKeyIdentifier)
    {
        $prefix = $this->getApiKeyPrefix($apiKeyIdentifier);
        $apiKey = $this->getApiKey($apiKeyIdentifier);

        if ($apiKey === null) {
            return null;
        }

        if ($prefix === null) {
            $keyWithPrefix = $apiKey;
        } else {
            $keyWithPrefix = $prefix . ' ' . $apiKey;
        }

        return $keyWithPrefix;
    }
}
