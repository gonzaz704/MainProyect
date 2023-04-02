<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/
require_once('TestConfiguration.php');
require_once('../RetinasApi.php');


class ClassifyAPITest extends PHPUnit_Framework_TestCase
{

    private static $classifyApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$classifyApi = new ClassifyApi($testConf->getApiClient());

    }

    public function testGetRetinas()
    {
        $fingerPrint = self::$classifyApi->createCategoryFilter("Tests",
            "{\"positiveExamples\":[{\"text\":\"Shoe with a lining to help keep your feet dry and comfortable on wet terrain.\"},{\"text\":\"running shoes providing protective cushioning.\"}],\"negativeExamples\":[{\"text\":\"The most comfortable socks for your feet.\"},{\"text\":\"6 feet USB cable basic white\"}]}",
            TestConfiguration::$RETINA_NAME);
        $this->assertNotEmpty($fingerPrint);
        $this->assertNotEmpty($fingerPrint->positions);
    }
}

