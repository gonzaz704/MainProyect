<?php
/*******************************************************************************
 * Copyright (c) cortical.io GmbH. All rights reserved.
 *
 * This software is confidential and proprietary information.
 * You shall use it only in accordance with the terms of the
 * license agreement you entered into with cortical.io GmbH.
 ******************************************************************************/

namespace App\Library\Services\corticalio;
// require_once("../ApiClient.php");

//use App\Library\Services\corticalio\ApiClient;

class TestConfiguration
{
    public static $API_KEY = "5f267bc0-ed34-11e8-bb65-69ed2d3c7927";
    public static $BASE_PATH = "http://api.cortical.io/rest";
    public static $RETINA_NAME = "en_associative";

    public function getApiClient()
    {
        return new APIClient(self::$API_KEY, self::$BASE_PATH);
    }
} 