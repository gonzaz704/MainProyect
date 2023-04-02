<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
require_once('TestConfiguration.php');
require_once('../ExpressionsApi.php');

class ExpressionsApiTest extends PHPUnit_Framework_TestCase
{
    private static $oneTermInputJSON = '{ "term" : "apple" }';
    private static $jsonBulkExpression;
    private static $expressionsApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$expressionsApi = new ExpressionsApi($testConf->getApiClient());
        self::$jsonBulkExpression = file_get_contents('bulkInput.json');
    }

    public function  testExpressions()
    {
        $fp = self::$expressionsApi->resolveExpression(self::$oneTermInputJSON, TestConfiguration::$RETINA_NAME, 0.5);
        $this->assertTrue($fp->positions > 0);
    }

    public function testContexts()
    {
        $contexts = self::$expressionsApi->getContextsForExpression(self::$oneTermInputJSON, true, TestConfiguration::$RETINA_NAME, 0, 3, 1.0);
        $this->assertNotNull($contexts);
        $this->assertEquals(3, count($contexts));
        $c0 = $contexts[0];
        $this->assertTrue(count($c0->fingerprint->positions) > 0);
        $this->assertTrue(mb_detect_encoding($c0->context_label, 'UTF-8') == 'UTF-8');
        $this->assertTrue($c0->context_id == 0);
    }

    public function testSimilarTerms()
    {
        $terms = self::$expressionsApi->getSimilarTermsForExpressionContext(self::$oneTermInputJSON, null, "NOUN", true, TestConfiguration::$RETINA_NAME, 0, 8, 1.0);
        $this->assertNotNull($terms);
        $this->assertEquals(8, count($terms));
        $t0 = $terms[0];
        $this->assertNotNull($t0);
        $this->assertTrue(count($t0->fingerprint->positions) > 0);
    }

    public function testExpressionBulk()
    {
        $fps = self::$expressionsApi->resolveBulkExpression(self::$jsonBulkExpression, TestConfiguration::$RETINA_NAME);
        $this->assertEquals(6, count($fps));
        foreach ($fps as $property => $value) {
            $this->assertTrue(count($value->positions) > 0);
        }
    }

    public function testExpressionContextsBulk()
    {
        $contextsList = self::$expressionsApi->getContextsForBulkExpression(self::$jsonBulkExpression, true, TestConfiguration::$RETINA_NAME, 0, 3);
        $this->assertEquals(count($contextsList), 6);
        foreach ($contextsList as $property => $contextArr) {
            foreach ($contextArr as $index => $context) {
                $this->assertTrue(count($context->fingerprint->positions) > 0);
                $this->assertTrue(mb_detect_encoding($context->context_label, 'UTF-8') == 'UTF-8');
                $this->assertTrue($context->context_id == $index);
            }
        }
    }

    public function testExpressionSimilarTermsBulk()
    {
        $termsLists = self::$expressionsApi->getSimilarTermsForBulkExpressionContext(self::$jsonBulkExpression, null, null, true, TestConfiguration::$RETINA_NAME, null, 7);
        $this->assertTrue(count($termsLists) == 6);
        foreach ($termsLists as $termList) {
            $this->assertTrue(count($termList) == 7);
            $this->assertTrue(count($termList[0]->fingerprint->positions) > 0);
        }
    }
} 