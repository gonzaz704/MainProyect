<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class CompareApi
{

    function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * compare
     * Compare 2 elements
     * body, ExpressionOperation: The comparison array to be evaluated (required)
     * retina_name, string: The retina name (required)
     * @param $body
     * @param $retina_name
     * @return Metric
     */

    public function compare($body, $retina_name)
    {

        //parse inputs
        $resourcePath = "/compare";
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
            'Metric');
        return $responseObject;

      }
  /**
	 * compareBulk
	 * Bulk compare
   * body, ExpressionOperation: Bulk comparison of elements 2 by 2 (required)
   * retina_name, string: The retina name (required)
   * @return Array[Metric]
	 */

   public function compareBulk($body, $retina_name) {

  		//parse inputs
  		$resourcePath = "/compare/bulk";
  		$resourcePath = str_replace("{format}", "json", $resourcePath);
  		$method = "POST";
      $queryParams = array();
      $headerParams = array();
      $headerParams['Accept'] = 'application/json';
      $headerParams['Content-Type'] = 'application/json';

      if($retina_name != null) {
  		  $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
  		}
  		//make the API Call
      if (! isset($body)) {
        $body = null;
      }
  		$response = $this->apiClient->callAPI($resourcePath, $method,
  		                                      $queryParams, $body,
  		                                      $headerParams);


      if(! $response){
          return null;
        }

  		$responseObject = $this->apiClient->deserialize($response,
  		                                                'Array[Metric]');
  		return $responseObject;

      }
  
}

