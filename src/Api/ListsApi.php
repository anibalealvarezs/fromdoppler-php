<?php

/**
 * ListsApi
 * PHP version 8.1
 *
 * @category Class
 * @package  FromDopplerPHP
 * @author   Aníbal Álvarez
 * @link     https://github.com/anibalealvarezs/fromdoppler-php
 */

/**
 * FromDoppler API
 *
 * OpenAPI spec version: 0.0.1
 * Contact: anibalealvarezs@gmail.com
 */

namespace FromDopplerPHP\Api;

use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use FromDopplerPHP\ApiTrait;

class ListsApi
{
    use ApiTrait;

    const END_POINT = '/lists';

    public function deleteList($list_id)
    {
        $this->deleteListWithHttpInfo($list_id);
    }

    public function deleteListWithHttpInfo($list_id)
    {
        $request = $this->deleteListRequest($list_id);

        return $this->performRequest($request);
    }

    protected function deleteListRequest($list_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteListSubscriber($list_id, $email)
    {
        $this->deleteListSubscriberWithHttpInfo($list_id, $email);
    }

    public function deleteListSubscriberWithHttpInfo($list_id, $email)
    {
        $request = $this->deleteListSubscriberRequest($list_id, $email);

        return $this->performRequest($request);
    }

    protected function deleteListSubscriberRequest($list_id, $email): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($email);

        $resourcePath = self::END_POINT . '/{list_id}/subscribers/{email}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'email', $email);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getAllLists($page = null, $per_page = '10', $state = null)
    {
        return $this->getAllListsWithHttpInfo($page, $per_page, $state);
    }

    public function getAllListsWithHttpInfo($page = null, $per_page = '10', $state = null)
    {
        $request = $this->getAllListsRequest($page, $per_page, $state);

        return $this->performRequest($request);
    }

    protected function getAllListsRequest($page = null, $per_page = '10', $state = null): Request
    {
        if ($per_page !== null && $per_page > 100) {
            throw new InvalidArgumentException('invalid value for "$per_page" when calling ListsApi., must be smaller than or equal to 100.');
        }


        $resourcePath = self::END_POINT;
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $page, 'page');
        $this->serializeParam($queryParams, $per_page, 'per_page');
        $this->serializeParam($queryParams, $state, 'state');

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getAllSubscribers($page = null, $per_page = '10', $keyword = null, $updatedAfter = null, $resumeFrom = null)
    {
        return $this->getAllSubscribersWithHttpInfo($page, $per_page, $keyword, $updatedAfter, $resumeFrom);
    }

    public function getAllSubscribersWithHttpInfo($page = null, $per_page = '10', $keyword = null, $updatedAfter = null, $resumeFrom = null)
    {
        $request = $this->getAllSubscribersRequest($page, $per_page, $keyword, $updatedAfter, $resumeFrom);

        return $this->performRequest($request);
    }

    protected function getAllSubscribersRequest($page = null, $per_page = '10', $keyword = null, $updatedAfter = null, $resumeFrom = null): Request
    {
        if ($per_page !== null && $per_page > 100) {
            throw new InvalidArgumentException('invalid value for "$per_page" when calling ListsApi., must be smaller than or equal to 100.');
        }


        $resourcePath = '/subscribers';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->serializeParam($queryParams, $page, 'page');
        $this->serializeParam($queryParams, $per_page, 'per_page');
        $this->serializeParam($queryParams, $keyword, 'keyword');
        $this->serializeParam($queryParams, $updatedAfter, 'updatedAfter');
        $this->serializeParam($queryParams, $resumeFrom, 'resumeFrom');

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function addSubscriber($body)
    {
        return $this->addSubscriberWithHttpInfo($body);
    }

    public function addSubscriberWithHttpInfo($body)
    {
        $request = $this->addSubscriberRequest($body);

        return $this->performRequest($request);
    }

    protected function addSubscriberRequest($body): Request
    {
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = '/subscribers';
        $queryParams = [];
        $headerParams = [];

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getSubscriber($email)
    {
        return $this->getSubscriberWithHttpInfo($email);
    }

    public function getSubscriberWithHttpInfo($email)
    {
        $request = $this->getSubscriberRequest($email);

        return $this->performRequest($request);
    }

    protected function getSubscriberRequest($email): Request
    {
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($email);

        $resourcePath = '/subscribers/{email}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'email', $email);

        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getList($list_id)
    {
        return $this->getListWithHttpInfo($list_id);
    }

    public function getListWithHttpInfo($list_id)
    {
        $request = $this->getListRequest($list_id);

        return $this->performRequest($request);
    }

    protected function getListRequest($list_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListSubscribersInfo($list_id, $page = null, $per_page = null)
    {
        return $this->getListSubscribersInfoWithHttpInfo($list_id, $page, $per_page);
    }

    public function getListSubscribersInfoWithHttpInfo($list_id, $page = null, $per_page = null)
    {
        $request = $this->getListSubscribersInfoRequest($list_id, $page, $per_page);

        return $this->performRequest($request);
    }

    protected function getListSubscribersInfoRequest($list_id, $page = null, $per_page = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($per_page !== null && $per_page > 100) {
            throw new InvalidArgumentException('invalid value for "$per_page" when calling ListsApi., must be smaller than or equal to 100.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/subscribers';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $page, 'page');
        $this->serializeParam($queryParams, $per_page, 'per_page');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getUnsubscribersInfo($page = null, $per_page = null, $from = null, $to = null)
    {
        return $this->getUnsubscribersInfoWithHttpInfo($page, $per_page, $from, $to);
    }

    public function getUnsubscribersInfoWithHttpInfo($page = null, $per_page = null, $from = null, $to = null)
    {
        $request = $this->getUnsubscribersInfoRequest($page, $per_page, $from, $to);

        return $this->performRequest($request);
    }

    protected function getUnsubscribersInfoRequest($page = null, $per_page = null, $from = null, $to = null): Request
    {
        if ($per_page !== null && $per_page > 100) {
            throw new InvalidArgumentException('invalid value for "$per_page" when calling ListsApi., must be smaller than or equal to 100.');
        }


        $resourcePath = '/unsubscribed';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->serializeParam($queryParams, $page, 'page');
        $this->serializeParam($queryParams, $per_page, 'per_page');
        $this->serializeParam($queryParams, $from, 'from');
        $this->serializeParam($queryParams, $to, 'to');

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function unsubscribeSubscriber($body)
    {
        return $this->unsubscribeSubscriberWithHttpInfo($body);
    }

    public function unsubscribeSubscriberWithHttpInfo($body)
    {
        $request = $this->unsubscribeSubscriberRequest($body);

        return $this->performRequest($request);
    }

    protected function unsubscribeSubscriberRequest($body): Request
    {
        $this->checkRequiredParameter($body);

        $resourcePath = '/unsubscribed';
        $queryParams = [];
        $headerParams = [];

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListSubscriber($list_id, $email)
    {
        return $this->getListSubscriberWithHttpInfo($list_id, $email);
    }

    public function getListSubscriberWithHttpInfo($list_id, $email)
    {
        $request = $this->getListSubscriberRequest($list_id, $email);

        return $this->performRequest($request);
    }

    protected function getListSubscriberRequest($list_id, $email): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($email);

        $resourcePath = self::END_POINT . '/{list_id}/subscribers/{email}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'email', $email);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateList($list_id, $body)
    {
        return $this->updateListWithHttpInfo($list_id, $body);
    }

    public function updateListWithHttpInfo($list_id, $body)
    {
        $request = $this->updateListRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function updateListRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}';
        $queryParams = [];
        $headerParams = [];

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createList($body)
    {
        return $this->createListWithHttpInfo($body);
    }

    public function createListWithHttpInfo($body)
    {
        $request = $this->createListRequest($body);

        return $this->performRequest($request);
    }

    protected function createListRequest($body): Request
    {
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT;
        $queryParams = [];
        $headerParams = [];

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function addListSubscriber($list_id, $body)
    {
        return $this->addListSubscriberWithHttpInfo($list_id, $body);
    }

    public function addListSubscriberWithHttpInfo($list_id, $body)
    {
        $request = $this->addListSubscriberRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function addListSubscriberRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/subscribers';
        $queryParams = [];
        $headerParams = [];

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }
}
