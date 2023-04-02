<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
require_once('TestConfiguration.php');
require_once('../ImageApi.php');

class ImageApiTest extends PHPUnit_Framework_TestCase
{
    private static $inputJSON = '{ "term" : "apple" }';
    private static $inputJSONarray = '[ { "term" : "apple" }, { "term" : "banana" } ]';
    private static $inputJSONarray3 = '[ { "term" : "apple" }, { "term" : "banana" }, { "term" : "fruit" } ]';
    private static $imageApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$imageApi = new ImageApi($testConf->getApiClient());
    }

    public function testGetImageForExpression()
    {
        $imageData = self::$imageApi->getImageForExpression(self::$inputJSON, TestConfiguration::$RETINA_NAME);
        $this->assertNotEmpty($imageData);
    }

    public function testGetOverlayImage()
    {
        $imageData = self::$imageApi->getOverlayImage(self::$inputJSONarray, TestConfiguration::$RETINA_NAME);
        $this->assertNotEmpty($imageData);
    }

    public function testGetImageForBulkExpressions()
    {
        $images = self::$imageApi->getImageForBulkExpressions(self::$inputJSONarray3, true, TestConfiguration::$RETINA_NAME);
        $this->assertEquals(count($images), 3);
        foreach ($images as $image) {
            $this->assertNotEmpty($image);
            $this->assertNotEmpty($image->image_data);
            $this->assertNotEquals(count($image->fingerprint->positions), 0);
        }
    }
} 