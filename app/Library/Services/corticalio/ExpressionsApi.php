<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class ExpressionsApi
{

    function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * resolveExpression
     * Resolve an expression
     * @body , ExpressionOperation: The expression to be evaluated (required)
     * @retina_name , string: The retina name (required)
     * @sparsity , float: Sparsity the resulting expression to this percentage (optional)
     * @return Fingerprint
     */

    public function resolveExpression($body, $retina_name, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/expressions";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($sparsity != null) {
            $queryParams['sparsity'] = $this->apiClient->toQueryValue($sparsity);
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
            'Fingerprint');
        return $responseObject;

    }

    /**
     * getContextsForExpression
     * Get semantic contexts for the input expression
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Context]
     */

    public function getContextsForExpression($body, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/expressions/contexts";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($start_index != null) {
            $queryParams['start_index'] = $this->apiClient->toQueryValue($start_index);
        }
        if ($max_results != null) {
            $queryParams['max_results'] = $this->apiClient->toQueryValue($max_results);
        }
        if ($sparsity != null) {
            $queryParams['sparsity'] = $this->apiClient->toQueryValue($sparsity);
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
     * getSimilarTermsForExpressionContext
     * Get similar terms for the contexts of an expression
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @context_id, int: The identifier of a context (optional) (optional)
     * @pos_type, string: Part of speech (optional) (optional)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Term]
     */

    public function getSimilarTermsForExpressionContext($body, $context_id = null, $pos_type = null, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/expressions/similar_terms";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
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
        if ($sparsity != null) {
            $queryParams['sparsity'] = $this->apiClient->toQueryValue($sparsity);
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
     * resolveBulkExpression
     * Bulk resolution of expressions
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @retina_name, string: The retina name (required)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Fingerprint]
     */

    public function resolveBulkExpression($body, $retina_name, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/expressions/bulk";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($sparsity != null) {
            $queryParams['sparsity'] = $this->apiClient->toQueryValue($sparsity);
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
            'Array[Fingerprint]');
        return $responseObject;

    }

    /**
     * getContextsForBulkExpression
     * Bulk get contexts for input expressions
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Context]
     */

    public function getContextsForBulkExpression($body, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/expressions/contexts/bulk";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null || $retina_name >= 0) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if (!($start_index === null)) {
            $queryParams['start_index'] = $this->apiClient->toQueryValue($start_index);
        }
        if ($max_results != null) {
            $queryParams['max_results'] = $this->apiClient->toQueryValue($max_results);
        }
        if ($sparsity != null) {
            $queryParams['sparsity'] = $this->apiClient->toQueryValue($sparsity);
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
            'Array[Array[Context]]');
        return $responseObject;

    }

    /**
     * getSimilarTermsForBulkExpressionContext
     * Bulk get similar terms for input expressions
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @context_id, int: The identifier of a context (optional) (optional)
     * @pos_type, string: Part of speech (optional) (optional)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Term]
     */

    public function getSimilarTermsForBulkExpressionContext($body, $context_id = null, $pos_type = null, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/expressions/similar_terms/bulk";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
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
        if ($sparsity != null) {
            $queryParams['sparsity'] = $this->apiClient->toQueryValue($sparsity);
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
            'Array[Array[Term]]');
        return $responseObject;

      }  
}

