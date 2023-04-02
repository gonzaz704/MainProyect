<?php

namespace App\Http\Controllers;

use App\Library\Services\corticalio\ApiClient;
use App\Library\Services\corticalio\Configuration;
use App\Library\Services\corticalio\TextApi;

class KeyswordsController extends Controller{
    
    private static $textApi;

    private static $inputText = <<<EOT
        The Battle of Wolf 359 is a fictional space battle in the Star Trek universe between the United Federation of Planets and the Borg Collective in the year 2367. The aftermath is depicted in the Star Trek: The Next Generation episode "The Best of Both Worlds, Part II" and the battle in Star Trek: Deep Space Nine pilot, "Emissary." The battle occurs at the star Wolf 359, a real star system located 7.78 light years from Earth's solar system, and constitutes a total loss for the Federation, after the single attacking Borg ship obliterates the opposing fleet and proceeds to Earth without significant damage. Presumably, some of the Federation starships involved in the battle were assimilated in totality and returned to Borg space, as Voyager encounters several Starfleet officers assimilated at Wolf 359 many years later during its journey through the Delta Quadrant, despite the Borg cube being destroyed before it could leave the Alpha Quadrant.
EOT;

    public static function setUpBeforeClass()
    {
        $testConf = new Configuration();
        self::$textApi = new TextApi($testConf->getApiClient());
    }


    public function keywordsfortext()
    {
        
        $this->setUpBeforeClass();

        $termList = self::$textApi->getKeywordsForText(self::$inputText, Configuration::$RETINA_NAME);
        
        echo "<pre>";print_r( $termList );


    }

}