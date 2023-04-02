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


class RetinasAPITest extends PHPUnit_Framework_TestCase
{

    private static $retinasApi;

    public static function setUpBeforeClass()
    {
        $testConf = new TestConfiguration();
        self::$retinasApi = new RetinasApi($testConf->getApiClient());

    }

    public function testGetRetinas()
    {
        $retinas = self::$retinasApi->getRetinas();
        $this->assertNotEmpty($retinas);
        $this->assertNotEmpty($retinas[0]);
        $this->assertNotEmpty($retinas[1]);
        $this->assertTrue("en_synonymous" == $retinas[0]->retinaName or "en_associative" == $retinas[0]->retinaName);
    }
}

