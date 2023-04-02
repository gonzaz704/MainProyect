<?php

/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
class ImageApi
{

    function __construct($apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * getImageForExpression
     * Get images for expressions
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @retina_name, string: The retina name (required)
     * @image_scalar, int: The scale of the image (optional) (optional)
     * @plot_shape, string: The image shape (optional) (optional)
     * @image_encoding, string: The encoding of the returned image (optional)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return array[byte]
     */

    public function getImageForExpression($body, $retina_name, $image_scalar = null, $plot_shape = null, $image_encoding = null, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/image";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'image/png';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($image_scalar != null) {
            $queryParams['image_scalar'] = $this->apiClient->toQueryValue($image_scalar);
        }
        if ($plot_shape != null) {
            $queryParams['plot_shape'] = $this->apiClient->toQueryValue($plot_shape);
        }
        if ($image_encoding != null) {
            $queryParams['image_encoding'] = $this->apiClient->toQueryValue($image_encoding);
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
            'array[byte]');
        return $responseObject;

    }

    /**
     * getOverlayImage
     * Get an overlay image for two expressions
     * @body, ExpressionOperation: The comparison array to be evaluated (required)
     * @retina_name, string: The retina name (required)
     * @plot_shape, string: The image shape (optional) (optional)
     * @image_scalar, int: The scale of the image (optional) (optional)
     * @image_encoding, string: The encoding of the returned image (optional)
     * @return array[byte]
     */

    public function getOverlayImage($body, $retina_name, $plot_shape = null, $image_scalar = null, $image_encoding = null)
    {

        //parse inputs
        $resourcePath = "/image/compare";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'image/png';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($plot_shape != null) {
            $queryParams['plot_shape'] = $this->apiClient->toQueryValue($plot_shape);
        }
        if ($image_scalar != null) {
            $queryParams['image_scalar'] = $this->apiClient->toQueryValue($image_scalar);
        }
        if ($image_encoding != null) {
            $queryParams['image_encoding'] = $this->apiClient->toQueryValue($image_encoding);
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
            'array[byte]');
        return $responseObject;

    }

    /**
     * getImageForBulkExpressions
     * Bulk get images for expressions
     * @body, ExpressionOperation: The expression to be evaluated (required)
     * @get_fingerprint, bool: Configure if the fingerprint should be returned as part of the results (optional)
     * @retina_name, string: The retina name (required)
     * @image_scalar, int: The scale of the image (optional) (optional)
     * @plot_shape, string: The image shape (optional) (optional)
     * @sparsity, float: Sparsity the resulting expression to this percentage (optional)
     * @return Array[Image]
     */

    public function getImageForBulkExpressions($body, $get_fingerprint = null, $retina_name, $image_scalar = null, $plot_shape = null, $sparsity = null)
    {

        //parse inputs
        $resourcePath = "/image/bulk";
        $resourcePath = str_replace("{format}", "json", $resourcePath);
        $method = "POST";
        $queryParams = array();
        $headerParams = array();
        $headerParams['Accept'] = 'application/json';
        $headerParams['Content-Type'] = 'application/json';

        if ($retina_name != null) {
            $queryParams['retina_name'] = $this->apiClient->toQueryValue($retina_name);
        }
        if ($image_scalar != null) {
            $queryParams['image_scalar'] = $this->apiClient->toQueryValue($image_scalar);
        }
        if ($plot_shape != null) {
            $queryParams['plot_shape'] = $this->apiClient->toQueryValue($plot_shape);
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
            'Array[Image]');
        return $responseObject;

    }

}

