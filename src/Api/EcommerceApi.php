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

class EcommerceApi
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

    public function deleteStore($store_id)
    {
        $response = $this->deleteStoreWithHttpInfo($store_id);
        return $response;
    }

    public function deleteStoreWithHttpInfo($store_id)
    {
        $request = $this->deleteStoreRequest($store_id);

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

    protected function deleteStoreRequest($store_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function deleteStoreCart($store_id, $cart_id)
    {
        $this->deleteStoreCartWithHttpInfo($store_id, $cart_id);
    }

    public function deleteStoreCartWithHttpInfo($store_id, $cart_id)
    {
        $request = $this->deleteStoreCartRequest($store_id, $cart_id);

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

    protected function deleteStoreCartRequest($store_id, $cart_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
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

    public function deleteCartLineItem($store_id, $cart_id, $line_id)
    {
        $this->deleteCartLineItemWithHttpInfo($store_id, $cart_id, $line_id);
    }

    public function deleteCartLineItemWithHttpInfo($store_id, $cart_id, $line_id)
    {
        $request = $this->deleteCartLineItemRequest($store_id, $cart_id, $line_id);

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

    protected function deleteCartLineItemRequest($store_id, $cart_id, $line_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }
        // verify the required parameter 'line_id' is set
        if ($line_id === null || (is_array($line_id) && count($line_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $line_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}/lines/{line_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
                $resourcePath
            );
        }
        // path params
        if ($line_id !== null) {
            $resourcePath = str_replace(
                '{' . 'line_id' . '}',
                ObjectSerializer::toPathValue($line_id),
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

    public function deleteStoreCustomer($store_id, $customer_id)
    {
        $this->deleteStoreCustomerWithHttpInfo($store_id, $customer_id);
    }

    public function deleteStoreCustomerWithHttpInfo($store_id, $customer_id)
    {
        $request = $this->deleteStoreCustomerRequest($store_id, $customer_id);

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

    protected function deleteStoreCustomerRequest($store_id, $customer_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'customer_id' is set
        if ($customer_id === null || (is_array($customer_id) && count($customer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $customer_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/customers/{customer_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($customer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customer_id' . '}',
                ObjectSerializer::toPathValue($customer_id),
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

    public function deleteOrder($store_id, $order_id)
    {
        $this->deleteOrderWithHttpInfo($store_id, $order_id);
    }

    public function deleteOrderWithHttpInfo($store_id, $order_id)
    {
        $request = $this->deleteOrderRequest($store_id, $order_id);

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

    protected function deleteOrderRequest($store_id, $order_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
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

    public function deleteOrderLineItem($store_id, $order_id, $line_id)
    {
        $this->deleteOrderLineItemWithHttpInfo($store_id, $order_id, $line_id);
    }

    public function deleteOrderLineItemWithHttpInfo($store_id, $order_id, $line_id)
    {
        $request = $this->deleteOrderLineItemRequest($store_id, $order_id, $line_id);

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

    protected function deleteOrderLineItemRequest($store_id, $order_id, $line_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }
        // verify the required parameter 'line_id' is set
        if ($line_id === null || (is_array($line_id) && count($line_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $line_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}/lines/{line_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }
        // path params
        if ($line_id !== null) {
            $resourcePath = str_replace(
                '{' . 'line_id' . '}',
                ObjectSerializer::toPathValue($line_id),
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

    public function deleteStoreProduct($store_id, $product_id)
    {
        $this->deleteStoreProductWithHttpInfo($store_id, $product_id);
    }

    public function deleteStoreProductWithHttpInfo($store_id, $product_id)
    {
        $request = $this->deleteStoreProductRequest($store_id, $product_id);

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

    protected function deleteStoreProductRequest($store_id, $product_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function deleteProductImage($store_id, $product_id, $image_id)
    {
        $this->deleteProductImageWithHttpInfo($store_id, $product_id, $image_id);
    }

    public function deleteProductImageWithHttpInfo($store_id, $product_id, $image_id)
    {
        $request = $this->deleteProductImageRequest($store_id, $product_id, $image_id);

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

    protected function deleteProductImageRequest($store_id, $product_id, $image_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'image_id' is set
        if ($image_id === null || (is_array($image_id) && count($image_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $image_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/images/{image_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($image_id !== null) {
            $resourcePath = str_replace(
                '{' . 'image_id' . '}',
                ObjectSerializer::toPathValue($image_id),
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

    public function deleteProductVariant($store_id, $product_id, $variant_id)
    {
        $this->deleteProductVariantWithHttpInfo($store_id, $product_id, $variant_id);
    }

    public function deleteProductVariantWithHttpInfo($store_id, $product_id, $variant_id)
    {
        $request = $this->deleteProductVariantRequest($store_id, $product_id, $variant_id);

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

    protected function deleteProductVariantRequest($store_id, $product_id, $variant_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'variant_id' is set
        if ($variant_id === null || (is_array($variant_id) && count($variant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $variant_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($variant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'variant_id' . '}',
                ObjectSerializer::toPathValue($variant_id),
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

    public function deletePromoCode($store_id, $promo_rule_id, $promo_code_id)
    {
        $this->deletePromoCodeWithHttpInfo($store_id, $promo_rule_id, $promo_code_id);
    }

    public function deletePromoCodeWithHttpInfo($store_id, $promo_rule_id, $promo_code_id)
    {
        $request = $this->deletePromoCodeRequest($store_id, $promo_rule_id, $promo_code_id);

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

    protected function deletePromoCodeRequest($store_id, $promo_rule_id, $promo_code_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }
        // verify the required parameter 'promo_code_id' is set
        if ($promo_code_id === null || (is_array($promo_code_id) && count($promo_code_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_code_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes/{promo_code_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_code_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_code_id' . '}',
                ObjectSerializer::toPathValue($promo_code_id),
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

    public function deletePromoRule($store_id, $promo_rule_id)
    {
        $this->deletePromoRuleWithHttpInfo($store_id, $promo_rule_id);
    }

    public function deletePromoRuleWithHttpInfo($store_id, $promo_rule_id)
    {
        $request = $this->deletePromoRuleRequest($store_id, $promo_rule_id);

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

    protected function deletePromoRuleRequest($store_id, $promo_rule_id)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
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

    public function orders($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $campaign_id = null, $outreach_id = null, $customer_id = null, $has_outreach = null)
    {
        $response = $this->ordersWithHttpInfo($fields, $exclude_fields, $count, $offset, $campaign_id, $outreach_id, $customer_id, $has_outreach);
        return $response;
    }

    public function ordersWithHttpInfo($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $campaign_id = null, $outreach_id = null, $customer_id = null, $has_outreach = null)
    {
        $request = $this->ordersRequest($fields, $exclude_fields, $count, $offset, $campaign_id, $outreach_id, $customer_id, $has_outreach);

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

    protected function ordersRequest($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $campaign_id = null, $outreach_id = null, $customer_id = null, $has_outreach = null)
    {
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/orders';
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
        if ($campaign_id !== null) {
            $queryParams['campaign_id'] = ObjectSerializer::toQueryValue($campaign_id);
        }
        // query params
        if ($outreach_id !== null) {
            $queryParams['outreach_id'] = ObjectSerializer::toQueryValue($outreach_id);
        }
        // query params
        if ($customer_id !== null) {
            $queryParams['customer_id'] = ObjectSerializer::toQueryValue($customer_id);
        }
        // query params
        if ($has_outreach !== null) {
            $queryParams['has_outreach'] = ObjectSerializer::toQueryValue($has_outreach);
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

    public function stores($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->storesWithHttpInfo($fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function storesWithHttpInfo($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->storesRequest($fields, $exclude_fields, $count, $offset);

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

    protected function storesRequest($fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores';
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

    public function getStore($store_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getStoreWithHttpInfo($store_id, $fields, $exclude_fields);
        return $response;
    }

    public function getStoreWithHttpInfo($store_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getStoreRequest($store_id, $fields, $exclude_fields);

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

    protected function getStoreRequest($store_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getStoreCarts($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getStoreCartsWithHttpInfo($store_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getStoreCartsWithHttpInfo($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getStoreCartsRequest($store_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getStoreCartsRequest($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/carts';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getStoreCart($store_id, $cart_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getStoreCartWithHttpInfo($store_id, $cart_id, $fields, $exclude_fields);
        return $response;
    }

    public function getStoreCartWithHttpInfo($store_id, $cart_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getStoreCartRequest($store_id, $cart_id, $fields, $exclude_fields);

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

    protected function getStoreCartRequest($store_id, $cart_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
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

    public function getAllCartLineItems($store_id, $cart_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getAllCartLineItemsWithHttpInfo($store_id, $cart_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getAllCartLineItemsWithHttpInfo($store_id, $cart_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getAllCartLineItemsRequest($store_id, $cart_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getAllCartLineItemsRequest($store_id, $cart_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}/lines';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
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

    public function getCartLineItem($store_id, $cart_id, $line_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getCartLineItemWithHttpInfo($store_id, $cart_id, $line_id, $fields, $exclude_fields);
        return $response;
    }

    public function getCartLineItemWithHttpInfo($store_id, $cart_id, $line_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getCartLineItemRequest($store_id, $cart_id, $line_id, $fields, $exclude_fields);

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

    protected function getCartLineItemRequest($store_id, $cart_id, $line_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }
        // verify the required parameter 'line_id' is set
        if ($line_id === null || (is_array($line_id) && count($line_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $line_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}/lines/{line_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
                $resourcePath
            );
        }
        // path params
        if ($line_id !== null) {
            $resourcePath = str_replace(
                '{' . 'line_id' . '}',
                ObjectSerializer::toPathValue($line_id),
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

    public function getAllStoreCustomers($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $email_address = null)
    {
        $response = $this->getAllStoreCustomersWithHttpInfo($store_id, $fields, $exclude_fields, $count, $offset, $email_address);
        return $response;
    }

    public function getAllStoreCustomersWithHttpInfo($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $email_address = null)
    {
        $request = $this->getAllStoreCustomersRequest($store_id, $fields, $exclude_fields, $count, $offset, $email_address);

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

    protected function getAllStoreCustomersRequest($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $email_address = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/customers';
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
        if ($email_address !== null) {
            $queryParams['email_address'] = ObjectSerializer::toQueryValue($email_address);
        }

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getStoreCustomer($store_id, $customer_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getStoreCustomerWithHttpInfo($store_id, $customer_id, $fields, $exclude_fields);
        return $response;
    }

    public function getStoreCustomerWithHttpInfo($store_id, $customer_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getStoreCustomerRequest($store_id, $customer_id, $fields, $exclude_fields);

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

    protected function getStoreCustomerRequest($store_id, $customer_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'customer_id' is set
        if ($customer_id === null || (is_array($customer_id) && count($customer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $customer_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/customers/{customer_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($customer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customer_id' . '}',
                ObjectSerializer::toPathValue($customer_id),
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

    public function getStoreOrders($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $customer_id = null, $has_outreach = null, $campaign_id = null, $outreach_id = null)
    {
        $response = $this->getStoreOrdersWithHttpInfo($store_id, $fields, $exclude_fields, $count, $offset, $customer_id, $has_outreach, $campaign_id, $outreach_id);
        return $response;
    }

    public function getStoreOrdersWithHttpInfo($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $customer_id = null, $has_outreach = null, $campaign_id = null, $outreach_id = null)
    {
        $request = $this->getStoreOrdersRequest($store_id, $fields, $exclude_fields, $count, $offset, $customer_id, $has_outreach, $campaign_id, $outreach_id);

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

    protected function getStoreOrdersRequest($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $customer_id = null, $has_outreach = null, $campaign_id = null, $outreach_id = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/orders';
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
        if ($customer_id !== null) {
            $queryParams['customer_id'] = ObjectSerializer::toQueryValue($customer_id);
        }
        // query params
        if ($has_outreach !== null) {
            $queryParams['has_outreach'] = ObjectSerializer::toQueryValue($has_outreach);
        }
        // query params
        if ($campaign_id !== null) {
            $queryParams['campaign_id'] = ObjectSerializer::toQueryValue($campaign_id);
        }
        // query params
        if ($outreach_id !== null) {
            $queryParams['outreach_id'] = ObjectSerializer::toQueryValue($outreach_id);
        }

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getOrder($store_id, $order_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getOrderWithHttpInfo($store_id, $order_id, $fields, $exclude_fields);
        return $response;
    }

    public function getOrderWithHttpInfo($store_id, $order_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getOrderRequest($store_id, $order_id, $fields, $exclude_fields);

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

    protected function getOrderRequest($store_id, $order_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
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

    public function getAllOrderLineItems($store_id, $order_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getAllOrderLineItemsWithHttpInfo($store_id, $order_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getAllOrderLineItemsWithHttpInfo($store_id, $order_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getAllOrderLineItemsRequest($store_id, $order_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getAllOrderLineItemsRequest($store_id, $order_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}/lines';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
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

    public function getOrderLineItem($store_id, $order_id, $line_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getOrderLineItemWithHttpInfo($store_id, $order_id, $line_id, $fields, $exclude_fields);
        return $response;
    }

    public function getOrderLineItemWithHttpInfo($store_id, $order_id, $line_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getOrderLineItemRequest($store_id, $order_id, $line_id, $fields, $exclude_fields);

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

    protected function getOrderLineItemRequest($store_id, $order_id, $line_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }
        // verify the required parameter 'line_id' is set
        if ($line_id === null || (is_array($line_id) && count($line_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $line_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}/lines/{line_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }
        // path params
        if ($line_id !== null) {
            $resourcePath = str_replace(
                '{' . 'line_id' . '}',
                ObjectSerializer::toPathValue($line_id),
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

    public function getAllStoreProducts($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getAllStoreProductsWithHttpInfo($store_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getAllStoreProductsWithHttpInfo($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getAllStoreProductsRequest($store_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getAllStoreProductsRequest($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/products';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getStoreProduct($store_id, $product_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getStoreProductWithHttpInfo($store_id, $product_id, $fields, $exclude_fields);
        return $response;
    }

    public function getStoreProductWithHttpInfo($store_id, $product_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getStoreProductRequest($store_id, $product_id, $fields, $exclude_fields);

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

    protected function getStoreProductRequest($store_id, $product_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function getProductImages($store_id, $product_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getProductImagesWithHttpInfo($store_id, $product_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getProductImagesWithHttpInfo($store_id, $product_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getProductImagesRequest($store_id, $product_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getProductImagesRequest($store_id, $product_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/images';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function getProductImage($store_id, $product_id, $image_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getProductImageWithHttpInfo($store_id, $product_id, $image_id, $fields, $exclude_fields);
        return $response;
    }

    public function getProductImageWithHttpInfo($store_id, $product_id, $image_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getProductImageRequest($store_id, $product_id, $image_id, $fields, $exclude_fields);

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

    protected function getProductImageRequest($store_id, $product_id, $image_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'image_id' is set
        if ($image_id === null || (is_array($image_id) && count($image_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $image_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/images/{image_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($image_id !== null) {
            $resourcePath = str_replace(
                '{' . 'image_id' . '}',
                ObjectSerializer::toPathValue($image_id),
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

    public function getProductVariants($store_id, $product_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getProductVariantsWithHttpInfo($store_id, $product_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getProductVariantsWithHttpInfo($store_id, $product_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getProductVariantsRequest($store_id, $product_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getProductVariantsRequest($store_id, $product_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/variants';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function getProductVariant($store_id, $product_id, $variant_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getProductVariantWithHttpInfo($store_id, $product_id, $variant_id, $fields, $exclude_fields);
        return $response;
    }

    public function getProductVariantWithHttpInfo($store_id, $product_id, $variant_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getProductVariantRequest($store_id, $product_id, $variant_id, $fields, $exclude_fields);

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

    protected function getProductVariantRequest($store_id, $product_id, $variant_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'variant_id' is set
        if ($variant_id === null || (is_array($variant_id) && count($variant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $variant_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($variant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'variant_id' . '}',
                ObjectSerializer::toPathValue($variant_id),
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

    public function getPromoCodes($promo_rule_id, $store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getPromoCodesWithHttpInfo($promo_rule_id, $store_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getPromoCodesWithHttpInfo($promo_rule_id, $store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getPromoCodesRequest($promo_rule_id, $store_id, $fields, $exclude_fields, $count, $offset);

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

    protected function getPromoCodesRequest($promo_rule_id, $store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes';
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

        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
                $resourcePath
            );
        }
        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getPromoCode($store_id, $promo_rule_id, $promo_code_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getPromoCodeWithHttpInfo($store_id, $promo_rule_id, $promo_code_id, $fields, $exclude_fields);
        return $response;
    }

    public function getPromoCodeWithHttpInfo($store_id, $promo_rule_id, $promo_code_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getPromoCodeRequest($store_id, $promo_rule_id, $promo_code_id, $fields, $exclude_fields);

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

    protected function getPromoCodeRequest($store_id, $promo_rule_id, $promo_code_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }
        // verify the required parameter 'promo_code_id' is set
        if ($promo_code_id === null || (is_array($promo_code_id) && count($promo_code_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_code_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes/{promo_code_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_code_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_code_id' . '}',
                ObjectSerializer::toPathValue($promo_code_id),
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

    public function listPromoRules($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->listPromoRulesWithHttpInfo($store_id, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function listPromoRulesWithHttpInfo($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->listPromoRulesRequest($store_id, $fields, $exclude_fields, $count, $offset);

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

    protected function listPromoRulesRequest($store_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        if ($count !== null && $count > 1000) {
            throw new \InvalidArgumentException('invalid value for "$count" when calling EcommerceApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules';
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

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function getPromoRule($store_id, $promo_rule_id, $fields = null, $exclude_fields = null)
    {
        $response = $this->getPromoRuleWithHttpInfo($store_id, $promo_rule_id, $fields, $exclude_fields);
        return $response;
    }

    public function getPromoRuleWithHttpInfo($store_id, $promo_rule_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getPromoRuleRequest($store_id, $promo_rule_id, $fields, $exclude_fields);

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

    protected function getPromoRuleRequest($store_id, $promo_rule_id, $fields = null, $exclude_fields = null)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}';
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
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
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

    public function updateStore($store_id, $body)
    {
        $response = $this->updateStoreWithHttpInfo($store_id, $body);
        return $response;
    }

    public function updateStoreWithHttpInfo($store_id, $body)
    {
        $request = $this->updateStoreRequest($store_id, $body);

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

    protected function updateStoreRequest($store_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function updateStoreCart($store_id, $cart_id, $body)
    {
        $response = $this->updateStoreCartWithHttpInfo($store_id, $cart_id, $body);
        return $response;
    }

    public function updateStoreCartWithHttpInfo($store_id, $cart_id, $body)
    {
        $request = $this->updateStoreCartRequest($store_id, $cart_id, $body);

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

    protected function updateStoreCartRequest($store_id, $cart_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
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

    public function updateCartLineItem($store_id, $cart_id, $line_id, $body)
    {
        $response = $this->updateCartLineItemWithHttpInfo($store_id, $cart_id, $line_id, $body);
        return $response;
    }

    public function updateCartLineItemWithHttpInfo($store_id, $cart_id, $line_id, $body)
    {
        $request = $this->updateCartLineItemRequest($store_id, $cart_id, $line_id, $body);

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

    protected function updateCartLineItemRequest($store_id, $cart_id, $line_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }
        // verify the required parameter 'line_id' is set
        if ($line_id === null || (is_array($line_id) && count($line_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $line_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}/lines/{line_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
                $resourcePath
            );
        }
        // path params
        if ($line_id !== null) {
            $resourcePath = str_replace(
                '{' . 'line_id' . '}',
                ObjectSerializer::toPathValue($line_id),
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

    public function updateStoreCustomer($store_id, $customer_id, $body)
    {
        $response = $this->updateStoreCustomerWithHttpInfo($store_id, $customer_id, $body);
        return $response;
    }

    public function updateStoreCustomerWithHttpInfo($store_id, $customer_id, $body)
    {
        $request = $this->updateStoreCustomerRequest($store_id, $customer_id, $body);

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

    protected function updateStoreCustomerRequest($store_id, $customer_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'customer_id' is set
        if ($customer_id === null || (is_array($customer_id) && count($customer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $customer_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/customers/{customer_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($customer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customer_id' . '}',
                ObjectSerializer::toPathValue($customer_id),
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

    public function updateOrder($store_id, $order_id, $body)
    {
        $response = $this->updateOrderWithHttpInfo($store_id, $order_id, $body);
        return $response;
    }

    public function updateOrderWithHttpInfo($store_id, $order_id, $body)
    {
        $request = $this->updateOrderRequest($store_id, $order_id, $body);

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

    protected function updateOrderRequest($store_id, $order_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
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

    public function updateOrderLineItem($store_id, $order_id, $line_id, $body)
    {
        $response = $this->updateOrderLineItemWithHttpInfo($store_id, $order_id, $line_id, $body);
        return $response;
    }

    public function updateOrderLineItemWithHttpInfo($store_id, $order_id, $line_id, $body)
    {
        $request = $this->updateOrderLineItemRequest($store_id, $order_id, $line_id, $body);

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

    protected function updateOrderLineItemRequest($store_id, $order_id, $line_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }
        // verify the required parameter 'line_id' is set
        if ($line_id === null || (is_array($line_id) && count($line_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $line_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}/lines/{line_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
                $resourcePath
            );
        }
        // path params
        if ($line_id !== null) {
            $resourcePath = str_replace(
                '{' . 'line_id' . '}',
                ObjectSerializer::toPathValue($line_id),
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

    public function updateStoreProduct($store_id, $product_id, $body)
    {
        $response = $this->updateStoreProductWithHttpInfo($store_id, $product_id, $body);
        return $response;
    }

    public function updateStoreProductWithHttpInfo($store_id, $product_id, $body)
    {
        $request = $this->updateStoreProductRequest($store_id, $product_id, $body);

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

    protected function updateStoreProductRequest($store_id, $product_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function updateProductImage($store_id, $product_id, $image_id, $body)
    {
        $response = $this->updateProductImageWithHttpInfo($store_id, $product_id, $image_id, $body);
        return $response;
    }

    public function updateProductImageWithHttpInfo($store_id, $product_id, $image_id, $body)
    {
        $request = $this->updateProductImageRequest($store_id, $product_id, $image_id, $body);

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

    protected function updateProductImageRequest($store_id, $product_id, $image_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'image_id' is set
        if ($image_id === null || (is_array($image_id) && count($image_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $image_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/images/{image_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($image_id !== null) {
            $resourcePath = str_replace(
                '{' . 'image_id' . '}',
                ObjectSerializer::toPathValue($image_id),
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

    public function updateProductVariant($store_id, $product_id, $variant_id, $body)
    {
        $response = $this->updateProductVariantWithHttpInfo($store_id, $product_id, $variant_id, $body);
        return $response;
    }

    public function updateProductVariantWithHttpInfo($store_id, $product_id, $variant_id, $body)
    {
        $request = $this->updateProductVariantRequest($store_id, $product_id, $variant_id, $body);

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

    protected function updateProductVariantRequest($store_id, $product_id, $variant_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'variant_id' is set
        if ($variant_id === null || (is_array($variant_id) && count($variant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $variant_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($variant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'variant_id' . '}',
                ObjectSerializer::toPathValue($variant_id),
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

    public function updatePromoCode($store_id, $promo_rule_id, $promo_code_id, $body)
    {
        $response = $this->updatePromoCodeWithHttpInfo($store_id, $promo_rule_id, $promo_code_id, $body);
        return $response;
    }

    public function updatePromoCodeWithHttpInfo($store_id, $promo_rule_id, $promo_code_id, $body)
    {
        $request = $this->updatePromoCodeRequest($store_id, $promo_rule_id, $promo_code_id, $body);

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

    protected function updatePromoCodeRequest($store_id, $promo_rule_id, $promo_code_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }
        // verify the required parameter 'promo_code_id' is set
        if ($promo_code_id === null || (is_array($promo_code_id) && count($promo_code_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_code_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes/{promo_code_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_code_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_code_id' . '}',
                ObjectSerializer::toPathValue($promo_code_id),
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

    public function updatePromoRule($store_id, $promo_rule_id, $body)
    {
        $response = $this->updatePromoRuleWithHttpInfo($store_id, $promo_rule_id, $body);
        return $response;
    }

    public function updatePromoRuleWithHttpInfo($store_id, $promo_rule_id, $body)
    {
        $request = $this->updatePromoRuleRequest($store_id, $promo_rule_id, $body);

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

    protected function updatePromoRuleRequest($store_id, $promo_rule_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
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

    public function addStore($body)
    {
        $response = $this->addStoreWithHttpInfo($body);
        return $response;
    }

    public function addStoreWithHttpInfo($body)
    {
        $request = $this->addStoreRequest($body);

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

    protected function addStoreRequest($body)
    {
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores';
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

    public function addStoreCart($store_id, $body)
    {
        $response = $this->addStoreCartWithHttpInfo($store_id, $body);
        return $response;
    }

    public function addStoreCartWithHttpInfo($store_id, $body)
    {
        $request = $this->addStoreCartRequest($store_id, $body);

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

    protected function addStoreCartRequest($store_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function addCartLineItem($store_id, $cart_id, $body)
    {
        $response = $this->addCartLineItemWithHttpInfo($store_id, $cart_id, $body);
        return $response;
    }

    public function addCartLineItemWithHttpInfo($store_id, $cart_id, $body)
    {
        $request = $this->addCartLineItemRequest($store_id, $cart_id, $body);

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

    protected function addCartLineItemRequest($store_id, $cart_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'cart_id' is set
        if ($cart_id === null || (is_array($cart_id) && count($cart_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $cart_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/carts/{cart_id}/lines';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($cart_id !== null) {
            $resourcePath = str_replace(
                '{' . 'cart_id' . '}',
                ObjectSerializer::toPathValue($cart_id),
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

    public function addStoreCustomer($store_id, $body)
    {
        $response = $this->addStoreCustomerWithHttpInfo($store_id, $body);
        return $response;
    }

    public function addStoreCustomerWithHttpInfo($store_id, $body)
    {
        $request = $this->addStoreCustomerRequest($store_id, $body);

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

    protected function addStoreCustomerRequest($store_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/customers';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function addStoreOrder($store_id, $body)
    {
        $response = $this->addStoreOrderWithHttpInfo($store_id, $body);
        return $response;
    }

    public function addStoreOrderWithHttpInfo($store_id, $body)
    {
        $request = $this->addStoreOrderRequest($store_id, $body);

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

    protected function addStoreOrderRequest($store_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function addOrderLineItem($store_id, $order_id, $body)
    {
        $response = $this->addOrderLineItemWithHttpInfo($store_id, $order_id, $body);
        return $response;
    }

    public function addOrderLineItemWithHttpInfo($store_id, $order_id, $body)
    {
        $request = $this->addOrderLineItemRequest($store_id, $order_id, $body);

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

    protected function addOrderLineItemRequest($store_id, $order_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'order_id' is set
        if ($order_id === null || (is_array($order_id) && count($order_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $order_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/orders/{order_id}/lines';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($order_id !== null) {
            $resourcePath = str_replace(
                '{' . 'order_id' . '}',
                ObjectSerializer::toPathValue($order_id),
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

    public function addStoreProduct($store_id, $body)
    {
        $response = $this->addStoreProductWithHttpInfo($store_id, $body);
        return $response;
    }

    public function addStoreProductWithHttpInfo($store_id, $body)
    {
        $request = $this->addStoreProductRequest($store_id, $body);

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

    protected function addStoreProductRequest($store_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function addProductImage($store_id, $product_id, $body)
    {
        $response = $this->addProductImageWithHttpInfo($store_id, $product_id, $body);
        return $response;
    }

    public function addProductImageWithHttpInfo($store_id, $product_id, $body)
    {
        $request = $this->addProductImageRequest($store_id, $product_id, $body);

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

    protected function addProductImageRequest($store_id, $product_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/images';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function addProductVariants($store_id, $product_id, $body)
    {
        $response = $this->addProductVariantsWithHttpInfo($store_id, $product_id, $body);
        return $response;
    }

    public function addProductVariantsWithHttpInfo($store_id, $product_id, $body)
    {
        $request = $this->addProductVariantsRequest($store_id, $product_id, $body);

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

    protected function addProductVariantsRequest($store_id, $product_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/variants';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
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

    public function addPromoCode($store_id, $promo_rule_id, $body)
    {
        $response = $this->addPromoCodeWithHttpInfo($store_id, $promo_rule_id, $body);
        return $response;
    }

    public function addPromoCodeWithHttpInfo($store_id, $promo_rule_id, $body)
    {
        $request = $this->addPromoCodeRequest($store_id, $promo_rule_id, $body);

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

    protected function addPromoCodeRequest($store_id, $promo_rule_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'promo_rule_id' is set
        if ($promo_rule_id === null || (is_array($promo_rule_id) && count($promo_rule_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $promo_rule_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules/{promo_rule_id}/promo-codes';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($promo_rule_id !== null) {
            $resourcePath = str_replace(
                '{' . 'promo_rule_id' . '}',
                ObjectSerializer::toPathValue($promo_rule_id),
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

    public function addPromoRules($store_id, $body)
    {
        $response = $this->addPromoRulesWithHttpInfo($store_id, $body);
        return $response;
    }

    public function addPromoRulesWithHttpInfo($store_id, $body)
    {
        $request = $this->addPromoRulesRequest($store_id, $body);

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

    protected function addPromoRulesRequest($store_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/promo-rules';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
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

    public function setStoreCustomer($store_id, $customer_id, $body)
    {
        $response = $this->setStoreCustomerWithHttpInfo($store_id, $customer_id, $body);
        return $response;
    }

    public function setStoreCustomerWithHttpInfo($store_id, $customer_id, $body)
    {
        $request = $this->setStoreCustomerRequest($store_id, $customer_id, $body);

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

    protected function setStoreCustomerRequest($store_id, $customer_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'customer_id' is set
        if ($customer_id === null || (is_array($customer_id) && count($customer_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $customer_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/customers/{customer_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($customer_id !== null) {
            $resourcePath = str_replace(
                '{' . 'customer_id' . '}',
                ObjectSerializer::toPathValue($customer_id),
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

    public function addProductVariant($store_id, $product_id, $variant_id, $body)
    {
        $response = $this->addProductVariantWithHttpInfo($store_id, $product_id, $variant_id, $body);
        return $response;
    }

    public function addProductVariantWithHttpInfo($store_id, $product_id, $variant_id, $body)
    {
        $request = $this->addProductVariantRequest($store_id, $product_id, $variant_id, $body);

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

    protected function addProductVariantRequest($store_id, $product_id, $variant_id, $body)
    {
        // verify the required parameter 'store_id' is set
        if ($store_id === null || (is_array($store_id) && count($store_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $store_id when calling '
            );
        }
        // verify the required parameter 'product_id' is set
        if ($product_id === null || (is_array($product_id) && count($product_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $product_id when calling '
            );
        }
        // verify the required parameter 'variant_id' is set
        if ($variant_id === null || (is_array($variant_id) && count($variant_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $variant_id when calling '
            );
        }
        // verify the required parameter 'body' is set
        if ($body === null || (is_array($body) && count($body) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $body when calling '
            );
        }

        $resourcePath = '/ecommerce/stores/{store_id}/products/{product_id}/variants/{variant_id}';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // path params
        if ($store_id !== null) {
            $resourcePath = str_replace(
                '{' . 'store_id' . '}',
                ObjectSerializer::toPathValue($store_id),
                $resourcePath
            );
        }
        // path params
        if ($product_id !== null) {
            $resourcePath = str_replace(
                '{' . 'product_id' . '}',
                ObjectSerializer::toPathValue($product_id),
                $resourcePath
            );
        }
        // path params
        if ($variant_id !== null) {
            $resourcePath = str_replace(
                '{' . 'variant_id' . '}',
                ObjectSerializer::toPathValue($variant_id),
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
