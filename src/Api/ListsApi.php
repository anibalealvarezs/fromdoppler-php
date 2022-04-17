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

    public function deleteInterestCategory($list_id, $interest_category_id)
    {
        $this->deleteInterestCategoryWithHttpInfo($list_id, $interest_category_id);
    }

    public function deleteInterestCategoryWithHttpInfo($list_id, $interest_category_id)
    {
        $request = $this->deleteInterestCategoryRequest($list_id, $interest_category_id);

        return $this->performRequest($request);
    }

    protected function deleteInterestCategoryRequest($list_id, $interest_category_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteInterestCategoryInterest($list_id, $interest_category_id, $interest_id)
    {
        $this->deleteInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $interest_id);
    }

    public function deleteInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $interest_id)
    {
        $request = $this->deleteInterestCategoryInterestRequest($list_id, $interest_category_id, $interest_id);

        return $this->performRequest($request);
    }

    protected function deleteInterestCategoryInterestRequest($list_id, $interest_category_id, $interest_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);
        // verify the required parameter 'interest_id' is set
        $this->checkRequiredParameter($interest_id);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}/interests/{interest_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);
        $this->pathParam($resourcePath, 'interest_id', $interest_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteListMember($list_id, $subscriber_hash)
    {
        $this->deleteListMemberWithHttpInfo($list_id, $subscriber_hash);
    }

    public function deleteListMemberWithHttpInfo($list_id, $subscriber_hash)
    {
        $request = $this->deleteListMemberRequest($list_id, $subscriber_hash);

        return $this->performRequest($request);
    }

    protected function deleteListMemberRequest($list_id, $subscriber_hash): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteListMemberNote($list_id, $subscriber_hash, $note_id)
    {
        $this->deleteListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $note_id);
    }

    public function deleteListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $note_id)
    {
        $request = $this->deleteListMemberNoteRequest($list_id, $subscriber_hash, $note_id);

        return $this->performRequest($request);
    }

    protected function deleteListMemberNoteRequest($list_id, $subscriber_hash, $note_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'note_id' is set
        $this->checkRequiredParameter($note_id);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/notes/{note_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);
        $this->pathParam($resourcePath, 'note_id', $note_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteListMergeField($list_id, $merge_id)
    {
        $this->deleteListMergeFieldWithHttpInfo($list_id, $merge_id);
    }

    public function deleteListMergeFieldWithHttpInfo($list_id, $merge_id)
    {
        $request = $this->deleteListMergeFieldRequest($list_id, $merge_id);

        return $this->performRequest($request);
    }

    protected function deleteListMergeFieldRequest($list_id, $merge_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'merge_id' is set
        $this->checkRequiredParameter($merge_id);

        $resourcePath = self::END_POINT . '/{list_id}/merge-fields/{merge_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'merge_id', $merge_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteSegment($list_id, $segment_id)
    {
        $this->deleteSegmentWithHttpInfo($list_id, $segment_id);
    }

    public function deleteSegmentWithHttpInfo($list_id, $segment_id)
    {
        $request = $this->deleteSegmentRequest($list_id, $segment_id);

        return $this->performRequest($request);
    }

    protected function deleteSegmentRequest($list_id, $segment_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);

        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function removeSegmentMember($list_id, $segment_id, $subscriber_hash)
    {
        $this->removeSegmentMemberWithHttpInfo($list_id, $segment_id, $subscriber_hash);
    }

    public function removeSegmentMemberWithHttpInfo($list_id, $segment_id, $subscriber_hash)
    {
        $request = $this->removeSegmentMemberRequest($list_id, $segment_id, $subscriber_hash);

        return $this->performRequest($request);
    }

    protected function removeSegmentMemberRequest($list_id, $segment_id, $subscriber_hash): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);

        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}/members/{subscriber_hash}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteListWebhook($list_id, $webhook_id)
    {
        $this->deleteListWebhookWithHttpInfo($list_id, $webhook_id);
    }

    public function deleteListWebhookWithHttpInfo($list_id, $webhook_id)
    {
        $request = $this->deleteListWebhookRequest($list_id, $webhook_id);

        return $this->performRequest($request);
    }

    protected function deleteListWebhookRequest($list_id, $webhook_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'webhook_id' is set
        $this->checkRequiredParameter($webhook_id);

        $resourcePath = self::END_POINT . '/{list_id}/webhooks/{webhook_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'webhook_id', $webhook_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestDelete($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberTags($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $response = $this->getListMemberTagsWithHttpInfo($list_id, $subscriber_hash, $fields, $exclude_fields, $count, $offset);
        return $response;
    }

    public function getListMemberTagsWithHttpInfo($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getListMemberTagsRequest($list_id, $subscriber_hash, $fields, $exclude_fields, $count, $offset);

        return $this->performRequest($request);
    }

    protected function getListMemberTagsRequest($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $count = '10', $offset = '0'): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/tags';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getAllLists($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $before_date_created = null, $since_date_created = null, $before_campaign_last_sent = null, $since_campaign_last_sent = null, $email = null, $sort_field = null, $sort_dir = null, $has_ecommerce_store = null, $include_total_contacts = null)
    {
        return $this->getAllListsWithHttpInfo($fields, $exclude_fields, $count, $offset, $before_date_created, $since_date_created, $before_campaign_last_sent, $since_campaign_last_sent, $email, $sort_field, $sort_dir, $has_ecommerce_store, $include_total_contacts);
    }

    public function getAllListsWithHttpInfo($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $before_date_created = null, $since_date_created = null, $before_campaign_last_sent = null, $since_campaign_last_sent = null, $email = null, $sort_field = null, $sort_dir = null, $has_ecommerce_store = null, $include_total_contacts = null)
    {
        $request = $this->getAllListsRequest($fields, $exclude_fields, $count, $offset, $before_date_created, $since_date_created, $before_campaign_last_sent, $since_campaign_last_sent, $email, $sort_field, $sort_dir, $has_ecommerce_store, $include_total_contacts);

        return $this->performRequest($request);
    }

    protected function getAllListsRequest($fields = null, $exclude_fields = null, $count = '10', $offset = '0', $before_date_created = null, $since_date_created = null, $before_campaign_last_sent = null, $since_campaign_last_sent = null, $email = null, $sort_field = null, $sort_dir = null, $has_ecommerce_store = null, $include_total_contacts = null): Request
    {
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT;
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $before_date_created, 'before_date_created');
        $this->serializeParam($queryParams, $since_date_created, 'since_date_created');
        $this->serializeParam($queryParams, $before_campaign_last_sent, 'before_campaign_last_sent');
        $this->serializeParam($queryParams, $since_campaign_last_sent, 'since_campaign_last_sent');
        $this->serializeParam($queryParams, $email, 'email');
        $this->serializeParam($queryParams, $sort_field, 'sort_field');
        $this->serializeParam($queryParams, $sort_dir, 'sort_dir');
        $this->serializeParam($queryParams, $has_ecommerce_store, 'has_ecommerce_store');
        $this->serializeParam($queryParams, $include_total_contacts, 'include_total_contacts');

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getList($list_id, $fields = null, $exclude_fields = null, $include_total_contacts = null)
    {
        $response = $this->getListWithHttpInfo($list_id, $fields, $exclude_fields, $include_total_contacts);
        return $response;
    }

    public function getListWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $include_total_contacts = null)
    {
        $request = $this->getListRequest($list_id, $fields, $exclude_fields, $include_total_contacts);

        return $this->performRequest($request);
    }

    protected function getListRequest($list_id, $fields = null, $exclude_fields = null, $include_total_contacts = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $include_total_contacts, 'include_total_contacts');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListAbuseReports($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        return $this->getListAbuseReportsWithHttpInfo($list_id, $fields, $exclude_fields, $count, $offset);
    }

    public function getListAbuseReportsWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getListAbuseReportsRequest($list_id, $fields, $exclude_fields, $count, $offset);

        return $this->performRequest($request);
    }

    protected function getListAbuseReportsRequest($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0'): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/abuse-reports';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListAbuseReportDetails($list_id, $report_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        return $this->getListAbuseReportDetailsWithHttpInfo($list_id, $report_id, $fields, $exclude_fields, $count, $offset);
    }

    public function getListAbuseReportDetailsWithHttpInfo($list_id, $report_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getListAbuseReportDetailsRequest($list_id, $report_id, $fields, $exclude_fields, $count, $offset);

        return $this->performRequest($request);
    }

    protected function getListAbuseReportDetailsRequest($list_id, $report_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0'): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'report_id' is set
        $this->checkRequiredParameter($report_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/abuse-reports/{report_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'report_id', $report_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListRecentActivity($list_id, $count = '10', $offset = '0', $fields = null, $exclude_fields = null)
    {
        return $this->getListRecentActivityWithHttpInfo($list_id, $count, $offset, $fields, $exclude_fields);
    }

    public function getListRecentActivityWithHttpInfo($list_id, $count = '10', $offset = '0', $fields = null, $exclude_fields = null)
    {
        $request = $this->getListRecentActivityRequest($list_id, $count, $offset, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListRecentActivityRequest($list_id, $count = '10', $offset = '0', $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/activity';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListClients($list_id, $fields = null, $exclude_fields = null)
    {
        return $this->getListClientsWithHttpInfo($list_id, $fields, $exclude_fields);
    }

    public function getListClientsWithHttpInfo($list_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getListClientsRequest($list_id, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListClientsRequest($list_id, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}/clients';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListGrowthHistory($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $sort_field = null, $sort_dir = null)
    {
        return $this->getListGrowthHistoryWithHttpInfo($list_id, $fields, $exclude_fields, $count, $offset, $sort_field, $sort_dir);
    }

    public function getListGrowthHistoryWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $sort_field = null, $sort_dir = null)
    {
        $request = $this->getListGrowthHistoryRequest($list_id, $fields, $exclude_fields, $count, $offset, $sort_field, $sort_dir);

        return $this->performRequest($request);
    }

    protected function getListGrowthHistoryRequest($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $sort_field = null, $sort_dir = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/growth-history';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $sort_field, 'sort_field');
        $this->serializeParam($queryParams, $sort_dir, 'sort_dir');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListGrowthHistoryByMonth($list_id, $month, $fields = null, $exclude_fields = null)
    {
        return $this->getListGrowthHistoryByMonthWithHttpInfo($list_id, $month, $fields, $exclude_fields);
    }

    public function getListGrowthHistoryByMonthWithHttpInfo($list_id, $month, $fields = null, $exclude_fields = null)
    {
        $request = $this->getListGrowthHistoryByMonthRequest($list_id, $month, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListGrowthHistoryByMonthRequest($list_id, $month, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'month' is set
        $this->checkRequiredParameter($month);

        $resourcePath = self::END_POINT . '/{list_id}/growth-history/{month}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'month', $month);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListInterestCategories($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null)
    {
        return $this->getListInterestCategoriesWithHttpInfo($list_id, $fields, $exclude_fields, $count, $offset, $type);
    }

    public function getListInterestCategoriesWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null)
    {
        $request = $this->getListInterestCategoriesRequest($list_id, $fields, $exclude_fields, $count, $offset, $type);

        return $this->performRequest($request);
    }

    protected function getListInterestCategoriesRequest($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/interest-categories';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $type, 'type');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getInterestCategory($list_id, $interest_category_id, $fields = null, $exclude_fields = null)
    {
        return $this->getInterestCategoryWithHttpInfo($list_id, $interest_category_id, $fields, $exclude_fields);
    }

    public function getInterestCategoryWithHttpInfo($list_id, $interest_category_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getInterestCategoryRequest($list_id, $interest_category_id, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getInterestCategoryRequest($list_id, $interest_category_id, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function listInterestCategoryInterests($list_id, $interest_category_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        return $this->listInterestCategoryInterestsWithHttpInfo($list_id, $interest_category_id, $fields, $exclude_fields, $count, $offset);
    }

    public function listInterestCategoryInterestsWithHttpInfo($list_id, $interest_category_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->listInterestCategoryInterestsRequest($list_id, $interest_category_id, $fields, $exclude_fields, $count, $offset);

        return $this->performRequest($request);
    }

    protected function listInterestCategoryInterestsRequest($list_id, $interest_category_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0'): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}/interests';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getInterestCategoryInterest($list_id, $interest_category_id, $interest_id, $fields = null, $exclude_fields = null)
    {
        return $this->getInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $interest_id, $fields, $exclude_fields);
    }

    public function getInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $interest_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getInterestCategoryInterestRequest($list_id, $interest_category_id, $interest_id, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getInterestCategoryInterestRequest($list_id, $interest_category_id, $interest_id, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);
        // verify the required parameter 'interest_id' is set
        $this->checkRequiredParameter($interest_id);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}/interests/{interest_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);
        $this->pathParam($resourcePath, 'interest_id', $interest_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListLocations($list_id, $fields = null, $exclude_fields = null)
    {
        return $this->getListLocationsWithHttpInfo($list_id, $fields, $exclude_fields);
    }

    public function getListLocationsWithHttpInfo($list_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getListLocationsRequest($list_id, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListLocationsRequest($list_id, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}/locations';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMembersInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $email_type = null, $status = null, $since_timestamp_opt = null, $before_timestamp_opt = null, $since_last_changed = null, $before_last_changed = null, $unique_email_id = null, $vip_only = null, $interest_category_id = null, $interest_ids = null, $interest_match = null, $sort_field = null, $sort_dir = null, $since_last_campaign = null, $unsubscribed_since = null)
    {
        return $this->getListMembersInfoWithHttpInfo($list_id, $fields, $exclude_fields, $count, $offset, $email_type, $status, $since_timestamp_opt, $before_timestamp_opt, $since_last_changed, $before_last_changed, $unique_email_id, $vip_only, $interest_category_id, $interest_ids, $interest_match, $sort_field, $sort_dir, $since_last_campaign, $unsubscribed_since);
    }

    public function getListMembersInfoWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $email_type = null, $status = null, $since_timestamp_opt = null, $before_timestamp_opt = null, $since_last_changed = null, $before_last_changed = null, $unique_email_id = null, $vip_only = null, $interest_category_id = null, $interest_ids = null, $interest_match = null, $sort_field = null, $sort_dir = null, $since_last_campaign = null, $unsubscribed_since = null)
    {
        $request = $this->getListMembersInfoRequest($list_id, $fields, $exclude_fields, $count, $offset, $email_type, $status, $since_timestamp_opt, $before_timestamp_opt, $since_last_changed, $before_last_changed, $unique_email_id, $vip_only, $interest_category_id, $interest_ids, $interest_match, $sort_field, $sort_dir, $since_last_campaign, $unsubscribed_since);

        return $this->performRequest($request);
    }

    protected function getListMembersInfoRequest($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $email_type = null, $status = null, $since_timestamp_opt = null, $before_timestamp_opt = null, $since_last_changed = null, $before_last_changed = null, $unique_email_id = null, $vip_only = null, $interest_category_id = null, $interest_ids = null, $interest_match = null, $sort_field = null, $sort_dir = null, $since_last_campaign = null, $unsubscribed_since = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/members';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $email_type, 'email_type');
        $this->serializeParam($queryParams, $status, 'status');
        $this->serializeParam($queryParams, $since_timestamp_opt, 'since_timestamp_opt');
        $this->serializeParam($queryParams, $before_timestamp_opt, 'before_timestamp_opt');
        $this->serializeParam($queryParams, $since_last_changed, 'since_last_changed');
        $this->serializeParam($queryParams, $before_last_changed, 'before_last_changed');
        $this->serializeParam($queryParams, $unique_email_id, 'unique_email_id');
        $this->serializeParam($queryParams, $vip_only, 'vip_only');
        $this->serializeParam($queryParams, $interest_category_id, 'interest_category_id');
        $this->serializeParam($queryParams, $interest_ids, 'interest_ids');
        $this->serializeParam($queryParams, $interest_match, 'interest_match');
        $this->serializeParam($queryParams, $sort_field, 'sort_field');
        $this->serializeParam($queryParams, $sort_dir, 'sort_dir');
        $this->serializeParam($queryParams, $since_last_campaign, 'since_last_campaign');
        $this->serializeParam($queryParams, $unsubscribed_since, 'unsubscribed_since');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMember($list_id, $subscriber_hash, $fields = null, $exclude_fields = null)
    {
        return $this->getListMemberWithHttpInfo($list_id, $subscriber_hash, $fields, $exclude_fields);
    }

    public function getListMemberWithHttpInfo($list_id, $subscriber_hash, $fields = null, $exclude_fields = null)
    {
        $request = $this->getListMemberRequest($list_id, $subscriber_hash, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListMemberRequest($list_id, $subscriber_hash, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberActivity($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $action = null)
    {
        return $this->getListMemberActivityWithHttpInfo($list_id, $subscriber_hash, $fields, $exclude_fields, $action);
    }

    public function getListMemberActivityWithHttpInfo($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $action = null)
    {
        $request = $this->getListMemberActivityRequest($list_id, $subscriber_hash, $fields, $exclude_fields, $action);

        return $this->performRequest($request);
    }

    protected function getListMemberActivityRequest($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $action = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/activity';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $action, 'action');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberActivityFeed($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $activity_filters = null)
    {
        return $this->getListMemberActivityFeedWithHttpInfo($list_id, $subscriber_hash, $fields, $exclude_fields, $count, $offset, $activity_filters);
    }

    public function getListMemberActivityFeedWithHttpInfo($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $activity_filters = null)
    {
        $request = $this->getListMemberActivityFeedRequest($list_id, $subscriber_hash, $fields, $exclude_fields, $count, $offset, $activity_filters);

        return $this->performRequest($request);
    }

    protected function getListMemberActivityFeedRequest($list_id, $subscriber_hash, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $activity_filters = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/activity-feed';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $activity_filters, 'activity_filters');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberEvents($list_id, $subscriber_hash, $count = '10', $offset = '0', $fields = null, $exclude_fields = null)
    {
        return $this->getListMemberEventsWithHttpInfo($list_id, $subscriber_hash, $count, $offset, $fields, $exclude_fields);
    }

    public function getListMemberEventsWithHttpInfo($list_id, $subscriber_hash, $count = '10', $offset = '0', $fields = null, $exclude_fields = null)
    {
        $request = $this->getListMemberEventsRequest($list_id, $subscriber_hash, $count, $offset, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListMemberEventsRequest($list_id, $subscriber_hash, $count = '10', $offset = '0', $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/events';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberGoals($list_id, $subscriber_hash, $fields = null, $exclude_fields = null)
    {
        return $this->getListMemberGoalsWithHttpInfo($list_id, $subscriber_hash, $fields, $exclude_fields);
    }

    public function getListMemberGoalsWithHttpInfo($list_id, $subscriber_hash, $fields = null, $exclude_fields = null)
    {
        $request = $this->getListMemberGoalsRequest($list_id, $subscriber_hash, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListMemberGoalsRequest($list_id, $subscriber_hash, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/goals';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberNotes($list_id, $subscriber_hash, $sort_field = null, $sort_dir = null, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        return $this->getListMemberNotesWithHttpInfo($list_id, $subscriber_hash, $sort_field, $sort_dir, $fields, $exclude_fields, $count, $offset);
    }

    public function getListMemberNotesWithHttpInfo($list_id, $subscriber_hash, $sort_field = null, $sort_dir = null, $fields = null, $exclude_fields = null, $count = '10', $offset = '0')
    {
        $request = $this->getListMemberNotesRequest($list_id, $subscriber_hash, $sort_field, $sort_dir, $fields, $exclude_fields, $count, $offset);

        return $this->performRequest($request);
    }

    protected function getListMemberNotesRequest($list_id, $subscriber_hash, $sort_field = null, $sort_dir = null, $fields = null, $exclude_fields = null, $count = '10', $offset = '0'): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/notes';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $sort_field, 'sort_field');
        $this->serializeParam($queryParams, $sort_dir, 'sort_dir');
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMemberNote($list_id, $subscriber_hash, $note_id, $fields = null, $exclude_fields = null)
    {
        return $this->getListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $note_id, $fields, $exclude_fields);
    }

    public function getListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $note_id, $fields = null, $exclude_fields = null)
    {
        $request = $this->getListMemberNoteRequest($list_id, $subscriber_hash, $note_id, $fields, $exclude_fields);

        return $this->performRequest($request);
    }

    protected function getListMemberNoteRequest($list_id, $subscriber_hash, $note_id, $fields = null, $exclude_fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'note_id' is set
        $this->checkRequiredParameter($note_id);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/notes/{note_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);
        $this->pathParam($resourcePath, 'note_id', $note_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMergeFields($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $required = null)
    {
        return $this->getListMergeFieldsWithHttpInfo($list_id, $fields, $exclude_fields, $count, $offset, $type, $required);
    }

    public function getListMergeFieldsWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $required = null)
    {
        $request = $this->getListMergeFieldsRequest($list_id, $fields, $exclude_fields, $count, $offset, $type, $required);

        return $this->performRequest($request);
    }

    protected function getListMergeFieldsRequest($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $required = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/merge-fields';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $type, 'type');
        $this->serializeParam($queryParams, $required, 'required');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListMergeField($list_id, $merge_id, $exclude_fields = null, $fields = null)
    {
        return $this->getListMergeFieldWithHttpInfo($list_id, $merge_id, $exclude_fields, $fields);
    }

    public function getListMergeFieldWithHttpInfo($list_id, $merge_id, $exclude_fields = null, $fields = null)
    {
        $request = $this->getListMergeFieldRequest($list_id, $merge_id, $exclude_fields, $fields);

        return $this->performRequest($request);
    }

    protected function getListMergeFieldRequest($list_id, $merge_id, $exclude_fields = null, $fields = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'merge_id' is set
        $this->checkRequiredParameter($merge_id);

        $resourcePath = self::END_POINT . '/{list_id}/merge-fields/{merge_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $fields, 'fields');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'merge_id', $merge_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getSegment($list_id, $segment_id, $fields = null, $exclude_fields = null, $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null)
    {
        return $this->getSegmentWithHttpInfo($list_id, $segment_id, $fields, $exclude_fields, $include_cleaned, $include_transactional, $include_unsubscribed);
    }

    public function getSegmentWithHttpInfo($list_id, $segment_id, $fields = null, $exclude_fields = null, $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null)
    {
        $request = $this->getSegmentRequest($list_id, $segment_id, $fields, $exclude_fields, $include_cleaned, $include_transactional, $include_unsubscribed);

        return $this->performRequest($request);
    }

    protected function getSegmentRequest($list_id, $segment_id, $fields = null, $exclude_fields = null, $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);

        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $include_cleaned, 'include_cleaned');
        $this->serializeParam($queryParams, $include_transactional, 'include_transactional');
        $this->serializeParam($queryParams, $include_unsubscribed, 'include_unsubscribed');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getSegmentMembersList($list_id, $segment_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null)
    {
        return $this->getSegmentMembersListWithHttpInfo($list_id, $segment_id, $fields, $exclude_fields, $count, $offset, $include_cleaned, $include_transactional, $include_unsubscribed);
    }

    public function getSegmentMembersListWithHttpInfo($list_id, $segment_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null)
    {
        $request = $this->getSegmentMembersListRequest($list_id, $segment_id, $fields, $exclude_fields, $count, $offset, $include_cleaned, $include_transactional, $include_unsubscribed);

        return $this->performRequest($request);
    }

    protected function getSegmentMembersListRequest($list_id, $segment_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}/members';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $include_cleaned, 'include_cleaned');
        $this->serializeParam($queryParams, $include_transactional, 'include_transactional');
        $this->serializeParam($queryParams, $include_unsubscribed, 'include_unsubscribed');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListSignupForms($list_id)
    {
        return $this->getListSignupFormsWithHttpInfo($list_id);
    }

    public function getListSignupFormsWithHttpInfo($list_id)
    {
        $request = $this->getListSignupFormsRequest($list_id);

        return $this->performRequest($request);
    }

    protected function getListSignupFormsRequest($list_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}/signup-forms';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListWebhooks($list_id)
    {
        return $this->getListWebhooksWithHttpInfo($list_id);
    }

    public function getListWebhooksWithHttpInfo($list_id)
    {
        $request = $this->getListWebhooksRequest($list_id);

        return $this->performRequest($request);
    }

    protected function getListWebhooksRequest($list_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}/webhooks';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function getListWebhook($list_id, $webhook_id)
    {
        return $this->getListWebhookWithHttpInfo($list_id, $webhook_id);
    }

    public function getListWebhookWithHttpInfo($list_id, $webhook_id)
    {
        $request = $this->getListWebhookRequest($list_id, $webhook_id);

        return $this->performRequest($request);
    }

    protected function getListWebhookRequest($list_id, $webhook_id): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'webhook_id' is set
        $this->checkRequiredParameter($webhook_id);

        $resourcePath = self::END_POINT . '/{list_id}/webhooks/{webhook_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'webhook_id', $webhook_id);

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
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateInterestCategory($list_id, $interest_category_id, $body)
    {
        return $this->updateInterestCategoryWithHttpInfo($list_id, $interest_category_id, $body);
    }

    public function updateInterestCategoryWithHttpInfo($list_id, $interest_category_id, $body)
    {
        $request = $this->updateInterestCategoryRequest($list_id, $interest_category_id, $body);

        return $this->performRequest($request);
    }

    protected function updateInterestCategoryRequest($list_id, $interest_category_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateInterestCategoryInterest($list_id, $interest_category_id, $interest_id, $body)
    {
        return $this->updateInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $interest_id, $body);
    }

    public function updateInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $interest_id, $body)
    {
        $request = $this->updateInterestCategoryInterestRequest($list_id, $interest_category_id, $interest_id, $body);

        return $this->performRequest($request);
    }

    protected function updateInterestCategoryInterestRequest($list_id, $interest_category_id, $interest_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);
        // verify the required parameter 'interest_id' is set
        $this->checkRequiredParameter($interest_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}/interests/{interest_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);
        $this->pathParam($resourcePath, 'interest_id', $interest_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateListMember($list_id, $subscriber_hash, $body, $skip_merge_validation = null)
    {
        return $this->updateListMemberWithHttpInfo($list_id, $subscriber_hash, $body, $skip_merge_validation);
    }

    public function updateListMemberWithHttpInfo($list_id, $subscriber_hash, $body, $skip_merge_validation = null)
    {
        $request = $this->updateListMemberRequest($list_id, $subscriber_hash, $body, $skip_merge_validation);

        return $this->performRequest($request);
    }

    protected function updateListMemberRequest($list_id, $subscriber_hash, $body, $skip_merge_validation = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}';
        $queryParams = [];
        $headerParams = [];
        
        $this->serializeParam($queryParams, $skip_merge_validation, 'skip_merge_validation');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateListMemberNote($list_id, $subscriber_hash, $note_id, $body)
    {
        return $this->updateListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $note_id, $body);
    }

    public function updateListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $note_id, $body)
    {
        $request = $this->updateListMemberNoteRequest($list_id, $subscriber_hash, $note_id, $body);

        return $this->performRequest($request);
    }

    protected function updateListMemberNoteRequest($list_id, $subscriber_hash, $note_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'note_id' is set
        $this->checkRequiredParameter($note_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/notes/{note_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);
        $this->pathParam($resourcePath, 'note_id', $note_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateListMergeField($list_id, $merge_id, $body)
    {
        return $this->updateListMergeFieldWithHttpInfo($list_id, $merge_id, $body);
    }

    public function updateListMergeFieldWithHttpInfo($list_id, $merge_id, $body)
    {
        $request = $this->updateListMergeFieldRequest($list_id, $merge_id, $body);

        return $this->performRequest($request);
    }

    protected function updateListMergeFieldRequest($list_id, $merge_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'merge_id' is set
        $this->checkRequiredParameter($merge_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/merge-fields/{merge_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'merge_id', $merge_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateSegment($list_id, $segment_id, $body)
    {
        return $this->updateSegmentWithHttpInfo($list_id, $segment_id, $body);
    }

    public function updateSegmentWithHttpInfo($list_id, $segment_id, $body)
    {
        $request = $this->updateSegmentRequest($list_id, $segment_id, $body);

        return $this->performRequest($request);
    }

    protected function updateSegmentRequest($list_id, $segment_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateListWebhook($list_id, $webhook_id, $body)
    {
        return $this->updateListWebhookWithHttpInfo($list_id, $webhook_id, $body);
    }

    public function updateListWebhookWithHttpInfo($list_id, $webhook_id, $body)
    {
        $request = $this->updateListWebhookRequest($list_id, $webhook_id, $body);

        return $this->performRequest($request);
    }

    protected function updateListWebhookRequest($list_id, $webhook_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'webhook_id' is set
        $this->checkRequiredParameter($webhook_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/webhooks/{webhook_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'webhook_id', $webhook_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPatch($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createListMemberEvent($list_id, $subscriber_hash, $body)
    {
        $this->createListMemberEventWithHttpInfo($list_id, $subscriber_hash, $body);
    }

    public function createListMemberEventWithHttpInfo($list_id, $subscriber_hash, $body)
    {
        $request = $this->createListMemberEventRequest($list_id, $subscriber_hash, $body);

        return $this->performRequest($request);
    }

    protected function createListMemberEventRequest($list_id, $subscriber_hash, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/events';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateListMemberTags($list_id, $subscriber_hash, $body)
    {
        $this->updateListMemberTagsWithHttpInfo($list_id, $subscriber_hash, $body);
    }

    public function updateListMemberTagsWithHttpInfo($list_id, $subscriber_hash, $body)
    {
        $request = $this->updateListMemberTagsRequest($list_id, $subscriber_hash, $body);

        return $this->performRequest($request);
    }

    protected function updateListMemberTagsRequest($list_id, $subscriber_hash, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/tags';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createList($body)
    {
        $response = $this->createListWithHttpInfo($body);
        return $response;
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
        $httpBody = '';

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function batchListMembers($list_id, $body, $skip_merge_validation = null, $skip_duplicate_check = null)
    {
        return $this->batchListMembersWithHttpInfo($list_id, $body, $skip_merge_validation, $skip_duplicate_check);
    }

    public function batchListMembersWithHttpInfo($list_id, $body, $skip_merge_validation = null, $skip_duplicate_check = null)
    {
        $request = $this->batchListMembersRequest($list_id, $body, $skip_merge_validation, $skip_duplicate_check);

        return $this->performRequest($request);
    }

    protected function batchListMembersRequest($list_id, $body, $skip_merge_validation = null, $skip_duplicate_check = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}';
        $queryParams = [];
        $headerParams = [];
        
        $this->serializeParam($queryParams, $skip_merge_validation, 'skip_merge_validation');
        $this->serializeParam($queryParams, $skip_duplicate_check, 'skip_duplicate_check');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createListInterestCategory($list_id, $body)
    {
        return $this->createListInterestCategoryWithHttpInfo($list_id, $body);
    }

    public function createListInterestCategoryWithHttpInfo($list_id, $body)
    {
        $request = $this->createListInterestCategoryRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function createListInterestCategoryRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createInterestCategoryInterest($list_id, $interest_category_id, $body)
    {
        return $this->createInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $body);
    }

    public function createInterestCategoryInterestWithHttpInfo($list_id, $interest_category_id, $body)
    {
        $request = $this->createInterestCategoryInterestRequest($list_id, $interest_category_id, $body);

        return $this->performRequest($request);
    }

    protected function createInterestCategoryInterestRequest($list_id, $interest_category_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'interest_category_id' is set
        $this->checkRequiredParameter($interest_category_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/interest-categories/{interest_category_id}/interests';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'interest_category_id', $interest_category_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function addListMember($list_id, $body, $skip_merge_validation = null)
    {
        return $this->addListMemberWithHttpInfo($list_id, $body, $skip_merge_validation);
    }

    public function addListMemberWithHttpInfo($list_id, $body, $skip_merge_validation = null)
    {
        $request = $this->addListMemberRequest($list_id, $body, $skip_merge_validation);

        return $this->performRequest($request);
    }

    protected function addListMemberRequest($list_id, $body, $skip_merge_validation = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members';
        $queryParams = [];
        $headerParams = [];
        
        $this->serializeParam($queryParams, $skip_merge_validation, 'skip_merge_validation');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function deleteListMemberPermanent($list_id, $subscriber_hash)
    {
        $this->deleteListMemberPermanentWithHttpInfo($list_id, $subscriber_hash);
    }

    public function deleteListMemberPermanentWithHttpInfo($list_id, $subscriber_hash)
    {
        $request = $this->deleteListMemberPermanentRequest($list_id, $subscriber_hash);

        return $this->performRequest($request);
    }

    protected function deleteListMemberPermanentRequest($list_id, $subscriber_hash): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/actions/delete-permanent';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createListMemberNote($list_id, $subscriber_hash, $body)
    {
        return $this->createListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $body);
    }

    public function createListMemberNoteWithHttpInfo($list_id, $subscriber_hash, $body)
    {
        $request = $this->createListMemberNoteRequest($list_id, $subscriber_hash, $body);

        return $this->performRequest($request);
    }

    protected function createListMemberNoteRequest($list_id, $subscriber_hash, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}/notes';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function addListMergeField($list_id, $body)
    {
        return $this->addListMergeFieldWithHttpInfo($list_id, $body);
    }

    public function addListMergeFieldWithHttpInfo($list_id, $body)
    {
        $request = $this->addListMergeFieldRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function addListMergeFieldRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/merge-fields';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createSegment($list_id, $body)
    {
        return $this->createSegmentWithHttpInfo($list_id, $body);
    }

    public function createSegmentWithHttpInfo($list_id, $body)
    {
        $request = $this->createSegmentRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function createSegmentRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/segments';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function batchSegmentMembers($body, $list_id, $segment_id)
    {
        return $this->batchSegmentMembersWithHttpInfo($body, $list_id, $segment_id);
    }

    public function batchSegmentMembersWithHttpInfo($body, $list_id, $segment_id)
    {
        $request = $this->batchSegmentMembersRequest($body, $list_id, $segment_id);

        return $this->performRequest($request);
    }

    protected function batchSegmentMembersRequest($body, $list_id, $segment_id): Request
    {
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);

        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createSegmentMember($list_id, $segment_id, $body)
    {
        return $this->createSegmentMemberWithHttpInfo($list_id, $segment_id, $body);
    }

    public function createSegmentMemberWithHttpInfo($list_id, $segment_id, $body)
    {
        $request = $this->createSegmentMemberRequest($list_id, $segment_id, $body);

        return $this->performRequest($request);
    }

    protected function createSegmentMemberRequest($list_id, $segment_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'segment_id' is set
        $this->checkRequiredParameter($segment_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/segments/{segment_id}/members';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'segment_id', $segment_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function updateListSignupForm($list_id, $body)
    {
        return $this->updateListSignupFormWithHttpInfo($list_id, $body);
    }

    public function updateListSignupFormWithHttpInfo($list_id, $body)
    {
        $request = $this->updateListSignupFormRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function updateListSignupFormRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/signup-forms';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function createListWebhook($list_id, $body)
    {
        return $this->createListWebhookWithHttpInfo($list_id, $body);
    }

    public function createListWebhookWithHttpInfo($list_id, $body)
    {
        $request = $this->createListWebhookRequest($list_id, $body);

        return $this->performRequest($request);
    }

    protected function createListWebhookRequest($list_id, $body): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/webhooks';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';

        $this->pathParam($resourcePath, 'list_id', $list_id);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPost($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function listSegments($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $since_created_at = null, $before_created_at = null, $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null, $since_updated_at = null, $before_updated_at = null)
    {
        return $this->listSegmentsWithHttpInfo($list_id, $fields, $exclude_fields, $count, $offset, $type, $since_created_at, $before_created_at, $include_cleaned, $include_transactional, $include_unsubscribed, $since_updated_at, $before_updated_at);
    }

    public function listSegmentsWithHttpInfo($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $since_created_at = null, $before_created_at = null, $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null, $since_updated_at = null, $before_updated_at = null)
    {
        $request = $this->listSegmentsRequest($list_id, $fields, $exclude_fields, $count, $offset, $type, $since_created_at, $before_created_at, $include_cleaned, $include_transactional, $include_unsubscribed, $since_updated_at, $before_updated_at);

        return $this->performRequest($request);
    }

    protected function listSegmentsRequest($list_id, $fields = null, $exclude_fields = null, $count = '10', $offset = '0', $type = null, $since_created_at = null, $before_created_at = null, $include_cleaned = null, $include_transactional = null, $include_unsubscribed = null, $since_updated_at = null, $before_updated_at = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        if ($count !== null && $count > 1000) {
            throw new InvalidArgumentException('invalid value for "$count" when calling ListsApi., must be smaller than or equal to 1000.');
        }


        $resourcePath = self::END_POINT . '/{list_id}/segments';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $fields, 'fields');
        $this->serializeParam($queryParams, $exclude_fields, 'exclude_fields');
        $this->serializeParam($queryParams, $count, 'count');
        $this->serializeParam($queryParams, $offset, 'offset');
        $this->serializeParam($queryParams, $type, 'type');
        $this->serializeParam($queryParams, $since_created_at, 'since_created_at');
        $this->serializeParam($queryParams, $before_created_at, 'before_created_at');
        $this->serializeParam($queryParams, $include_cleaned, 'include_cleaned');
        $this->serializeParam($queryParams, $include_transactional, 'include_transactional');
        $this->serializeParam($queryParams, $include_unsubscribed, 'include_unsubscribed');
        $this->serializeParam($queryParams, $since_updated_at, 'since_updated_at');
        $this->serializeParam($queryParams, $before_updated_at, 'before_updated_at');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function setListMember($list_id, $subscriber_hash, $body, $skip_merge_validation = null)
    {
        return $this->setListMemberWithHttpInfo($list_id, $subscriber_hash, $body, $skip_merge_validation);
    }

    public function setListMemberWithHttpInfo($list_id, $subscriber_hash, $body, $skip_merge_validation = null)
    {
        $request = $this->setListMemberRequest($list_id, $subscriber_hash, $body, $skip_merge_validation);

        return $this->performRequest($request);
    }

    protected function setListMemberRequest($list_id, $subscriber_hash, $body, $skip_merge_validation = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);
        // verify the required parameter 'subscriber_hash' is set
        $this->checkRequiredParameter($subscriber_hash);
        // verify the required parameter 'body' is set
        $this->checkRequiredParameter($body);

        $resourcePath = self::END_POINT . '/{list_id}/members/{subscriber_hash}';
        $queryParams = [];
        $headerParams = [];
        
        $this->serializeParam($queryParams, $skip_merge_validation, 'skip_merge_validation');

        $this->pathParam($resourcePath, 'list_id', $list_id);
        $this->pathParam($resourcePath, 'subscriber_hash', $subscriber_hash);

        $headers = $this->setHeaders($headerParams);

        // body params
        // for model (json/xml)
        $httpBody = $this->encodeBodyWhenJSON($body, $headers);

        return $this->queryAndRequestPut($queryParams, $resourcePath, $headers, $httpBody);
    }

    public function tagSearch($list_id, $name = null)
    {
        return $this->tagSearchWithHttpInfo($list_id, $name);
    }

    public function tagSearchWithHttpInfo($list_id, $name = null)
    {
        $request = $this->tagSearchRequest($list_id, $name);

        return $this->performRequest($request);
    }

    protected function tagSearchRequest($list_id, $name = null): Request
    {
        // verify the required parameter 'list_id' is set
        $this->checkRequiredParameter($list_id);

        $resourcePath = self::END_POINT . '/{list_id}/tag-search';
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        
        $this->serializeParam($queryParams, $name, 'name');

        $this->pathParam($resourcePath, 'list_id', $list_id);

        // body params
        $headers = $this->setHeaders($headerParams);

        return $this->queryAndRequestGet($queryParams, $resourcePath, $headers, $httpBody);
    }
}
