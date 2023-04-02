<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/

/**
 * REST API for the classify resources.
 */
class ClassifyApi {

	function __construct($apiClient) {
	  $this->apiClient = $apiClient;
	}

  /**
	 * createCategoryFilter
	 * get filter for classifier
   * filter_name, string: A unique name for the filter. (required)
   * body, FilterTrainingObject: The list of positive and negative (optional) example items. (required)
   * retina_name, string: The retina name (required)
   * @return CategoryFilter
	 */

   public function createCategoryFilter($filter_name, $body, $retina_name) {

  		//parse inputs
  		$resourcePath = "/classify/create_category_filter";
  		$resourcePath = str_replace("{format}", "json", $resourcePath);
  		$method = "POST";
      $queryParams = array();
      $headerParams = array();
      $headerParams['Accept'] = 'application/json';
      $headerParams['Content-Type'] = 'application/json';

      if($retina_name != null) {
  		  $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
  		}
  		if($filter_name != null) {
  		  $queryParams['filter_name'] = $this->apiClient->toQueryValue($filter_name);
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
  		                                                'CategoryFilter');
  		return $responseObject;

      }
  
}

