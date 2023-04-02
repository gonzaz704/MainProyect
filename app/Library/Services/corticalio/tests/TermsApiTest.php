<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
require_once('TestConfiguration.php');
require_once('../TermsApi.php');

class TermsApiTest extends PHPUnit_Framework_TestCase
{
    private static $termsApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$termsApi = new TermsApi($testConf->getApiClient());
    }


    public function testOneException()
    {
        $exceptionOccurred = false;
        try {
            self::$termsApi->getTerm("apple", true, "not_retina_name", 0, 5);
        } catch (Exception $e) {
            $exceptionOccurred = true;
        }
        $this->assertTrue($exceptionOccurred);
    }

    public function testTerms()
    {
        $terms = self::$termsApi->getTerm("apple", true, TestConfiguration::$RETINA_NAME, 0, 5);
        $this->assertNotEmpty($terms);
        $this->assertTrue(count($terms) == 1);
        $this->assertTrue($terms[0]->term == "apple");
        $this->assertTrue($terms[0]->pos_types[0] == "NOUN");
        $this->assertTrue($terms[0]->df > 0.0001);
        $this->assertNotEmpty(count($terms[0]->fingerprint->positions));
    }

    public function testContexts()
    {
        $contexts = self::$termsApi->getContextsForTerm("apple", true, TestConfiguration::$RETINA_NAME, 0, 3);
        $this->assertNotEmpty($contexts);
        $this->assertEquals(3, count($contexts));
        $c0 = $contexts[0];
        $this->assertTrue(count($c0->fingerprint->positions) > 0);
        $this->assertTrue(mb_detect_encoding($c0->context_label, 'UTF-8') == 'UTF-8');
        $this->assertTrue($c0->context_id == 0);
    }

    public function testSimilarTerms()
    {
        $terms = self::$termsApi->getSimilarTerms("apple", 0, "NOUN", true, TestConfiguration::$RETINA_NAME, 0, 8);
        $this->assertNotEmpty($terms);
        $this->assertEquals(8, count($terms));
        $t0 = $terms[0];
        $this->assertNotEmpty($t0);
        $this->assertTrue(count($t0->fingerprint->positions) > 0);
    }
} 