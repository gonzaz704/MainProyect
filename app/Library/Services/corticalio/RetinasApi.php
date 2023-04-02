<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class RetinasApi
{

    function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * getRetinas
     * Information about retinas
     * @retina_name, string: The retina name (optional) (optional)
     * @return Array[Retina]
     */

    public function getRetinas($retina_name = null)
    {

        //parse inputs
        $resourcePath = "/retinas";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "GET";
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
            'Array[Retina]');
        return $responseObject;

    }

}

