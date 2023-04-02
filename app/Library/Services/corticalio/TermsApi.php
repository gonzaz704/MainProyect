<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class TermsApi
{

    function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * getTerm
     * Get term objects
     * @term, string: A term in the retina (optional) (optional)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @return Array[Term]
     */

    public function getTerm($term = null, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null)
    {

        //parse inputs
        $resourcePath = "/terms";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($term != null) {
            $queryParams['term'] = $this->apiClient->toQueryValue($term);
        }
        if ($start_index != null) {
            $queryParams['start_index'] = $this->apiClient->toQueryValue($start_index);
        }
        if ($max_results != null) {
            $queryParams['max_results'] = $this->apiClient->toQueryValue($max_results);
        }
        if ($get_fingerprint != null) {
            $queryParams['get_fingerprint'] = $this->apiClient->toQueryValue($get_fingerprint);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
            $queryParams, $body,
            $headerParams);


        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
            'Array[Term]');
        return $responseObject;

    }

    /**
     * getContextsForTerm
     * Get the contexts for a given term
     * @term, string: A term in the retina (required)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @return Array[Context]
     */

    public function getContextsForTerm($term, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null)
    {

        //parse inputs
        $resourcePath = "/terms/contexts";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($term != null) {
            $queryParams['term'] = $this->apiClient->toQueryValue($term);
        }
        if ($start_index != null) {
            $queryParams['start_index'] = $this->apiClient->toQueryValue($start_index);
        }
        if ($max_results != null) {
            $queryParams['max_results'] = $this->apiClient->toQueryValue($max_results);
        }
        if ($get_fingerprint != null) {
            $queryParams['get_fingerprint'] = $this->apiClient->toQueryValue($get_fingerprint);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
            $queryParams, $body,
            $headerParams);


        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
            'Array[Context]');
        return $responseObject;

    }

    /**
     * getSimilarTerms
     * Get the similar terms of a given term
     * @term, string: A term in the retina (required)
     * @context_id, int: The identifier of a context (optional) (optional)
     * @pos_type, string: Part of speech (optional) (optional)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @return Array[Term]
     */

    public function getSimilarTerms($term, $context_id = null, $pos_type = null, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null)
    {

        //parse inputs
        $resourcePath = "/terms/similar_terms";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($term != null) {
            $queryParams['term'] = $this->apiClient->toQueryValue($term);
        }
        if ($context_id != null) {
            $queryParams['context_id'] = $this->apiClient->toQueryValue($context_id);
        }
        if ($start_index != null) {
            $queryParams['start_index'] = $this->apiClient->toQueryValue($start_index);
        }
        if ($max_results != null) {
            $queryParams['max_results'] = $this->apiClient->toQueryValue($max_results);
        }
        if ($pos_type != null) {
            $queryParams['pos_type'] = $this->apiClient->toQueryValue($pos_type);
        }
        if ($get_fingerprint != null) {
            $queryParams['get_fingerprint'] = $this->apiClient->toQueryValue($get_fingerprint);
        }
        //make the API Call
        if (!isset($body)) {
            $body = null;
        }
        $response = $this->apiClient->callAPI($resourcePath, $method,
            $queryParams, $body,
            $headerParams);


        if (!$response) {
            return null;
        }

        $responseObject = $this->apiClient->deserialize($response,
            'Array[Term]');
        return $responseObject;

    }

}

