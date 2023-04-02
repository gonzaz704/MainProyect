<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
namespace App\Library\Services\corticalio;

class TextApi
{

    function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * getRepresentationForText
     * Get a retina representation of a text
     * @body, string: The text to be evaluated (required)
     * @retina_name, string: The retina name (required)
     * @return Array[Fingerprint]
     */

    public function getRepresentationForText($body, $retina_name)
    {

        //parse inputs
        $resourcePath = "/text";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
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
     * getKeywordsForText
     * Get a list of keywords from the text
     * @body, string: The text to be evaluated (required)
     * @retina_name, string: The retina name (required)
     * @return Array[string]
     */

    public function getKeywordsForText($body, $retina_name)
    {

        //parse inputs
        $resourcePath = "/text/keywords";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
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
            'Array[string]');
        return $responseObject;

    }

    /**
     * getTokensForText
     * Get tokenized input text
     * @body, string: The text to be tokenized (required)
     * @POStags, string: Specify desired POS types (optional)
     * @retina_name, string: The retina name (required)
     * @return Array[string]
     */

    public function getTokensForText($body, $POStags = null, $retina_name)
    {

        //parse inputs
        $resourcePath = "/text/tokenize";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($POStags != null) {
            $queryParams['POStags'] = $this->apiClient->toQueryValue($POStags);
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
            'Array[string]');
        return $responseObject;

    }

    /**
     * getSlicesForText
     * Get a list of slices of the text
     * @body, string: The text to be evaluated (required)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @start_index, int: The start-index for pagination (optional) (optional)
     * @max_results, int: Max results per page (optional) (optional)
     * @return Array[Text]
     */

    public function getSlicesForText($body, $get_fingerprint = null, $retina_name, $start_index = null, $max_results = null)
    {

        //parse inputs
        $resourcePath = "/text/slices";
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
            'Array[Text]');
        return $responseObject;

    }

    /**
     * getRepresentationsForBulkText
     * Bulk get Fingerprint for text.
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @retina_name, string: The retina name (required)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Fingerprint]
     */

    public function getRepresentationsForBulkText($body, $retina_name, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/text/bulk";
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
     * getLanguage
     * Detect the language of a text
     * @body, string: Your input text (UTF-8) (required)
     * @return LanguageRest
     */

    public function getLanguage($body)
    {

        //parse inputs
        $resourcePath = "/text/detect_language";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

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
            'LanguageRest');
        return $responseObject;

    }

}

