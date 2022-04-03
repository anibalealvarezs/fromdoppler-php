<?php

namespace FromDopplerPHP\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use FromDopplerPHP\ApiException;
use FromDopplerPHP\Configuration;
use FromDopplerPHP\HeaderSelector;
use FromDopplerPHP\ObjectSerializer;

class CampaignsApi
{
    protected $client;
    protected $config;
    protected $headerSelector;

    public function __construct(Configuration $config = null)
    {
        $this->client = new Client([
            'defaults' => [
                'timeout' => 120.0
            ]
        ]);
        $this->headerSelector = new HeaderSelector();
        $this->config = $config ?: new Configuration();
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function remove($campaign_id)
    {
        $this->removeWithHttpInfo($campaign_id);
    }

    public function removeWithHttpInfo($campaign_id)
    {
        $request = $this->removeRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function removeRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function deleteFeedbackMessage($campaign_id, $feedback_id)
    {
        $this->deleteFeedbackMessageWithHttpInfo($campaign_id, $feedback_id);
    }

    public function deleteFeedbackMessageWithHttpInfo($campaign_id, $feedback_id)
    {
        $request = $this->deleteFeedbackMessageRequest($campaign_id, $feedback_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function deleteFeedbackMessageRequest($campaign_id, $feedback_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'feedback_id' is set
        if ($feedback_id === null || (is_array($feedback_id) && count($feedback_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $feedback_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/feedback/{feedback_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }
        // path params
        if ($feedback_id !== null) {
            $resourcePath = str_replace(
                '{' . 'feedback_id' . '}',
                ObjectSerializer::toPathValue($feedback_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'DELETE',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function list($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $status = null, $before_send_time = null, $since_send_time = null, $before_create_time = null, $since_create_time = null, $list_id = null, $folder_id = null, $member_id = null, $sort_field = null, $sort_dir = null)
    {
        $response = $this->listWithHttpInfo($fields, $exclude_fields, $count, $offset, $type, $status, $before_send_time, $since_send_time, $before_create_time, $since_create_time, $list_id, $folder_id, $member_id, $sort_field, $sort_dir);
        return $response;
    }

    public function listWithHttpInfo($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $status = null, $before_send_time = null, $since_send_time = null, $before_create_time = null, $since_create_time = null, $list_id = null, $folder_id = null, $member_id = null, $sort_field = null, $sort_dir = null)
    {
        $request = $this->listRequest($fields, $exclude_fields, $count, $offset, $type, $status, $before_send_time, $since_send_time, $before_create_time, $since_create_time, $list_id, $folder_id, $member_id, $sort_field, $sort_dir);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function listRequest($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $status = null, $before_send_time = null, $since_send_time = null, $before_create_time = null, $since_create_time = null, $list_id = null, $folder_id = null, $member_id = null, $sort_field = null, $sort_dir = null)
    {
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling CampaignsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/campaigns';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }
        // query params
        if ($count !== null) {
            $queryParams['count'] = ObjectSerializer::toQueryValue($count);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = ObjectSerializer::toQueryValue($offset);
        }
        // query params
        if ($type !== null) {
            $queryParams['type'] = ObjectSerializer::toQueryValue($type);
        }
        // query params
        if ($status !== null) {
            $queryParams['status'] = ObjectSerializer::toQueryValue($status);
        }
        // query params
        if ($before_send_time !== null) {
            $queryParams['before_send_time'] = ObjectSerializer::toQueryValue($before_send_time);
        }
        // query params
        if ($since_send_time !== null) {
            $queryParams['since_send_time'] = ObjectSerializer::toQueryValue($since_send_time);
        }
        // query params
        if ($before_create_time !== null) {
            $queryParams['before_create_time'] = ObjectSerializer::toQueryValue($before_create_time);
        }
        // query params
        if ($since_create_time !== null) {
            $queryParams['since_create_time'] = ObjectSerializer::toQueryValue($since_create_time);
        }
        // query params
        if ($list_id !== null) {
            $queryParams['list_id'] = ObjectSerializer::toQueryValue($list_id);
        }
        // query params
        if ($folder_id !== null) {
            $queryParams['folder_id'] = ObjectSerializer::toQueryValue($folder_id);
        }
        // query params
        if ($member_id !== null) {
            $queryParams['member_id'] = ObjectSerializer::toQueryValue($member_id);
        }
        // query params
        if ($sort_field !== null) {
            $queryParams['sort_field'] = ObjectSerializer::toQueryValue($sort_field);
        }
        // query params
        if ($sort_dir !== null) {
            $queryParams['sort_dir'] = ObjectSerializer::toQueryValue($sort_dir);
        }


        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function get($campaign_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getWithHttpInfo($campaign_id, $fields, $exclude_fields);
        return $response;
    }

    public function getWithHttpInfo($campaign_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getRequest($campaign_id, $fields, $exclude_fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getRequest($campaign_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function getContent($campaign_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getContentWithHttpInfo($campaign_id, $fields, $exclude_fields);
        return $response;
    }

    public function getContentWithHttpInfo($campaign_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getContentRequest($campaign_id, $fields, $exclude_fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getContentRequest($campaign_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/content';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function getFeedback($campaign_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getFeedbackWithHttpInfo($campaign_id, $fields, $exclude_fields);
        return $response;
    }

    public function getFeedbackWithHttpInfo($campaign_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getFeedbackRequest($campaign_id, $fields, $exclude_fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getFeedbackRequest($campaign_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/feedback';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function getFeedbackMessage($campaign_id, $feedback_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getFeedbackMessageWithHttpInfo($campaign_id, $feedback_id, $fields, $exclude_fields);
        return $response;
    }

    public function getFeedbackMessageWithHttpInfo($campaign_id, $feedback_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getFeedbackMessageRequest($campaign_id, $feedback_id, $fields, $exclude_fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getFeedbackMessageRequest($campaign_id, $feedback_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'feedback_id' is set
        if ($feedback_id === null || (is_array($feedback_id) && count($feedback_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $feedback_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/feedback/{feedback_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }
        // path params
        if ($feedback_id !== null) {
            $resourcePath = str_replace(
                '{' . 'feedback_id' . '}',
                ObjectSerializer::toPathValue($feedback_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function getSendChecklist($campaign_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getSendChecklistWithHttpInfo($campaign_id, $fields, $exclude_fields);
        return $response;
    }

    public function getSendChecklistWithHttpInfo($campaign_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getSendChecklistRequest($campaign_id, $fields, $exclude_fields);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function getSendChecklistRequest($campaign_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/send-checklist';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;
        // query params
        if (is_array($fields)) {
            $queryParams['fields'] = ObjectSerializer::serializeCollection($fields, 'csv');
        } else
        if ($fields !== null) {
            $queryParams['fields'] = ObjectSerializer::toQueryValue($fields);
        }
        // query params
        if (is_array($exclude_fields)) {
            $queryParams['exclude_fields'] = ObjectSerializer::serializeCollection($exclude_fields, 'csv');
        } else
        if ($exclude_fields !== null) {
            $queryParams['exclude_fields'] = ObjectSerializer::toQueryValue($exclude_fields);
        }

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'GET',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function update($campaign_id, $body)
    {
        $response = $this->updateWithHttpInfo($campaign_id, $body);
        return $response;
    }

    public function updateWithHttpInfo($campaign_id, $body)
    {
        $request = $this->updateRequest($campaign_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function updateRequest($campaign_id, $body)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function updateFeedbackMessage($campaign_id, $feedback_id, $body)
    {
        $response = $this->updateFeedbackMessageWithHttpInfo($campaign_id, $feedback_id, $body);
        return $response;
    }

    public function updateFeedbackMessageWithHttpInfo($campaign_id, $feedback_id, $body)
    {
        $request = $this->updateFeedbackMessageRequest($campaign_id, $feedback_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function updateFeedbackMessageRequest($campaign_id, $feedback_id, $body)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'feedback_id' is set
        if ($feedback_id === null || (is_array($feedback_id) && count($feedback_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $feedback_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/feedback/{feedback_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }
        // path params
        if ($feedback_id !== null) {
            $resourcePath = str_replace(
                '{' . 'feedback_id' . '}',
                ObjectSerializer::toPathValue($feedback_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'PATCH',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function create($body)
    {
        $response = $this->createWithHttpInfo($body);
        return $response;
    }

    public function createWithHttpInfo($body)
    {
        $request = $this->createRequest($body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function createRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;


        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function cancelSend($campaign_id)
    {
        $this->cancelSendWithHttpInfo($campaign_id);
    }

    public function cancelSendWithHttpInfo($campaign_id)
    {
        $request = $this->cancelSendRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function cancelSendRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/cancel-send';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function createResend($campaign_id)
    {
        $response = $this->createResendWithHttpInfo($campaign_id);
        return $response;
    }

    public function createResendWithHttpInfo($campaign_id)
    {
        $request = $this->createResendRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function createResendRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/create-resend';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function pause($campaign_id)
    {
        $this->pauseWithHttpInfo($campaign_id);
    }

    public function pauseWithHttpInfo($campaign_id)
    {
        $request = $this->pauseRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function pauseRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/pause';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function replicate($campaign_id)
    {
        $response = $this->replicateWithHttpInfo($campaign_id);
        return $response;
    }

    public function replicateWithHttpInfo($campaign_id)
    {
        $request = $this->replicateRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function replicateRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/replicate';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function resume($campaign_id)
    {
        $this->resumeWithHttpInfo($campaign_id);
    }

    public function resumeWithHttpInfo($campaign_id)
    {
        $request = $this->resumeRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function resumeRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/resume';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function schedule($campaign_id, $body)
    {
        $this->scheduleWithHttpInfo($campaign_id, $body);
    }

    public function scheduleWithHttpInfo($campaign_id, $body)
    {
        $request = $this->scheduleRequest($campaign_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function scheduleRequest($campaign_id, $body)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/schedule';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function send($campaign_id)
    {
        $this->sendWithHttpInfo($campaign_id);
    }

    public function sendWithHttpInfo($campaign_id)
    {
        $request = $this->sendRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function sendRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/send';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function sendTestEmail($campaign_id, $body)
    {
        $this->sendTestEmailWithHttpInfo($campaign_id, $body);
    }

    public function sendTestEmailWithHttpInfo($campaign_id, $body)
    {
        $request = $this->sendTestEmailRequest($campaign_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function sendTestEmailRequest($campaign_id, $body)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/test';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function unschedule($campaign_id)
    {
        $this->unscheduleWithHttpInfo($campaign_id);
    }

    public function unscheduleWithHttpInfo($campaign_id)
    {
        $request = $this->unscheduleRequest($campaign_id);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function unscheduleRequest($campaign_id)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/actions/unschedule';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function addFeedback($campaign_id, $body)
    {
        $response = $this->addFeedbackWithHttpInfo($campaign_id, $body);
        return $response;
    }

    public function addFeedbackWithHttpInfo($campaign_id, $body)
    {
        $request = $this->addFeedbackRequest($campaign_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function addFeedbackRequest($campaign_id, $body)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/feedback';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'POST',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    public function setContent($campaign_id, $body)
    {
        $response = $this->setContentWithHttpInfo($campaign_id, $body);
        return $response;
    }

    public function setContentWithHttpInfo($campaign_id, $body)
    {
        $request = $this->setContentRequest($campaign_id, $body);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw $e;
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            $content = $responseBody->getContents();
            $content = json_decode($content);

            return $content;

        } catch (ApiException $e) {
            throw $e->getResponseBody();
        }
    }

    protected function setContentRequest($campaign_id, $body)
    {
        // verify the required parameter 'campaign_id' is set
        if ($campaign_id === null || (is_array($campaign_id) && count($campaign_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $campaign_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/campaigns/{campaign_id}/content';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($campaign_id !== null) {
            $resourcePath = str_replace(
                '{' . 'campaign_id' . '}',
                ObjectSerializer::toPathValue($campaign_id),
                $resourcePath
            );
        }

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json', 'application/problem+json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json', 'application/problem+json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody;

            if($headers['Content-Type'] === 'application/json') {
                if ($httpBody instanceof \stdClass) {
                    $httpBody = \GuzzleHttp\json_encode($httpBody);
                }
                if (is_array($httpBody)) {
                    $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($httpBody));
                }
            }
        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents);

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = Query::build($formParams);
            }
        }


        // Basic Authentication
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $headers['Authorization'] = 'Basic ' . base64_encode($this->config->getUsername() . ":" . $this->config->getPassword());
        }

        // OAuth Authentication
        if (!empty($this->config->getAccessToken())) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = Query::build($queryParams);
        return new Request(
            'PUT',
            $this->config->getHost() . $resourcePath . ($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: ' . $this->config->getDebugFile());
            }
        }

        if ($this->config->getTimeout()) {
            $options[RequestOptions::TIMEOUT] = $this->config->getTimeout();
        }

        return $options;
    }
}
