<?php

namespace App\Library\Services\corticalio;

use App\Library\Services\corticalio\ApiClient;

class Configuration
{
    public static $API_KEY = "5f267bc0-ed34-11e8-bb65-69ed2d3c7927";
    public static $BASE_PATH = "http://api.cortical.io/rest";
    public static $RETINA_NAME = "en_associative";

    public function getApiClient()
    {
        return new APIClient(self::$API_KEY, self::$BASE_PATH);
    }
} 