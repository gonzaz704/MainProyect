<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
require_once('TestConfiguration.php');
require_once('../CompareApi.php');

class CompareAPITest extends PHPUnit_Framework_TestCase
{
    private static $inputJSONarray = '[ { "term" : "apple" }, { "text" : "banana is a kind of fruit" } ]';
    private static $inputJSOBulk = '[ [ { "term" : "car" }, { "term" : "cat" } ], [ { "term" : "jaguar" }, { "term" : "horse" } ]]';
    private static $oneTermInputJSONarray = "[ { \"term\" : \"apple\" } ]";
    private static $syntaxErrorJSONarray = "[ { \"term\" : \"apple\" }, { \"term\" : \"banana\"  ]";
    private static $compareApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$compareApi = new CompareApi($testConf->getApiClient());

    }

    public function testCompare()
    {
        $resultMetric = self::$compareApi->compare(self::$inputJSONarray, TestConfiguration::$RETINA_NAME);
        $this->assertGreaterThan(0.1, $resultMetric->cosineSimilarity);
        $this->assertGreaterThan(0.1, $resultMetric->euclideanDistance);
        $this->assertGreaterThan(0.1, $resultMetric->jaccardDistance);
        $this->assertGreaterThan(0.1, $resultMetric->weightedScoring);
        $this->assertGreaterThan(0.1, $resultMetric->sizeRight);
        $this->assertGreaterThan(0.1, $resultMetric->sizeLeft);
        $this->assertGreaterThan(0.1, $resultMetric->overlappingLeftRight);
        $this->assertGreaterThan(0.1, $resultMetric->overlappingAll);
        $this->assertGreaterThan(0.1, $resultMetric->overlappingRightLeft);
    }

    public function testException()
    {
        # testing using only one input element in the array
        $expectedException = false;
        try {
            self::$compareApi->compare(self::$oneTermInputJSONarray, TestConfiguration::$RETINA_NAME);
        } catch (Exception $e) {
            $expectedException = true;
        }
        $this->assertTrue($expectedException);

        # testing JSON parse exception in the input
        $expectedException = false;
        try {
            self::$compareApi->compare(self::$syntaxErrorJSONarray, TestConfiguration::$RETINA_NAME);
        } catch (Exception $e) {
            $expectedException = true;
        }
        $this->assertTrue($expectedException);
    }

    public function testCompareBulk()
    {
        $resultMetrics = self::$compareApi->compareBulk(self::$inputJSOBulk, TestConfiguration::$RETINA_NAME);

        foreach ($resultMetrics as $resultMetric) {
            $this->assertGreaterThan(0.1, $resultMetric->euclideanDistance);
            $this->assertGreaterThan(0.1, $resultMetric->jaccardDistance);
            $this->assertGreaterThan(20, $resultMetric->overlappingAll);
            $this->assertGreaterThan(0.01, $resultMetric->overlappingLeftRight);
            $this->assertGreaterThan(0.01, $resultMetric->overlappingRightLeft);
            $this->assertGreaterThan(0.01, $resultMetric->cosineSimilarity);
            $this->assertGreaterThan(320, $resultMetric->sizeLeft);
            $this->assertGreaterThan(320, $resultMetric->sizeRight);
            $this->assertGreaterThan(1, $resultMetric->weightedScoring);
        }
    }
}
